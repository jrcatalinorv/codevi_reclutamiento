<?php 
session_start();

//if($_FILES["file"]["name"] != ''){
 //$test = explode('.', $_FILES["file"]["name"]);
 //$code = $_POST['code'];
 
 //$ext = strtolower (end($test));
 //$name = strtolower ($test[0]).'.'. $ext;
  
// $location = '../view/media/users/'. $name;  
move_uploaded_file($_FILES["file"]["tmp_name"],$location);
 echo '<img class="profile-user-img img-fluid" src="view/media/users/photo.jpg" alt="User profile picture">';
}
?>

 