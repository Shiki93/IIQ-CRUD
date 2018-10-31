<?php
class bz_crypt {
    const
      PASSWORD_SALT_LENGTH          = 8,
      PASSWORD_DIGEST_ALGORITHM     = 'sha256';
    
    public function getHash($password, $salt = null, $algorithm = null) {
        $algorithm = null;
        
        if (is_null($salt)) {
            $salt       = $this->generateRandomPassword(self::PASSWORD_SALT_LENGTH);
            $algorithm  = self::PASSWORD_DIGEST_ALGORITHM;
        }
        return crypt($password, $salt);
    }

    public function generateRandomPassword($length = 8) {
        $saltchars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz./';
        $salt = '';
        for ($i=0 ; $i < self::PASSWORD_SALT_LENGTH ; $i++ ) {
            $salt .= $saltchars[rand(0,63)];
        }
        return $salt;
    }
}