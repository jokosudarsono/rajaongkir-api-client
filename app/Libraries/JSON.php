<?php

namespace App\Libraries;

/**
 * Simple Library for JSON
 */
class JSON
{
    /**
     * JSON Parser
     *
     * @param string $data
     * @param boolean $isArray
     * @return Object | Array
     */
    public static function parse($data, $isArray = false)
    {
        return $isArray ? json_decode($data, true) : json_decode($data);
    }

    /**
     * JSON Encoding
     *
     * @param Object | Array $data
     * @return String | JSON
     */
    public static function encode($data)
    {
        return json_encode($data, JSON_HEX_APOS);
    }
}