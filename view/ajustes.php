<?php  
date_default_timezone_set("America/Santo_Domingo");
$date = (getdate());
$FullDate = $date["year"].''.sprintf("%02d",$date["mon"]).''.sprintf("%02d",$date["mday"]);

$fname = explode(' ',trim($_SESSION['srty_name']));

if($_SESSION["srtySession"] != "ok"){
 header('location: salir'); 
} 

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
  <link rel="stylesheet" href="view/plugins/toastr/toastr.min.css">
  <link rel="stylesheet" href="view/dist/css/adminlte.css">
 </head>
<body class="hold-transition sidebar-mini sidebar-collapse">
<div class="wrapper">
  <nav class="main-header navbar navbar-expand navbar-dark navbar-success">
    <ul class="navbar-nav">
      <li class="nav-item"><a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a></li>
    </ul>
    <ul class="navbar-nav ml-auto"></ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-success elevation-4">
    <a href="#" class="brand-link">
      <img src="view/dist/img/codeviLogo.png" alt="Campus CODEVI Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"> Reclutamiento </span>
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
          <li class="nav-item"><a href="solicitudes" class="nav-link"><i class="nav-icon fas fa-clipboard-list"></i><p> Solicitudes </p></a></li>
          <li class="nav-item"><a href="perfiles-depurados" class="nav-link"><i class="nav-icon fas fa-award"></i><p> Perfiles Aprobados</p></a></li>
          <li class="nav-item"><a href="perfiles-rechazados" class="nav-link"><i class="nav-icon fas fa-ban"></i><p> Perfiles Rechazados</p></a></li>
          <li class="nav-item"><a href="ajustes" class="nav-link active"><i class="nav-icon fas fa-cogs"></i><p> Ajustes </p></a></li>
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
 
 
 	
		<div class="row pt-3 optionPane">
         
		 <div class="col-sm-3 optionSelect" baseUrl="usuarios">
           <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-list"></i> </span>

              <div class="info-box-content">
                <span class="info-box-text">  </span>
                <span style="margin-top:12px;" class="info-box-number"> Usuairos </span>
              </div>
            </div>   
            </div>                
              
            <div class="col-sm-3 optionSelect" baseUrl="myuserprofile">
           <div class="info-box mb-3">
              <span class="info-box-icon  bg-success elevation-1"><i class="fas fa-id-badge"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">  </span>
                <span style="margin-top:12px;" class="info-box-number"> Mi cuenta </span>
              </div>
              <!-- /.info-box-content -->
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
$('.optionPane').on('click','div.optionSelect',function(){
	location.href=$(this).attr('baseUrl');
}); 

$('.chooseCT').click(function(){
	location.href=$(this).attr('optUrl');
});

</script>
</body>
</html>