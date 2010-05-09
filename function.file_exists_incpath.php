<?php

/**
 * Check if a file exists in the include path
 *
 * @version     1.2.1
 * @author      Aidan Lister <aidan@php.net>
 * @link        http://aidanlister.com/2004/04/searching-for-files-in-the-include_path/
 * @param       string     $file       Name of the file to look for
 * @return      mixed      The full path if file exists, FALSE if it does not
 */
function file_exists_incpath ($file)
{
    $paths = explode(PATH_SEPARATOR, get_include_path());
 
    foreach ($paths as $path) {
        // Formulate the absolute path
        $fullpath = $path . DIRECTORY_SEPARATOR . $file;
 
        // Check it
        if (file_exists($fullpath)) {
            return $fullpath;
        }
    }
 
    return false;
}

