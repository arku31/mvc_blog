<?php
namespace App\Core;

class Hash
{
    /**
     * @param $stringToEncrypt
     * @return string
     */
    public static function make($stringToEncrypt)
    {
        return sha1($stringToEncrypt);
    }
}