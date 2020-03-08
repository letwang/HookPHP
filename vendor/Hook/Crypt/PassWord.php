<?php
namespace Hook\Crypt;

class PassWord
{

    public static int $algo = PASSWORD_ARGON2I;

    public static int $cost = 10;

    public static function hash($password)
    {
        return password_hash($password, self::$algo, ['cost' => self::$cost]);
    }

    public static function verify($password, $hash)
    {
        return password_verify($password, $hash);
    }

    public static function rehash($hash)
    {
        return password_needs_rehash($hash, self::$algo, ['cost' => self::$cost]);
    }
}