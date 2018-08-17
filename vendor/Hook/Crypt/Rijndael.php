<?php
namespace Hook\Crypt;

class Rijndael
{
    public static function encrypt(string $data): string
    {
        $encrypted = openssl_encrypt(
            $data,
            APP_CONFIG['openssl']['method'],
            APP_CONFIG['openssl']['password'],
            OPENSSL_RAW_DATA,
            APP_CONFIG['openssl']['iv']
        );
        return base64_encode($encrypted);
    }

    public static function decrypt(string $data): string
    {
        return openssl_decrypt(
            $data,
            APP_CONFIG['openssl']['method'],
            APP_CONFIG['openssl']['password'],
            0,
            APP_CONFIG['openssl']['iv']
        );
    }
}
