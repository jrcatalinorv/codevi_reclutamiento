<?php  
date_default_timezone_set("America/Santo_Domingo");
require_once "model/conexion.php";
require_once "model/data.php";

$frmd = $_REQUEST['code']; 

$stmt2 = Conexion::conectar()->prepare("SELECT * FROM ".DB_SCHEMA.".applications WHERE formid = '".$frmd ."'");
$stmt2 -> execute();

/*
SELECT formid, emplid, formdata, fromdate, formhour, formlocation, formstatus, formimg
	FROM security.applications;
*/
if($results = $stmt2 -> fetch()){

$imgUrl = $results['formimg'];
$mapaUrl = 	$results['formmapurl'];
$data1 = json_decode($results['formdata1'], true);
$data2 = json_decode($results['formdata2'], true);
$data3 = json_decode($results['formdata3'], true);
$data4 = json_decode($results['formdata4'], true);
$data5 = json_decode($results['formdata5'], true);
$status = $results['formstatus'];

 foreach ($data1 as $key => $value) {
		 $frm_name = $value['frm_name']; 
		 $apellidos = $value['frm_surname'];
		 $frm_addr = $value['frm_addr'];
		 $frm_cedula = $value['frm_cedula'];
		 $frm_phone = $value['frm_phone'];
		 $frm_pbirth = $value['frm_pbirth'];
		 $frm_gender = $value['frm_gr'];
		 $frm_bday = $value['frm_bday'];
		 $frm_nac = $value['frm_nac'];
		 $frm_civilstatus = $value['frm_cs'];
		 $frm_email = $value['frm_email'];		 
		 $frm_twitter = $value['frm_twitter'];		 
		 $frm_instagram = $value['frm_instagram'];		 
		 $frm_facebook = $value['frm_facebook'];		 
	 }
	 

 foreach ($data5 as $key => $value5) {
		 $rec_nombre = $value5['rec_nombre']; 
		 $rec_empresa = $value5['rec_empresa']; 
		 $emr_nombre = $value5['emr_nombre'];
		 $emr_direccion = $value5['emr_direccion'];
		 $emr_parentezco = $value5['emr_parentezco'];
		 $emr_telefono = $value5['emr_telefono'];
	}
	
$ExtraImg = 0;	
	
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
  <link rel="stylesheet" href="view/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="view/plugins/toastr/toastr.min.css">
  <link rel="stylesheet" href="view/dist/css/adminlte.css">
  <style> .Hideme{display: none;} </style>
</head>
<body class="hold-transition sidebar-mini sidebar-collapse">
<div class="wrapper">
<nav class="main-header navbar navbar-expand navbar-dark navbar-success">
<ul class="navbar-nav"><li class="nav-item"><a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a></li></ul>
<ul class="navbar-nav ml-auto"> </ul>
</nav>

<aside class="main-sidebar sidebar-dark-success elevation-4">
    <a href="#" class="brand-link">
      <img src="view/dist/img/codeviLogo.png" alt="Campus CODEVI Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"> Reclutamiento  </span>
    </a>

<div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image"><img src="view/dist/img/users/<?php echo $_SESSION['srty_userImg']; ?>" class="img-circle elevation-2" alt="User Image"> </div>
        <div class="info"><a href="#" class="d-block"> <?php echo $_SESSION['srty_user']; ?> </a> </div>
      </div>
	  
<nav class="mt-2">
<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item"><a href="home" class="nav-link"><i class="nav-icon fas fa-home"></i><p> Inicio </p></a></li>
          <li class="nav-item" data-toggle="modal" data-target="#modal-default"><a href="#" class="nav-link"><i class="nav-icon fas fa-folder-plus"></i><p> Nueva Solicitud </p></a></li>
          <li class="nav-item"><a href="solicitudes" class="nav-link"><i class="nav-icon fas fa-clipboard-list"></i><p> Solicitudes </p></a></li>
          <li class="nav-item"><a href="perfiles-depurados" class="nav-link"><i class="nav-icon fas fa-award"></i><p> Perfiles Aprobados</p></a></li>
          <li class="nav-item"><a href="perfiles-rechazados" class="nav-link"><i class="nav-icon fas fa-ban"></i><p> Perfiles Rechazados</p></a></li>
          <li class="nav-item"><a href="ajustes" class="nav-link"><i class="nav-icon fas fa-cogs"></i><p> Ajustes </p></a></li>
		  <li class="nav-item"><a href="salir" class="nav-link"><i class="nav-icon fas fa-sign-out-alt text-danger"></i><p> Salir</p></a></li>
</ul>
 </nav>
 </div>
</aside>

<div class="content-wrapper">
  <div class="content-header">
      <div class="container-fluid">
        <div class="row">
 
		   <input id="getCurrentCode" type="hidden" value="<?php echo $frmd; ?>"/>
		  	<div class="col-sm-6">
					<div class="btn-group">

			 	<a class="btn btn-default" href="<?php echo $_SESSION["pageBack"]; ?>" title="Regresar"><i class="far fa-arrow-alt-circle-left"></i> </a>
				<a class="btn btn-default" href="" title="Recargar la página"><i class="fas fa-sync-alt"></i></a>				
				<button class="btn btn-default" data-toggle="modal" data-target="#modal-map" type="button" title="Agregar Ubicación en Mapa"> <i class="fas fa-map-marked-alt text-info"></i></button>				
				<button class="btn btn-default" type="button" data-toggle="modal" data-target="#modal-img" title="Agregar Iamagenes complementarias"> <i class="far fa-images text-info"></i></button>				
				<a class="btn btn-default text-primary" href="index.php?ruta=perfil-editar&code=<?php echo $frmd; ?>" title="Editar Datos"><i class="fas fa-edit"></i> Editar </a>				
			 </div>						
			 
		 
		
		</div> 		  	
		
		<div class="col-sm-6">
<?php		 					
if($status==0){			 
			echo' <div class="btn-group float-right">
			 	<button class="btn btn-success chStatus"  nx="1"> <i class="far fa-check-circle"></i> Aceptar </button>
			 	<button class="btn btn-danger chStatus"  nx="2"> <i class="fas fa-ban"></i> Rechazar </button>				
			 </div>';
}else{
		echo'	<div class="btn-group float-right">
			 	<button class="btn btn-default chStatus"  nx="0"> <i class="fas fa-times text-info"></i> Remover Estado  </button>				
			 </div>'; 
}?>
		</div> 
		   
		   
      </div> 
   </div> 
</div>

<div class="content">
  <div class="container-fluid">
     <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-body">
			  
<div class="row">

<div class="col-6"> <div class="pt-4"><h5 class="pb-5"> Datos Personales 
<?php 
if($status==0){
	
}elseif($status==1){
 echo '<span class="text-success pl-4"> <i class="fas fa-award"></i> APROBADO </span>';
}elseif($status==2){
 echo '<span class="text-muted pl-4"> <i class="fas fa-ban"></i> RECHAZADO </span>';	
}else{
	
}
?>

</h5></div></div>			  
<div class="col-6"> <div class="text-center imgPlaceHolder p-3"><img class="profile-user-img img-fluid" src="view/media/users/<?php echo $imgUrl;?>" alt="User profile picture"></div></div>			  


</div>			  
			  
<div class="row">
<div class="col-6">
	
<div class="row"><label class="col-sm-4 col-form-label">Nombres: </label><div class="col-sm-7 pt-2"><?php echo $frm_name; ?>  </div></div>
<div class="row"><label class="col-sm-4 col-form-label">Apellidos: </label><div class="col-sm-7 pt-2 float-left"><?php echo $apellidos; ?>  </div></div>
<div class="row"><label class="col-sm-4 col-form-label">Cédula: </label><div class="col-sm-7 pt-2"><?php echo $frm_cedula; ?>  </div></div>
<div class="row"><label class="col-sm-4 col-form-label">Dirección: </label><div class="col-sm-7 pt-2">

<?php 
if(strlen($mapaUrl) > 10 ){
	echo '<a href="'.$mapaUrl.'" target="_blank" > '. $frm_addr.' <i class="pl-2 fas fa-map-marked-alt text-primary"></i> </a>';
}else{
 echo $frm_addr;
	
}
?>
</div></div>


<div class="row"><label class="col-sm-4 col-form-label">Teléfono: </label><div class="col-sm-7 pt-2"><?php echo $frm_phone; ?>  </div></div>
<div class="row"><label class="col-sm-4 col-form-label">Genero: </label><div class="col-sm-7 pt-2"><?php echo  $frm_gender; ?>  </div></div>
<div class="row"><label class="col-sm-4 col-form-label">Instagram: </label><div class="col-sm-7 pt-2"><?php echo  $frm_instagram; ?>  </div></div>
</div>
                  
<div class="col-6">
<div class="row"><label class="col-sm-4 col-form-label">Fecha de Nacimiento: </label><div class="col-sm-7 pt-2"><?php echo $frm_bday." (".getAge($frm_bday)." Años  )"; ?>  </div></div>
<div class="row"><label class="col-sm-4 col-form-label">Lugar de Nacimiento: </label><div class="col-sm-7 pt-2 float-left"><?php echo $frm_pbirth; ?>  </div></div>
<div class="row"><label class="col-sm-4 col-form-label">Nacionalidad: </label><div class="col-sm-7 pt-2"><?php echo $frm_nac; ?>  </div></div>
<div class="row"><label class="col-sm-4 col-form-label">Estado Civil: </label><div class="col-sm-7 pt-2"><?php echo $frm_civilstatus; ?>  </div></div>
<div class="row"><label class="col-sm-4 col-form-label">Correo Electrónico: </label><div class="col-sm-7 pt-2"><?php echo $frm_email; ?>  </div></div>
<div class="row"><label class="col-sm-4 col-form-label">Facebook: </label><div class="col-sm-7 pt-2"><?php echo $frm_facebook; ?>  </div></div>
<div class="row"><label class="col-sm-4 col-form-label">Twitter: </label><div class="col-sm-7 pt-2"><?php echo $frm_twitter; ?>  </div></div>
 
</div>

<div class="col-12"><hr/>
<h5 class="p-0"> Datos de Familiares  </h5>

<table class="table table-striped table-sm">
<thead>
	<tr>
		<th> Parentesco </th>	
		<th> Nombre </th>
		<th> Género </th>
		<th> Fecha de Nacimiento </th>
		<th> Cédula </th>
	</tr>
</thead>
<tbody>
<?php 
if(strlen($results['formdata2']) > 10 ){
	
 foreach ($data2 as $key => $value2) {
	echo '<tr><td>'.$value2['relcode'].'</td>';
	echo '<td>'.$value2['relname'].'</td>';
	echo '<td>'.$value2['relgender'].'</td>';
	echo '<td>'.$value2['relbday'].'</td>';
	echo '<td>'.$value2['relced'].'</td> </tr>';
  }
} 
?>	 
	
</tbody>
</table>

</div>


<div class="col-12"><hr/>
<h5 class="p-0"> Nivel Académico   </h5>

<table class="table table-striped table-sm">
<thead>
	<tr>
		<th> Estudios realizados </th>	
		<th> Escuela o Institucion </th>
		<th> Ciudad </th>
		<th> Fecha (Desde - Hasta) </th>
		<th> Titulo Alcanzado </th>
	</tr>
</thead>

<tbody>
<?php 
if(strlen($results['formdata3']) > 10 ){
 foreach ($data3 as $key => $value3) {
	echo '<tr><td>'.$value3['grado'].'</td>';
	echo '<td>'.$value3['institucion'].'</td>';
	echo '<td>'.$value3['ciudad'].'</td>';
	echo '<td>'.$value3['fecha_desde'].' - '.$value3['fecha_hasta'].'</td>';
	echo '<td>'.$value3['titulo'].'</td> </tr>';
  }
}
?>
</tbody>
</table>

</div>

<div class="col-12"><hr/>
<h5 class="p-0"> Referencias Laborales   </h5>


<table class="table table-striped table-sm">
<thead>
	<tr>
		<th> Empresa donde trabajó </th>	
		<th> Teléfono </th>
		<th> Tiempo Trabajando </th>
		<th> Motivo Salida </th>
		<th> Ocupación </th>
		<th> Salario Anterior </th>
	</tr>
</thead>

<tbody>
<?php 
if(strlen($results['formdata4']) > 10 ){
 foreach ($data4 as $key => $value4) {
	echo '<tr><td>'.$value4['empresa'].'</td>';
	echo '<td>'.$value4['telefono'].'</td>';
	echo '<td>'.$value4['tiempo'].'</td>';
	echo '<td>'.$value4['salida'].'</td>';
	echo '<td>'.$value4['puesto'].'</td>';
	echo '<td>'.number_format($value4['salario'],2).'</td> </tr>';
  }
}
?>
</tbody>
</table>
</div>

 

<div class="col-12 mb-2"><hr/> <h5 class="p-0">Referencia & emergencias     </h5> </div>

<div class="col-6">
	
<div class="row"><label class="col-sm-12 col-form-label">Recomendado por empleado: </label> </div>
<div class="row"><label class="col-sm-4 col-form-label">Nombre: </label><div class="col-sm-7 pt-2"><?php echo  $rec_nombre; ?>  </div></div>
<div class="row"><label class="col-sm-4 col-form-label">Frabrica: </label><div class="col-sm-7 pt-2 float-left"><?php 
if(intval($rec_empresa)==0){ } else{ echo $rec_empresa;} ?>  </div></div>
 
</div>
                  
<div class="col-6">
<div class="row"><label class="col-sm-12 col-form-label">En caso de emergencias avisar a: </label> </div>
<div class="row"><label class="col-sm-4 col-form-label">Nombre: </label><div class="col-sm-7 pt-2"><?php echo $emr_nombre; ?>  </div></div>
<div class="row"><label class="col-sm-4 col-form-label">Dirección: </label><div class="col-sm-7 pt-2 float-left"><?php echo $emr_direccion; ?>  </div></div>
<div class="row"><label class="col-sm-4 col-form-label">Parentesco: </label><div class="col-sm-7 pt-2"><?php echo $emr_parentezco; ?>  </div></div>
<div class="row"><label class="col-sm-4 col-form-label">telefono: </label><div class="col-sm-7 pt-2"><?php echo $emr_telefono; ?>  </div></div>
</div>
</div>

              </div>
            </div>
          </div>
		  
       </div>
    </div> 
    </div>
  </div>
  
<?php include_once "modalCt.php"; ?>
  
 

     <div class="modal fade" id="modal-map">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">   </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
			<div class="form-group">
                        <label> Agregar URL / Dirección de la ubicación.  </label>
                        <textarea id="mapUrl" class="form-control" rows="3" placeholder="Ejemplo: https://goo.gl/maps/qEQfWacJt4maLvuC7"></textarea>
                      </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-danger" data-dismiss="modal"> Cancelar </button>
              <button id="btnSaveUrlMap" type="button" class="btn btn-success"> <i class="fas fa-save"></i> Guardar </button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->



     <div class="modal fade" id="modal-img">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">   </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
 <div class="form-group Hideme">
    <div class="input-group">
         <div class="custom-file">
              <input type="file" id="inpFile" multiple="">
              <label class="custom-file-label" for="inpFile">  Seleccione las imágenes </label>  
		</div>  
     </div>
</div>


			<div class="col-md-12 text-center pt-2">
				<div>
					<span   id="uploaded_images">
					
					<?php 
					if($ExtraImg==0){
						echo '	<center><h4>Haz clic en el recuadro para subir las imagenes </h4></center>
					  <div style="border:dashed 2px #ccc;">
							<div class="p-5"> </div>
							<div class="p-4"> </div>
					  </div>';
						
						
					}else{
							//$extraImages = json_decode($results['bgo_extrapics'], true);
						for($i=0; $i < 8; $i++){
							echo '<img src="view/media/location/DO20200630-220655-2292/Picture5.jpg" height="125" width="150" class="img-thumbnail mr-1">';
						//	echo '<img src="view/media/location/DO20200630-220655-2292/Picture5.jpg" height="125" width="150" class="img-thumbnail mr-1">';
							//echo '<img src="view/media/location/DO20200630-220655-2292/Picture5.jpg" height="125" width="150" class="img-thumbnail mr-1">';
							//echo '<img src="view/media/location/DO20200630-220655-2292/Picture5.jpg" height="125" width="150" class="img-thumbnail mr-1">';
							//echo '<img src="view/media/location/DO20200630-220655-2292/Picture5.jpg" height="125" width="150" class="img-thumbnail mr-1">';
							//echo '<img src="view/media/location/DO20200630-220655-2292/Picture5.jpg" height="125" width="150" class="img-thumbnail mr-1">';
							//echo '<img src="view/media/location/DO20200630-220655-2292/Picture5.jpg" height="125" width="150" class="img-thumbnail mr-1">';
							//echo '<img src="view/media/location/DO20200630-220655-2292/Picture5.jpg" height="125" width="150" class="img-thumbnail mr-1">';
						}
						
					}
					?>
				 
			 		
				  
				 
					</span>				
				</div>
				
				<button class="btn btn-success btn-flat mx-auto mt-3 mb-4"> <i class="fas fa-th"></i> Galeria de Imagenes </button>
            </div> 


            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->


 
  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline no-print">
       version <?echo $_SESSION['service_version']; ?>
    </div>
    <!-- Default to the left -->
    <strong>Campus CODEVI &copy; 2020
  </footer>
</div>
<script src="view/plugins/jquery/jquery.min.js"></script>
<script src="view/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="view/plugins/toastr/toastr.min.js"></script>
<script src="view/dist/js/adminlte.min.js"></script>
<script type="text/javascript">
$( document ).ready(function(){ 
$('#mapUrl').val("<?php echo $mapaUrl; ?>");

});

$('.chStatus').click(function(){
$.getJSON('model/perfil_actualizar_estado.php',{
		id: $('#getCurrentCode').val(),
		st: $(this).attr('nx')
	},function(data){
		switch(data['ok']){
			case 0: toastr.error('ERROR! No se guardaron los cambios los datos: '+ data['err']); break;
			case 1: location.href=""; break;
		}
	});		
});

$('#btnSaveUrlMap').click(function(){
$.getJSON('model/actualizar_urlMapa.php',{
		id:  $('#getCurrentCode').val(),
		addr: $('#mapUrl').val()
	},function(data){
		switch(data['ok']){
			case 0: toastr.error('ERROR! No se guardaron los cambios los datos: '+ data['err']); break;
			case 1: location.href=""; break;
		}
	});		
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
