<?php
namespace Let\Crypt;

class PassWord
{

    public static $algo = PASSWORD_BCRYPT;

    public static $cost = 10;

    public static function rand($length = 8, $type = 'commen')
    {
        switch ($type) {
            case 'int':
                $array = range(0, 9);
                break;
            case 'lower':
                $array = range('a', 'z');
                break;
            case 'upper':
                $array = range('A', 'Z');
                break;
            case 'str':
                $array = array_merge(range('a', 'z'), range('A', 'Z'));
                break;
            case 'commen':
                $array = array_merge(range('a', 'z'), range('A', 'Z'), range(0, 9));
                break;
            case 'all':
                $array = array_merge(range('a', 'z'), range('A', 'Z'), range(0, 9), range('!', ')'));
                break;
        }
        
        return implode(array_rand(array_flip($array), $length));
    }

    public static function hash($password)
    {
        return password_hash(
            $password,
            self::$algo,
            ['cost' => self::$cost]
        );
    }

    public static function verify($password, $hash)
    {
        return password_verify($password, $hash);
    }

    public static function rehash($hash)
    {
        return password_needs_rehash(
            $hash,
            self::$algo,
            ['cost' => self::$cost]
        );
    }
}