<?php

/**
 * Obfuscate an email address
 *
 * @author      Aidan Lister <aidan@php.net>
 * @version     1.1.0
 * @link        http://aidanlister.com/2004/04/quick-javascript-email-obfuscation/
 * @param       string      $email      E-mail
 * @param       string      $text       Text
 */
function mail_obfuscate($email, $text = '')
{
    // Default text
    if (empty($text)) {
		$text = $email;
    }
    
    // Create string
    $string = sprintf('document.write(\'<a href="mailto:%s">%s</a>\');',
            htmlspecialchars($email),
            htmlspecialchars($text));

    // Encode    
    for ($encode = '', $i = 0; $i < strlen($string); $i++) {
        $encode .= '%' . bin2hex($string[$i]);
    }

    // Javascript
    $javascript = '<script language="javascript">eval(unescape(\'' . $encode . '\'))</script>';

    return $javascript;
}

