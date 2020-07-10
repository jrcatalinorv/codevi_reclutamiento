<?php  
date_default_timezone_set("America/Santo_Domingo");
$date = (getdate());
$FullDate = $date["year"].''.sprintf("%02d",$date["mon"]).''.sprintf("%02d",$date["mday"]);

$fname = explode(' ',trim($_SESSION['srty_name']));

if($_SESSION["srtySession"] != "ok"){
 header('location: salir'); 
} 

$_SESSION["pageBack"] = "solicitudes";

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Campus CODEVI</title>
  <link rel="icon" type="image/png" href="favicon.ico"/>
  <link rel="stylesheet" href="view/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="view/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="view/plugins/toastr/toastr.min.css">
  <link rel="stylesheet" href="view/dist/css/adminlte.css">
 </head>
<body class="hold-transition sidebar-mini sidebar-collapse">
<div class="wrapper">
  <nav class="main-header navbar navbar-expand navbar-dark navbar-success">
    <ul class="navbar-nav">
      <li class="nav-item"><a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a></li>
      <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-clipboard-list"></i> Solicitudes </a></li>
    </ul>
    <ul class="navbar-nav ml-auto"></ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-success elevation-4">
    <a href="#" class="brand-link">
      <img src="view/dist/img/codeviLogo.png" alt="Campus CODEVI Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"> Reclutamiento  </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image"><img src="view/dist/img/users/<?php echo $_SESSION['srty_userImg']; ?>" class="img-circle elevation-2" alt="User Image"> </div>
        <div class="info"><a href="#" class="d-block"> <?php echo $_SESSION['srty_user']; ?> </a> </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item"><a href="home" class="nav-link"><i class="nav-icon fas fa-home"></i><p> Inicio </p></a></li>
          <li class="nav-item"  data-toggle="modal" data-target="#modal-default"><a href="#" class="nav-link"><i class="nav-icon fas fa-folder-plus"></i><p> Nueva Solicitud </p></a></li>
          <li class="nav-item"><a href="solicitudes" class="nav-link active"><i class="nav-icon fas fa-clipboard-list"></i><p> Solicitudes </p></a></li>
          <li class="nav-item"><a href="perfiles-depurados" class="nav-link"><i class="nav-icon fas fa-award"></i><p> Perfiles Aprobados</p></a></li>
          <li class="nav-item"><a href="perfiles-rechazados" class="nav-link"><i class="nav-icon fas fa-ban"></i><p> Perfiles Rechazados</p></a></li>
          <li class="nav-item"><a href="ajustes" class="nav-link"><i class="nav-icon fas fa-cogs"></i><p> Ajustes </p></a></li>
		  <li class="nav-item"><a href="salir" class="nav-link"><i class="nav-icon fas fa-sign-out-alt text-danger"></i><p> Salir</p></a></li>
		</ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
		           <input id="stdate" type="hidden" value="<?php echo date("Y-m-d", strtotime("first day of this month")); ?>" />
           <input id="nddate" type="hidden" value="<?php echo date("Y-m-d", strtotime("last day of this month")); ?>" />
		<div class="col-sm-6">
					<div class="btn-group">
				
			 	<a class="btn btn-default" href="home" title="Menú principal"><i class="fas fa-home"></i> </a>
				<a class="btn btn-default" href="" title="Recargar la página"><i class="fas fa-sync-alt"></i></a>
			 </div>	
		
		</div>
		
		
          <div class="col-sm-6">
	 
