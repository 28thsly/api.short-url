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
    
    private const EMOTICON_HTML_PREFIX = '&#x1F';
    private const EMOTICON_HEXCODE = [1,2,3,4,5,6,7,8,9,'A','B','C','D','E','F'];
    
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
    
        //join permitted characters into a single string
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

        $emojis = '';

        //generate random number between 1 - 6 to determine the lenght of the short code
        $lenght = random_int(1, self::MAX_CHAR_LENGTH);

        while($lenght != 0)
        {

            //pick randomly btw 60 - 64
            $emoticon_range = random_int(60,64);
            
            //pick a random hexcode in the array
            $rand_key = array_rand(self::EMOTICON_HEXCODE);
            $rand_hexcode = self::EMOTICON_HEXCODE[$rand_key];

            //create the emoji
            $emoji = self::EMOTICON_HTML_PREFIX . "{$emoticon_range}" . "$rand_hexcode";
            $emojis .= $emoji; //concat all the emojis

            $lenght--;

        }


        return $emojis;


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

    public function generateWord()
    {
        #code

    }

}