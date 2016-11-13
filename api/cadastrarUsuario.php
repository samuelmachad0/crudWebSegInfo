<?php
require 'header.php';
try{
  $sql = $pdo->prepare('INSERT INTO usuarios(login,senha) VALUES(:login,:senha)');
  $sql->execute(array(
    ':login' => $_POST['login'],
	':senha' => sha1($_POST['senha'])
  ));
  
    print json_encode(['status' => 'sucesso']);

}catch (PDOException $e){
    echo 'Error: '. $e->getMessage();

}

?>