<h6 class="float-right">
			<?php 
				$hour = (getdate());
					if($hour["hours"] >= 6 && $hour["hours"] <=12 ){$Saludo = "Buenos Días";   echo '<b><span class="text-info">' .$Saludo.' '.$fname[0].'</span></b>';}
					if($hour["hours"] >= 13 && $hour["hours"] <= 18){$Saludo = "Buenas Tardes"; echo '<b><span class="text-success">'.$Saludo.' '.$fname[0].'</span></b>';}
					if($hour["hours"] >= 19 && $hour["hours"] <= 23 ){$Saludo = "Buenas Noches"; echo '<b><span class="text-muted">' .$Saludo.' '.$fname[0].'</span></b>';}
					if($hour["hours"] >=  0 && $hour["hours"] <= 5 ){$Saludo = "Buenas Noches"; echo '<b><span class="text-muted">' .$Saludo.' '.$fname[0].'</span></b>';}
			?>
		 
          </h6>
			
          </div><!-- /.col -->
       
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">	
		<div class="row">
		<!-- Datos personales --> 
         <div class="card col-md-12 p-0">
           
            <div class="card-body ">
 <table class="table table-striped">
                  <thead>
                    <tr>
                      <th> Fecha de Solicitud </th>
                      <th> Nombre </th>
                      <th> Cedula </th>
                      <th class="text-center"> Genero </th>
                      <th> Edad </th>
                      <th> Nacionalidad </th>
                      <th  align="center" > Foto  </th>
                      <th> Acciones </th>
                    </tr>
                  </thead>
                  <tbody id="fromList">
 <?php 
require_once "model/conexion.php";
require_once "model/data.php";

$stmt2 = Conexion::conectar()->prepare("SELECT * FROM ".DB_SCHEMA.".applications  WHERE  formstatus = 0 ORDER BY fromdate");
$stmt2 -> execute();
while($results = $stmt2 -> fetch()){
	
$data1 = json_decode($results['formdata1'], true);	
 foreach ($data1 as $key => $value) {
		 $frm_name = $value['frm_name'].''.$value['frm_surname'];
		 $frm_addr = $value['frm_addr'];
		 $frm_cedula = $value['frm_cedula'];
		 $frm_phone = $value['frm_phone'];
		 $frm_gender = $value['frm_gr'];
		 $frm_bday = $value['frm_bday'];
		 $frm_nac = $value['frm_nac'];
		 $frm_age = getAge($frm_bday);		 
}
	 	
	
	echo "<tr>";
		echo "<td> ".date("d/m/Y", strtotime($results['fromdate']))."</td>";
		echo "<td> ".$frm_name ."</td>";
		echo "<td> ".$frm_cedula."</td>";
		echo '<td align="center">'.$frm_gender.'</td>';
		echo "<td> ".$frm_age." </td>";
		echo "<td> ". $frm_nac."</td>";
		echo '<td><img style="width:40px; height:40px;" src="view/media/users/'.$results["formimg"].'" class="img-circle elevation-2"> </td>';

		echo '<td> <button class="btn btn-info btn-sm chooseMe" frId="'.$results['formid'].'"> <i class="far fa-address-card"></i> Ver Perfil </button> </td>';
	echo "</tr>";
	
	
}

 ?>                    
                  </tbody>
                </table>
          </div>
        </div>	
        </div>	
    </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include_once "modalCt.php"; ?>

 
  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
       version <?echo $_SESSION['service_version']; ?>
    </div>
    <!-- Default to the left -->
    <strong>Campus CODEVI &copy; 2020
  </footer>
</div>
<!-- ./wrapper -->
<script src="view/plugins/jquery/jquery.min.js"></script>
<script src="view/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="view/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="view/dist/js/adminlte.min.js"></script>
<script src="view/plugins/toastr/toastr.min.js"></script>
<script type="text/javascript">
$('#fromList').on('click','button.chooseMe',function(){
	location.href="index.php?ruta=perfil&code="+$(this).attr('frId');;		 
});

$('.chooseCT').click(function(){
	location.href=$(this).attr('optUrl');
});
</script>
</body>
</html>
<?php 

function getAge($bday){
$now = time();	
$dob = strtotime(date("Y-m-d", strtotime($bday)));
$difference = $now - $dob;
$age = floor($difference / 31556926);

return $age;	
}


?>