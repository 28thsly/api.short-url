<?php

namespace App\Http\Controllers;

use App\Models\URLMapping;
use Illuminate\Http\Request;
use App\Repository\SchemeGenerator;

class EncodeController extends Controller
{

    /**
     * 
     * This contoller class is responsible for the encoding long URls into short URLs 
     */


    /**
     * 
     * This function receives client request to encode a long URL 
     * Expected parameters:
     * long_url: string 
     * scheme: string
     * 
     * Response:
     * status_code: 200 | 400
     * short_url: string
     */

    public function encodeURL(Request $request){

        try {
            
            //receieve the requests
            $long_url = $request->long_url;
            $short_code = $request->custom_url ?? null;
            $scheme = $request->scheme ?? 'ALPHANUMERIC';

            
            //Generate short code if the scheme is not CUSTOM
            if ($scheme != 'CUSTOM') 
            {

                $bool = true;

                while( $bool )
                {
                    //generate a random short code
                    $short_code = $this->generateShortCode($scheme);
                
                    //check if the code already exists in the DB
                    $bool = $this->shortCodeExists($short_code);
    
                }
                    
            }

            //If the custom code already exists in the DB, throw an exception
            if ($this->shortCodeExists($short_code)) {
                
                throw new \Exception("Custom code already exists", 701);

            }

            //store record in the DB
            $url_map = new URLMapping;
            $url_map->long_url = $long_url;
            $url_map->short_code = $short_code; 
            $url_map->save();

            //generate short URL
            $short_url = $_SERVER['SERVER_NAME'] . '/' . $short_code; 

            // //return response
            return response()->json([

                'long_url' => $long_url,
                'short_url' => $short_url,
                'encoding_scheme' => $scheme,

            ], 200);

        } catch (\Exception $e) {

            return response()->json($e->getMessage(), 400);

        }

    }


    /**
     * 
     * This function generate a short code using the appropriate scheme of length 6.
     * Expected parameters:
     * scheme: string 
     * 
     * Return:
     * short_code: string
     */

    public function generateShortCode($scheme = 'ALPHANUMERIC')
    {

        $short_code = '';
        
        //Instantiate scheme generator class
        $scheme_instance = new SchemeGenerator;

        //Invoke the appropriate scheme for the condition
        switch ($scheme) {
            
            case 'ALPHANUMERIC':
                $short_code = $scheme_instance->generateAlphanumeric();
                break;

            case 'EMOJI':
                $short_code = $scheme_instance->generateEmoji();
                break;
    
            default:
                throw new \Exception("Invalid Scheme Type Passed", 700);
                break;
        }

        return $short_code;

    }


    /**
     * 
     * This function check if a short code already exists in the DB.
     * Expected parameters:
     * short_code: string 
     * 
     * Return:
     * status: boolean
     */

    public function shortCodeExists($short_code)
    {

        return (boolean) URLMapping::where('short_code', $short_code)->count();

    }

}
