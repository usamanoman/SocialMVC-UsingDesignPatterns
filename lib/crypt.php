<?php

/**
 * Class Crypt - AES-256/ECB
 * Config required: define('APP_CRYPT', true);
 * Config required: define('CRYPT_KEY', 'secret key');
 */
class Crypt {

    private static $key;
    private static $iv;

    /**
     * Encrypt string with key
     * Example: $string = Crypt::decrypt($hash, CRYPT_KEY);
     * @param $data
     * @param $key
     * @return string
     */
    public static function encrypt($data, $key) {
        self::iv($key);
        return bin2hex(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, self::$key, $data, MCRYPT_MODE_ECB, self::$iv));
    }

    /**
     * Encrypt string with key
     * Example: $hash = Crypt::encrypt($string, CRYPT_KEY);
     * @param $data
     * @param $key
     * @return string
     */
    public static function decrypt($data, $key) {
        self::iv($key);
        return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, self::$key, hex2bin($data), MCRYPT_MODE_ECB, self::$iv));
    }

    /**
     * Setup key and initialization vector
     * @param $key
     */
    private static function iv($key) {
        self::$key = hash('sha256', $key, true);
        self::$iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_DEV_URANDOM);
    }

}
