<?php
require 'header.php';
try{


 $stmt = $pdo->prepare('DELETE FROM usuarios WHERE usuario_id = :id');
  $stmt->bindParam(':id', decrypt($_POST['usuario_id'])); 
  $stmt->execute();
    print json_encode(['status' => 'sucesso']);

}catch (PDOException $e){
    echo 'Error: '. $e->getMessage();

}

?>