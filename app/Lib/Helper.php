<?php

namespace App\Lib;

class Helper
{
    /**
     * this function will sanitize $data
     * with trim(), htmlspecialchars() 
     * and stripcslashes() function
     *
     * @param $data
     * @return string
     */
    public static function sanitize($data)
    {
        $data = trim($data);
        $data = htmlspecialchars($data);
        $data = stripcslashes($data);
        return $data;
    }
}
