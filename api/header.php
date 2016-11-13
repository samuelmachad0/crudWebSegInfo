<?php
require 'security.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");

$pdo = new PDO('mysql:host=localhost;dbname=bancotestapi', 'usertestbanco', 'senhaboa');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>