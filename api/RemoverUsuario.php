<?php
require 'header.php';
try{

 $usuarioId =  decrypt($_POST['usuario_id']);
 $stmt = $pdo->prepare('DELETE FROM usuarios WHERE usuario_id = :id');
  $stmt->bindParam(':id', $usuarioId); 
  $stmt->execute();
    print json_encode(['status' => 'sucesso']);

}catch (PDOException $e){
    echo 'Error: '. $e->getMessage();

}

?>