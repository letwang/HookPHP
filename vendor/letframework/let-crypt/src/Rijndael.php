<?php
namespace Let\Crypt;

class Rijndael
{

    protected $_key;

    protected $_iv;

    public function __construct($key, $iv)
    {
        $this->_key = $key;
        $this->_iv = base64_decode($iv);
    }

    public function encrypt($plaintext)
    {
        $length = (ini_get('mbstring.func_overload') & 2) ? mb_strlen($plaintext, ini_get('default_charset')) : strlen($plaintext);
        
        if ($length >= 1048576)
            return false;
        return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $this->_key, $plaintext, MCRYPT_MODE_ECB, $this->_iv)) . sprintf('%06d', $length);
    }

    public function decrypt($ciphertext)
    {
        if (ini_get('mbstring.func_overload') & 2) {
            $length = intval(mb_substr($ciphertext, - 6, 6, ini_get('default_charset')));
            $ciphertext = mb_substr($ciphertext, 0, - 6, ini_get('default_charset'));
            return mb_substr(mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $this->_key, base64_decode($ciphertext), MCRYPT_MODE_ECB, $this->_iv), 0, $length, ini_get('default_charset'));
        } else {
            $length = intval(substr($ciphertext, - 6));
            $ciphertext = substr($ciphertext, 0, - 6);
            return substr(mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $this->_key, base64_decode($ciphertext), MCRYPT_MODE_ECB, $this->_iv), 0, $length);
        }
    }
}
