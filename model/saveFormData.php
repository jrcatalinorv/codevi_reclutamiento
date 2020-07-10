<?php 
session_start();
require_once "conexion.php";
require_once "data.php";

$formId = $_REQUEST["frCode"]; 
$emplId = $_REQUEST["frEmplId"];
$formData1 = $_REQUEST["frData1"]."";
$formData2 = $_REQUEST["frData2"]."";
$formData3 = $_REQUEST["frData3"]."";
$formData4 = $_REQUEST["frData4"]."";
$formData5 = $_REQUEST["frData5"]."";
$formimg = 'user.png';
$fromDate = date("Y-m-d");
$formHour = date('H:i:s');	
$formLocation = $_REQUEST['frloc']; 
$formStatus  = 0; 	


/* -------------------------------------------------------------------- */
/* Insertar datos en la tabla servicio                            */ 
/* -------------------------------------------------------------------- */

  $stmt2 = Conexion::conectar()->prepare("INSERT INTO ".DB_SCHEMA.".applications (formid, emplid, formdata1, formdata2, formdata3, formdata4, formdata5, fromdate,formhour, formlocation,formstatus,formimg) 
  VALUES (:formid,:emplid,:formdata1,:formdata2,:formdata3,:formdata4,:formdata5,:fromdate,:formhour,:formlocation,:formstatus,:formimg)");
  
  $stmt2->bindParam(":formid",$formId, PDO::PARAM_STR);
  $stmt2->bindParam(":emplid",$emplId, PDO::PARAM_STR);
  $stmt2->bindParam(":formdata1",$formData1, PDO::PARAM_STR);
  $stmt2->bindParam(":formdata2",$formData2, PDO::PARAM_STR);
  $stmt2->bindParam(":formdata3",$formData3, PDO::PARAM_STR);
  $stmt2->bindParam(":formdata4",$formData4, PDO::PARAM_STR);
  $stmt2->bindParam(":formdata5",$formData5, PDO::PARAM_STR);
  $stmt2->bindParam(":fromdate",$fromDate, PDO::PARAM_STR);
  $stmt2->bindParam(":formhour",$formHour, PDO::PARAM_STR);
  $stmt2->bindParam(":formlocation",$formLocation, PDO::PARAM_STR);
  $stmt2->bindParam(":formimg",$formimg, PDO::PARAM_STR);
  $stmt2->bindParam(":formstatus",$formStatus, PDO::PARAM_INT);
 
/* -------------------------------------------------------------------- */
if($stmt2->execute()){	  
 $out['ok'] = 1;
 $out['code'] = $formId;
}else{
  $out['ok'] = 0;
  $out['err'] = $stmt2->errorInfo();
}	
 
 
echo json_encode($out); 
?>

 