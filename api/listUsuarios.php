<?php
require 'header.php';

$consulta = $pdo->query("SELECT * FROM usuarios");
$lista = [];
while($row = $consulta ->fetch(PDO::FETCH_OBJ)){
	$usuario = ['usuario_id' => $row->usuario_id, 'nome' => $row->login];
	array_push($lista,$usuario);
}


	echo json_encode($lista);
