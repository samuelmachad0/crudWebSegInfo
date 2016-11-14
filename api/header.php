<?php
require 'security.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
date_default_timezone_set('America/Sao_Paulo');
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
$pdo = new PDO('mysql:host=localhost;dbname=crudWebSegInfo', 'crudWebSegInfo', 'p1p0c@s');

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>