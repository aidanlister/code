<?php

/**
 * Generate and return a random string
 *
 * The default string returned is 8 alphanumeric characters.
 *
 * The type of string returned can be changed with the output parameter.
 * Four types are available: alpha, numeric, alphanum and hexadec. 
 *
 * If the output parameter does not match one of the above, then the string
 * supplied is used.
 *
 * @author      Aidan Lister <aidan@php.net>
 * @version     2.1.0
 * @link        http://aidanlister.com/2004/04/quick-and-easy-random-string-generation/
 * @param       int     $length  Length of string to be generated
 * @param       string  $seeds   Seeds string should be generated from
 */
function str_rand($length = 8, $output = 'alphanum')
{
    // Possible seeds
    $outputs['alpha']    = 'abcdefghijklmnopqrstuvwqyz';
    $outputs['numeric']  = '0123456789';
    $outputs['alphanum'] = 'abcdefghijklmnopqrstuvwqyz0123456789';
    $outputs['hexadec']  = '0123456789abcdef';
 
    // Choose seed
    if (isset($outputs[$output])) {
        $output = $outputs[$output];
    }
 
    // Seed generator
    list($usec, $sec) = explode(' ', microtime());
    $seed = (float) $sec + ((float) $usec * 100000);
    mt_srand($seed);
 
    // Generate
    $str = '';
    $output_count = strlen($output);
    for ($i = 0; $length > $i; $i++) {
        $str .= $output{mt_rand(0, $output_count - 1)};
    }
 
    return $str;
}

