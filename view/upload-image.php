<?php  
date_default_timezone_set("America/Santo_Domingo");
$date = (getdate());
$FullDate = $date["year"].''.sprintf("%02d",$date["mon"]).''.sprintf("%02d",$date["mday"]);
$formId = $_REQUEST["code"];  
$fname = explode(' ',trim($_SESSION['srty_name']));

if($_SESSION["srtySession"] != "ok"){
 header('location: salir'); 
} 


/* Traducciones */
$prefix ='FR';
$sufix = rand(1000,9999);
$code = $prefix.date("Ymd-Hms").'-'.$sufix;


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
  <link rel="stylesheet" href="view/dist/css/adminlte.min.css">
<style>  
.Hideme{
	display:none;
}
</style>  
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
      <span class="brand-text font-weight-light"> Services </span>
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
          <li class="nav-item"><a href="formulario" class="nav-link active"><i class="nav-icon fas fa-folder-plus"></i><p> Nueva Solicitud </p></a></li>
          <li class="nav-item"><a href="solicitudes" class="nav-link"><i class="nav-icon fas fa-clipboard-list"></i><p> Solicitudes </p></a></li>
          <li class="nav-item"><a href="perfiles-depurados" class="nav-link"><i class="nav-icon fas fa-award"></i><p> Perfiles Aprobados</p></a></li>
          <li class="nav-item"><a href="perfiles-depurados" class="nav-link"><i class="nav-icon fas fa-ban"></i><p> Perfiles Rechazados</p></a></li>
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
				<a class="btn btn-default" href="" title="Recargar la página"><i class="fas fa-sync-alt"></i></a>
			 	<a class="btn btn-default" href="inicio" title="Menú principal"><i class="fas fa-home"></i> </a>
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
	<div class="row">
       <div class="col-md-8 mx-auto">
         <div class="card">
            <div class="card-header with-border">
              <h3 class="card-title"><i class="fa fa-upload"></i> Subir Imagen </h3>
            </div>
            <!-- /.box-header -->
            <div class="card-body">
			<input id="currentCode" type="hidden" value="<?php echo   $formId; ?>" />
		 
		 
		 <div class="form-group">
                       
                    <div class="input-group" style="display:none;">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="file">
                        <label class="custom-file-label" for="file"> Seleccione la imagen </label>
                      </div>
                    </div>
                  </div>
		 		  	<center><h3>Haz clic en el recuadro para subir la imagen</h3></center>
			<div class="col-md-6 mx-auto">
		
				<div class="text-center" id="uploadMe" style="padding: 10px; height:280px; width:415px; border:dashed 2px #ccc;">
					<span   id="uploaded_image">   <i class="fas fa-image fa-10x text-muted mt-4"></i></span>
				</div>
            </div>	
	   
            </div>
            <!-- /.box-body -->
			<div class="card-footer">
                <button id="btnFinish" type="buttom" class="btn btn-success btn-flat float-right">  <i class="fa fa-save"></i> Finalizar </button>
              </div>
			
          </div>
         
	  
	  </div>	
 
     </div>	
	
 
 
    </div><!-- /.content -->
  </div><!-- /.content-wrapper -->

 
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

$('#uploadMe').click(function(){
	$('#file').click();
});

$('#btnFinish').click(function(){
	location.href="index.php?ruta=perfil&code="+$('#currentCode').val();
	
});


$(document).on('change', '#file', function(){
	var name = document.getElementById("file").files[0].name;
	var form_data = new FormData();
	var ext = name.split('.').pop().toLowerCase();
  
 if(jQuery.inArray(ext, ['png','jpg','jpeg']) == -1) 
  {
	toastr.error('Archivo Invalido. Solo se permite jpg, png & jpeg');
  }else{
	var oFReader = new FileReader();
		oFReader.readAsDataURL(document.getElementById("file").files[0]);
		
	var f = document.getElementById("file").files[0];
	var fsize = f.size||f.fileSize;
  
	 if(fsize > 10000000)
		{
		 toastr.error('La imgen es muy Grande. Solo se permiten archivos de max 2MB');			
		}
	else
	{
		$('#uploaded_image').html();
		form_data.append("file", document.getElementById('file').files[0]);
		form_data.append("code", $('#currentCode').val());

   $.ajax({
		url:"model/upload.php",
		method:"POST",
		data: form_data,
		contentType: false,
		cache: false,
		processData: false,
		beforeSend:function(){
			//toastr.success('Subiendo Imagen de portada');	
		},   
			success:function(data){
			$('#uploaded_image').html(data);
			$('#uploadedCTRL').val(1);
			$('#next').prop('disabled', false);
			$('#t2').removeClass('Hideme');
			$('#t3').removeClass('Hideme');
		}
   });
  } //Fin del else 
	
		
	}
 }); 
 
</script>
</body>
</html>