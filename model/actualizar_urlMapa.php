<?php 
require_once "conexion.php";
require_once "data.php";

$id = $_REQUEST["id"];
$url = $_REQUEST["addr"]; 

$stmt = Conexion::conectar()->prepare("UPDATE ".DB_SCHEMA.".applications SET formmapurl = '".$url."' WHERE  formid = '".$id."'");
if($stmt->execute()){
   $out['ok'] = 1;
}else{
  $out['ok']  = 0;
  $out['err'] = $stmt->errorInfo();
}
echo json_encode($out); 
?>