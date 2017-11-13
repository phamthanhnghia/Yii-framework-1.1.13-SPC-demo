<?php

class Helper
{
    // validate a string before insert to database
    public static function toRegularString($string)
    {
        if (!is_string($string))
            return null;
        return mysql_real_escape_string($string);
    }

    // validate a phone number
    public static function isPhone($phone)
    {
        if (!is_string($phone))
            return false;
        if (preg_match("/^([1]-)?[0-9]{3}-[0-9]{3}-[0-9]{4}$/i", $phone))
            return true;
        return false;
    }

    // validate a email address
    public static function isEmail($email)
    {
        if (!is_string($email))
            return false;
        if (preg_match("/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/i",
            $email))
            return true;
        return false;
    }

    // Name must be from letters, dashes, spaces and must not start with dash
    public static function isName($string)
    {
        if (preg_match("/^[A-Z][a-zA-Z -]+$/", $string) === 0)
            return false;
        return true;
    }

    // Passport must be 10 or 12 digits
    public static function isPassport($string)
    {
        if (preg_match("/^d{10}$|^d{12}$/", $string) === 0)
            return false;
        return true;
    }

    // Zip must be 4 digits
    public static function isZip($string)
    {
        if (preg_match("/^d{4}$/", $string) === 0)
            return false;
        return true;
    }

    // User must be bigger that 5 chars and contain only digits, letters and underscore
    public static function isUser($string)
    {
        if (preg_match("/^[0-9a-zA-Z_]{5,}$/", $string) === 0)
            return false;
        return true;
    }

    // Password must be at least 8 characters and must contain at least one lower case letter, one upper case letter and one digit
    public static function isPassword($string)
    {
        if (preg_match("/^.*(?=.{8,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/", $string)
            === 0)
            return false;
        return true;
    }

    public static function GetImageFromUrl($link)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_POST, 0);

        curl_setopt($ch, CURLOPT_URL, $link);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($ch);

        curl_close($ch);

        return $result;
    }

}


?>
