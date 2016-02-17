<?php

namespace Tests\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\ViewEvent;
use Zend\Crypt\PublicKey\RsaOptions;

class SecurityController extends AbstractActionController {
    /**
     * Testing crypt method
     *
     * @return boolean
     */
    public function s2Action() {
        //var_dump(mcrypt_cbc(MCRYPT_3DES, "e5q3sqsd3q5s432q2dsd", "rrrrr", MCRYPT_ENCRYPT));
        var_dump(crypt("seif", "12qsd543qs21d5"));
        \Zend\Debug\Debug::dump(hash_equals('12KVdQaAJtr5Y', crypt("seif", "12qsd543qs21d5")));
        \Zend\Debug\Debug::dump('12KVdQaAJtr5Y' === crypt("seif", "12qsd543qs21d5"));
        return false;
    }

    /**
     * Encryption test /Cryptography/ Symmetric Key
     *
     * @return boolean
     */
    public function s3Action() {
        $blockCipher = \Zend\Crypt\BlockCipher::factory('mcrypt', array('algo' => 'blowfish'));
        $blockCipher->setKey('a4s5c8r25t');
        $result      = $blockCipher->encrypt('This is a secret message');
        echo "Encrypted text: $result \n";
        return false;
    }

    /**
     * Decryption test/Cryptography/Symmetric Key
     *
     * @return boolean
     */
    public function s4Action() {
        $blockCipher = \Zend\Crypt\BlockCipher::factory('mcrypt', array('algo' => 'blowfish'));
        $blockCipher->setKey('a4s5c8r25t');
        $result      = $blockCipher->decrypt('05e1760a0b0e4ebcada37ead3335eba8efb1c224c7a2baaf9f2acfece8e553ceUcDjNHQVPJgxiNliFcB+/ppsTWWe3JhHOeQtBFhAmQ6VFE2Aj7ulnQ==');
        echo "Decrypted text: $result \n";
        return false;
    }

    /**
     * Bcrypt/Apache test
     *
     * @return boolean
     */
    public function s5Action() {
        $bcrypt = new \Zend\Crypt\Password\Bcrypt();
        //$bcrypt->setSalt("1234567891123456");
        $bcrypt->setCost("11");
        echo $bcrypt->create("seif");
        \Zend\Debug\Debug::dump($bcrypt->verify("seif", '$2y$10$MpYUnNcqtRdlMli2Y6qTnOmJeRkKYB8oRAgs57hwo0SP52XQ4.cU6'));
        \Zend\Debug\Debug::dump($bcrypt->verify("seif", '$2y$11$MTIzNDU2Nzg5MTEyMzQ1NeGPn/0xSlbbtwyPKq9OsnRa0ntCiPHsi'));
        $apache = new \Zend\Crypt\Password\Apache();
        $apache->setFormat('crypt');
        \Zend\Debug\Debug::dump($apache->create('seif'));
        return false;
    }

}
