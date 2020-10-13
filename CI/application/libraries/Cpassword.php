<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cpassword {
    public function encrypt($password) {
        # Add PKCS7 padding.
        $str = $password;
        $EncKey = "basuki24"; //For security
        $block = mcrypt_get_block_size('des', 'ecb');
        if (($pad = $block - (strlen($str) % $block)) < $block) {
        $str .= str_repeat(chr($pad), $pad);
        }
        return base64_encode(mcrypt_encrypt(MCRYPT_DES, $EncKey, $str, MCRYPT_MODE_ECB));
    }
    function decrypt($str)
    {
        $EncKey = "basuki24";
        $str = mcrypt_decrypt(MCRYPT_DES, $EncKey, base64_decode($str), MCRYPT_MODE_ECB);
        # Strip padding out.
        $block = mcrypt_get_block_size('des', 'ecb');
        $pad = ord($str[($len = strlen($str)) - 1]);
        if ($pad && $pad < $block && preg_match(
        '/' . chr($pad) . '{' . $pad . '}$/', $str
        )
        ) {
        return substr($str, 0, strlen($str) - $pad);
        }
        return $str;
    }
}