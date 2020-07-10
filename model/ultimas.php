<?php 
session_start();
require_once "conexion.php";
require_once "data.php";

$stmt2 = Conexion::conectar()->prepare("SELECT * FROM ".DB_SCHEMA.".applications WHERE  formstatus = 0 ORDER BY formid DESC LIMIT 5 ");
$stmt2 -> execute();


while($results = $stmt2 -> fetch()){
	
	 $data = json_decode($results['formdata1'], true);
	 foreach ($data as $key => $value) {
		 $fullName = $value['frm_name'].' '.$value['frm_surname'];
	 }
	
echo '<li class="appOp" code="'.$results['formid'].'">
        <span class="handle ui-sortable-handle"><i class="far fa-address-card"></i></span>
        <span class="text"> '.$fullName.'  </span>
        <div class="tools"><small class="label label-primary"><i class="fas fa-calendar-alt"></i> '.$results['fromdate'].'  </small></div>
    </li>';
}								 
?>

 