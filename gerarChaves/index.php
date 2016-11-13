<?php
require_once('phpseclib/Crypt/RSA.php');
define('CRYPT_RSA_MODE', CRYPT_RSA_MODE_INTERNAL);
$rsa = new Crypt_RSA();
$rsa->setPublicKeyFormat(CRYPT_RSA_PUBLIC_FORMAT_RAW);
$key = $rsa->createKey(512);
echo $key['privatekey'];
echo "\n";
$e = new Math_BigInteger($key['publickey']['e'], 10);
$n = new Math_BigInteger($key['publickey']['n'], 10);
echo "Public Key:\n";
echo $e->toHex();
echo "\n";
echo $n->toHex();
?>