<?php

namespace App\Http\Controllers;

use App\Models\URLMapping;
use Illuminate\Http\Request;

class ResolveController extends Controller
{
    
    /**
     * 
     * This contoller class is responsible for the resolving short URls
     */


    /**
     * 
     * This function receives client request to reolve a short URL 
     * Expected parameters:
     * short_url: string 
     * 
     * Response:
     * status_code: 200 | 400
     * long_url: string
     */

    public function resolveURL(Request $request)
    {

        try {
            
            //receive request
            $short_code = $request->short_code; 
//            return mb_ord($short_code);

            //search DB record for the long url alias
            $record = URLMapping::where('short_code', $short_code)->first();

            //return response
            return response()->json([

                'short_code' => $short_code,
                'long_url' => $record->long_url ?? null,
                'created_at' => $record->created_at ?? null,

            ], 200);

        } catch (\Exception $e) {

            return response()->json($e->getMessage(), 400);

        }

    }


}
