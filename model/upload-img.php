<?php
session_start();
date_default_timezone_set("America/Santo_Domingo");

if($_FILES["file"]["name"] != '')
{
 $test = explode('.', $_FILES["file"]["name"]);
 $code = $_POST['code'];
 
 $ext = strtolower (end($test));
 $name = $code.'.'. $ext;
  
 $location = '../view/media/users/' . $name;  
 move_uploaded_file($_FILES["file"]["tmp_name"],$location);
 echo '<img class="img-fluid" src="view/media/users/'.$name.'" alt="User profile picture">';
}
?>