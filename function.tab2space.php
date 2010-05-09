<?php

/**
 * Converts tabs to the appropriate amount of spaces while preserving formatting
 *
 * @author      Aidan Lister <aidan@php.net>
 * @version     1.2.0
 * @link        http://aidanlister.com/2004/04/handling-tab-to-space-conversions/
 * @param       string    $text     The text to convert
 * @param       int       $spaces   Number of spaces per tab column
 * @return      string    The text with tabs replaced
 */
function tab2space ($text, $spaces = 4)
{
    // Explode the text into an array of single lines
    $lines = explode("\n", $text);
 
    // Loop through each line
    foreach ($lines as $line) {
 
        // Break out of the loop when there are no more tabs to replace
        while (false !== $tab_pos = strpos($line, "\t")) {
 
            // Break the string apart, insert spaces then concatenate
            $start = substr($line, 0, $tab_pos);
            $tab   = str_repeat(' ', $spaces - $tab_pos % $spaces);
            $end   = substr($line, $tab_pos + 1);
            $line  = $start . $tab . $end;
        }
 
        $result[] = $line;
    }
 
    return implode("\n", $result);
}

