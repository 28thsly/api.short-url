<?php

namespace App\Repository;


class SchemeGenerator
{
    

    /**
     * This class defines all the generator algorithms and schemes
     * 
     */


    //Define the various encoding scheme
    private const PERMITTED_NUMBERS = "23456789";
    private const PERMITTED_LOWERCASE = 'abcdefghjklmnpqrstuvwxyz';
    private const PERMITTED_UPPERCASE = 'ABCDEFGHJKLMNPQRSTUVWXYZ'; 
    private const MAX_CHAR_LENGTH = 6;


    /**
     * 
     * This function generate alphanumerics.
     * Allowed encoding scheme: [a-z][A-Z][0-9] 
     * Expected params: None
     * 
     * Return:
     * rand_chars: string
     */
    
    public function generateAlphanumeric()
    {
    
        //permitted characters
        $permitted_chars = self::PERMITTED_NUMBERS . self::PERMITTED_LOWERCASE . self::PERMITTED_UPPERCASE;
        
        //generate random characters
        $rand_chars = substr(str_shuffle($permitted_chars), 0, self::MAX_CHAR_LENGTH);

        //making this a stub function for now
        return $rand_chars;
        
    }

    /**
     * 
     * This function generate random emojis.
     * Allowed encoding scheme: [emojis]
     * Expected params: None
     * 
     * Return:
     * rand_chars: string
     */

    public function generateEmoji()
    {
        #code

    }

    /**
     * 
     * This function generate random valid words of 6 words.
     * Allowed encoding scheme: [words] 
     * Expected params: None
     * 
     * Return:
     * rand_chars: string
     */

    public function generateWord($long_url)
    {
        #code

    }

}