<?php 
require_once "conexion.php";
require_once "data.php";

$id = $_REQUEST["id"];
$status = $_REQUEST["st"]; 

$stmt = Conexion::conectar()->prepare("UPDATE ".DB_SCHEMA.".applications SET formstatus = ".$status." WHERE  formid = '".$id."'");
if($stmt->execute()){
   $out['ok'] = 1;
}else{
  $out['ok']  = 0;
  $out['err'] = $stmt->errorInfo();
}
echo json_encode($out); 
?>