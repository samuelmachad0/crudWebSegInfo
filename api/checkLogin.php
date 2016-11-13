<?php
require 'header.php';


$login = decrypt($_POST['login']);
$senha = decrypt($_POST['senha']);

$consulta = $pdo->query("SELECT * FROM usuarios WHERE login ='".$login."' AND senha = '".sha1($senha)."'");

$linha = $consulta->fetch(PDO::FETCH_ASSOC);

$dados = ['usuario_id'=> $linha['usuario_id'],'nome' => $linha['login'], 'status' => 'sucesso'];

if(isset($linha['usuario_id'])){
	echo json_encode($dados);
} else { 
	echo json_encode(['status' => 'erro']); 
}
