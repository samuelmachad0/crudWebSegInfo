<?php
require 'header.php';
require 'curl.php';
require 'User_agent.php';

$curl = new Curl;
$response = $curl->get('https://ipinfo.io/'.$_SERVER['REMOTE_ADDR'].'/json', $vars = array()); 
$user = json_decode($response->body);

$a = new CI_User_agent();
if ($a->is_browser())
{
        $agent = $a->browser().' '.$a->version();
}
elseif ($a->is_robot())
{
        $agent = $a->robot();
}
elseif ($a->is_mobile())
{
        $agent = $a->mobile();
}
else
{
        $agent = 'Unidentified User Agent';
}


try{
  $sql = $pdo->prepare('INSERT INTO log(log_data,log_ip,log_navegador,log_sistema,log_hostname,log_city,log_region,log_country,log_loc,log_orc,log_info) VALUES(:data,:ip,:navegador,:sistema,:hostname,:city,:region,:country,:loc,:orc,:info)');
  $sql->execute(array(
    ':data' => date('Y-m-d H:i:s'),
	':ip' => $_SERVER['REMOTE_ADDR'],
	':navegador' => $agent,
	':sistema' => $a->platform(),
	':hostname' => $user->hostname,
	':city' => utf8_decode($user->city),
	':region' => $user->region,
	':country' => $user->country,
	':loc' => $user->loc,
	':orc' => $user->org,
	':info' => utf8_decode('Cadastrou o usuário 5')

  ));
  
   

}catch (PDOException $e){
    echo 'Error: '. $e->getMessage();

}
?>