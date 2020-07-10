<?php
require_once "conexion.php";

if($_FILES["file"]["name"] != '')
{
 $test = explode('.', $_FILES["file"]["name"]);
 $code = $_POST['code'];
 
 $ext = strtolower (end($test));
 $name = $code.'.'. $ext;
 //$name = rand(100, 999) . '.' . $ext;
 $location = '../view/media/users/'.$name;  
 $location2 = 'view/media/users/'.$name;  
 
 move_uploaded_file($_FILES["file"]["tmp_name"],$location);
 
 
$stmt = Conexion::conectar()->prepare("UPDATE security.applications SET formimg='".$name."'  WHERE formid= '".$code."'");
if($stmt->execute()){
    echo '<img src="'.$location2.'" style="height:250px; width:auto; "   class="img-thumbnail" />';
}else{
  //$out['ok']  = 0;
  //$out['err'] = $stmt->errorInfo();
}
}
?>