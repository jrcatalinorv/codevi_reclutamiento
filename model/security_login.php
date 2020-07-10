<?php 
session_start();
require_once "conexion.php";
require_once "data.php";

 
$usr = strtolower ($_REQUEST["usr"]);
$pass = crypt($_REQUEST["pass"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

$stmt2 = Conexion::conectar()->prepare("SELECT * FROM ".DB_SCHEMA.".usuarios where username ='".$usr."' and password = '".$pass."'");
$stmt2 -> execute();
$results = $stmt2 -> fetch();
										
if($results['username']==$usr && $results['password']==$pass){	
 
 $_SESSION['srty_userId'] = $results['id'];  
 $_SESSION['srty_name'] = $results['name'];
 $_SESSION['srty_user'] = $results['username'];
 $_SESSION['srty_business_unit'] = $results['business_unit'];
 $_SESSION['srty_perfil']= $results['profile'];
 $_SESSION['srty_userImg']= 'user.png';
 $_SESSION["srtySession"] = 'ok';

 $out['ok'] = 1;
 $out['status'] = $results['status'];

}else{
	$out['ok'] = 0;
}
echo json_encode($out); 
?>

 