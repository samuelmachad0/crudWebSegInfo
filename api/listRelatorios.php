<?php
require 'header.php';
   function dataf($d) {
        $data=explode(' ',$d);
        return date('d/m/y',strtotime($data[0])).' '.$data[1];

    }
$consulta = $pdo->query("SELECT l.*,u.login FROM log as l INNER JOIN usuarios as u where u.usuario_id = l.usuario_id order by log_id DESC");
$lista = [];
while($row = $consulta ->fetch(PDO::FETCH_OBJ)){
	$usuario = [
				'id' =>$row->log_id,
				'data' => dataf($row->log_data),
				 'ip' => $row->log_ip,
				 'navegador' => $row->log_navegador,
				 'so' => $row->log_sistema,
				 'hostname' => $row->log_hostname,
				 'cidade' => utf8_encode($row->log_city),
				 'estado' => $row->log_region,
				 'usuario_id' => $row->login,
				 'pais' => $row->log_country,
				 'localizacao' => $row->log_loc,
				 'organizacao' => $row->log_orc,
				 'informacoes' => utf8_encode($row->log_info) 

				 ];
	array_push($lista,$usuario);
}


	echo json_encode($lista);
