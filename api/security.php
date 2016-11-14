<?php
include('Crypt/RSA.php');

define("KEY_PRIVATE", "
-----BEGIN RSA PRIVATE KEY-----
MIIBOgIBAAJBAIHMFOuxQAGOcC4hxCB+jf3lrz169bUL45ZoJQPq3UhSwikIDgUv
Afh0w4/iLly73hKhrWJTxcoglPt/5+apU6MCAwEAAQJAGJdSRV9FGaZjYZIbJu7j
Nv3LqDHCGIWCnm3nyWi3eOqT3Oh2JIQnjGeqZQ6mdJfhGMht11q25yFSnUPH37Sz
fQIhAMAVcEGBXInNcjlaqxdwVn+UpCcDQG9H8t3JkXp28zO1AiEArPzLGuTH++S4
PNsawA5Qx0Shm8btBl7gWlS8empesPcCIQCGxoQdckcb6atb0uJ5b7lBi2oidYWg
jzs5o1UQOKYsgQIgLSTfoEoaQoti5UbMyVgzDn3DqxKT4ri51fkNIulFgusCIAgi
r/W0UGfei2RJVdTpO0cJUhp6cKvmW014jP2FsnIa
-----END RSA PRIVATE KEY-----");
function decrypt($msg) {
    $rsa = new Crypt_RSA();
    $rsa->setEncryptionMode(CRYPT_RSA_ENCRYPTION_PKCS1);
    $rsa->loadKey(KEY_PRIVATE, CRYPT_RSA_PRIVATE_FORMAT_PKCS1);
    $s = new Math_BigInteger($msg, 16);
    return $rsa->decrypt($s->toBytes());
}
?>