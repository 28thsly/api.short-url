<?php

namespace App\Http\Controllers;

use App\Models\URL_Mapping;
use Illuminate\Http\Request;

class EncodeController extends Controller
{

    /**
     * 
     * This function takes a long url and encode into a 6 characters 
     * Expected parameters:
     * long_url: string 
     * user_id: int (optional)
     * 
     * Response:
     * status_code: 200 | 400
     * short_url: string
     */

    public function encodeURL(Request $request){

        try {
            
            //receieve the requests
            $long_url = $request->long_url;
            $user_id = $request->user_id ?? null;

            //encode the URL
            $encoded_url = $this->encode($long_url);

            //store record in the DB
            $url_map = new URL_Mapping;
            $url_map->long_name = $long_url;
            $url_map->short_name = $encoded_url; 
            $url_map->save();

            //return response
            return response()->json([
                'short_url' => $encoded_url,
                'long_url' => $long_url
            ], 200);

        } catch (\Throwable $th) {
            return response()->json('Error occured', 400);
        }

    }

    /**
     * 
     * This function uses the following encoding scheme [a-z][A-Z][0-9] 
     * Expected parameters:
     * long_url: string 
     * 
     * Response:
     * short_url: string
     */

    public function encode($long_url)
    {

        //making this a stub function for now
        return 'iueAZ4';

    }


}
