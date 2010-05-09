<?php

/**
 * A simple cycle class for alternating between strings.
 *
 * @author      Aidan Lister <aidan@php.net>
 * @version     1.0.1
 * @link        http://aidanlister.com/repos/v/Cycle.php
 */
class Cycle
{
    /**
     * Array of strings to be cycled
     *
     * @var     array
     */
    private $_args;


    /**
     * The current position in the stack
     *
     * @var     array
     */
    private $_key;
    

    /**
     * Constructor
     *
     * @param   overloader  Strings to be cycled through
     */
    function __construct()
    {
        $this->_args = func_get_args();
        $this->_key = -1;
    }
    

    /**
     * Convert to a string
     *
     * @return  string      The next string in the stack
     */
    function __toString()
    {
        return (string) isset($this->_args[$this->_key += 1]) ?
            $this->_args[$this->_key] :
            $this->_args[$this->_key = 0] ;
    }
}

