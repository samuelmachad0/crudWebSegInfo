<?php
require 'header.php';
try{
    $usuarioId = decrypt($_POST['usuario_id']);
    $login = decrypt($_POST['login']);
    $senha = decrypt($_POST['senha']);

    if(!isset($usuarioId)){
    	print json_encode(['status' => 'erro']);
    	exit(1);
    }
    if(isset($login)){
    $consulta = 'login = "'.$login.'" ';
    }
    
    if(isset($senha) && $senha != '123456'){
     $consulta = $consulta.', senha= "'.sha1($senha).'" ';
    }  
    

    $sql = $pdo->prepare("UPDATE usuarios SET ".$consulta." WHERE usuario_id = ".$usuarioId);
    $sql->execute();
    print json_encode(['status' => 'sucesso']);

}catch (PDOException $e){
    echo 'Error: '. $e->getMessage();

}

?>