<?php 
session_start();

  if(isset($_SESSION["srtySession"]) && $_SESSION["srtySession"] == "ok"){
    if(isset($_GET["ruta"])){
      if($_GET["ruta"] == "home" ||
		 $_GET["ruta"] == "solicitudes" ||
		 $_GET["ruta"] == "formulario-do" ||
		 $_GET["ruta"] == "formulario-ht" ||
		 $_GET["ruta"] == "upload-image" ||
		 $_GET["ruta"] == "perfiles-depurados" ||
		 $_GET["ruta"] == "perfiles-rechazados" ||
		 $_GET["ruta"] == "perfil" ||
		 $_GET["ruta"] == "ajustes" ||
		 $_GET["ruta"] == "usuarios" ||
         $_GET["ruta"] == "salir"){
        include "".$_GET["ruta"].".php";
      }else{
        include "404.php";
      }
    }else{
      include "home.php";
    }
  }else{
    include "login.php";
  }
?> 