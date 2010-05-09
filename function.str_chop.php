<?php

/**
 * Chop a string into a smaller string.
 *
 * @author      Aidan Lister <aidan@php.net>
 * @version     1.1.0
 * @link        http://aidanlister.com/2004/04/creating-a-string-exerpt-elegantly/
 * @param       mixed  $string   The string you want to shorten
 * @param       int    $length   The length you want to shorten the string to
 * @param       bool   $center   If true, chop in the middle of the string
 * @param       mixed  $append   String appended if it is shortened
 */
function str_chop($string, $length = 60, $center = false, $append = null)
{
    // Set the default append string
    if ($append === null) {
        $append = ($center === true) ? ' ... ' : ' ...';
    }
 
    // Get some measurements
    $len_string = strlen($string);
    $len_append = strlen($append);
 
    // If the string is longer than the maximum length, we need to chop it
    if ($len_string > $length) {
        // Check if we want to chop it in half
        if ($center === true) {
            // Get the lengths of each segment
            $len_start = $length / 2;
            $len_end = $len_start - $len_append;
 
            // Get each segment
            $seg_start = substr($string, 0, $len_start);
            $seg_end = substr($string, $len_string - $len_end, $len_end);
 
            // Stick them together
            $string = $seg_start . $append . $seg_end;
        } else {
            // Otherwise, just chop the end off
            $string = substr($string, 0, $length - $len_append) . $append;
        }
    }
 
    return $string;
}

