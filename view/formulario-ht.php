<?php  
date_default_timezone_set("America/Santo_Domingo");
$date = (getdate());
$FullDate = $date["year"].''.sprintf("%02d",$date["mon"]).''.sprintf("%02d",$date["mday"]);

$fname = explode(' ',trim($_SESSION['srty_name']));

if($_SESSION["srtySession"] != "ok"){
 header('location: salir'); 
} 


/* Traducciones */
$prefix ='HT';
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
  <link rel="stylesheet" href="view/plugins/toastr/toastr.min.css">
  <link rel="stylesheet" href="view/dist/css/adminlte.css">
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
          <li class="nav-item"><a href="" class="nav-link active"><i class="nav-icon fas fa-folder-plus"></i><p> Nueva Solicitud </p></a></li>
          <li class="nav-item"><a href="solicitudes" class="nav-link"><i class="nav-icon fas fa-clipboard-list"></i><p> Solicitudes </p></a></li>
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
	<div class="row">
	
   <div class="col-lg-12" style="display:none;" >
     <div class="card">
	 
		<input id="currentMenuSeleted" type="hidden" value="1" />
           <div class="card-body choosePane p-1 mx-auto">
             <button id="btn1" type="button" class="btn btn-md btn-flat btn-success btn-lg opCategorie" cid="1"> Datos Personales </button>
             <button id="btn2" type="button" class="btn btn-md btn-flat btn-outline-success btn-lg opCategorie" cid="2"> Datos de Familiares </button>
             <button id="btn3" type="button" class="btn btn-md btn-flat btn-outline-success btn-lg opCategorie" cid="3"> Nivel Académico </button>               
			 <button id="btn4" type="button" class="btn btn-md btn-flat btn-outline-success btn-lg opCategorie" cid="4"> Referencias Laborales</button>
             <button id="btn5" type="button" class="btn btn-md btn-flat btn-outline-success btn-lg opCategorie" cid="5"> Referencia & emergencias  </button>         
            </div>
        </div>            
   </div>	

  	<div class="col-lg-12">		  
            <div class="card">
              <div class="card-header">
                <h5 id="cat-section" class="card-title m-0"> &nbsp; </h5>
              </div>
              <div class="card-body">
<div id="form1" class="col-12 Hideme">
<div class="col-12 row">
    <div class="col-4">
		 <div class="input-group mb-3">
          <div class="input-group-prepend"><span class="input-group-text"><i class="far fa-file-alt"></i></span></div>
          <input id="fname" name="fname" type="text" class="form-control" placeholder="Nombres">
		  <input type="hidden" id="frcode" name="frcode" class="form-control" readonly  value="<?php echo $code; ?>"/>
      </div>
    </div>    
	
	<div class="col-4">
		 <div class="input-group mb-3">
          <div class="input-group-prepend"><span class="input-group-text"><i class="far fa-file-alt"></i></span></div>
          <input id="surname" name="surname" type="text" class="form-control" placeholder="Apellido">
      </div>
    </div>	
	
	<div class="col-4">
		 <div class="input-group mb-3">
          <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-id-card"></i></span></div>
          <input id="nid" name="nid" type="text" class="form-control" placeholder="Cedula">
      </div>
    </div>        
</div>
<div class="col-12 row">
    <div class="col-8">
		 <div class="input-group mb-3">
          <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span></div>
          <input id="addr" name="addr" type="text" class="form-control" placeholder="Direccion Actual">
		 </div>
    </div>    
	
	<div class="col-4">
		 <div class="input-group mb-3">
          <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-phone-alt"></i></span></div>
          <input id="phone" name="phone" type="text" class="form-control" placeholder="Telefono">
      </div>
    </div>	      
</div>
<div class="col-12 row">
    <div class="col-4">
		 <div class="input-group mb-3">
          <div class="input-group-prepend"><span class="input-group-text"><i class="far fa-calendar-alt"></i></span></div>
          <input id="bday" name="bday" type="text" class="form-control" placeholder="Fecha de nacimiento : día-mes-año" data-inputmask='"mask": "99-99-9999"' data-mask >
      </div>
    </div>    
	
	<div class="col-4">
		 <div class="input-group mb-3">
          <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span></div>
          <input id="pbirth" name="pbirth" type="text" class="form-control" placeholder="Lugar de nacimiento">
      </div>
    </div>	
	
	<div class="col-4">
		 <div class="input-group mb-3">
          <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-globe-americas"></i></span></div>
          <input id="nac" name="nac" type="text" class="form-control" placeholder="Nacionalidad" value="Nacional">
      </div>
    </div>        
</div>
<div class="col-12 row">
	<div class="col-4">
		 <div class="input-group mb-3">
          <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-restroom"></i></span></div>
            <select id="gr" name="civilstatus"  class="form-control" >
			<option value="0"> Genero </option>
			<option value="M"> M </option>
			<option value="F"> F </option>
		  </select>         
      </div>
    </div>  

    <div class="col-4">
		 <div class="input-group mb-3">
          <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-gavel"></i></span></div>
          <select id="cs" name="civilstatus"  class="form-control" >
			<option value="0"> Estado Civil </option>
			<option value="Soltero"> Soltero </option>
			<option value="Casado"> Casado </option>
			<option value="Union Libre"> Union Libre </option>
			<option value="Divorciado"> Divorciado </option>
			<option value="Viuda"> Viuda </option>
		  </select>
      </div>
    </div>       
	  
	
	<div class="col-4">
		 <div class="input-group mb-3">
          <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-envelope"></i></span></div>
          <input id="email" name="email" type="text" class="form-control" placeholder="Correo Electronico">
      </div>
    </div>	
</div>
<div class="col-12 row">
	<div class="col-4">
		 <div class="input-group mb-3">
          <div class="input-group-prepend"><span class="input-group-text"><i class="fab fa-facebook-square text-primary fa-lg"></i></span></div>
            <input id="facebook" name="facebook" type="text" class="form-control" placeholder="Usuario de facebook">
      </div>
    </div>  
	<div class="col-4">
		 <div class="input-group mb-3">
          <div class="input-group-prepend"><span class="input-group-text"><i class="fab fa-twitter-square text-info fa-lg"></i></span></div>
            <input id="twitter" name="twitter" type="text" class="form-control" placeholder="Usuario de twitter">
      </div>
    </div> 
	<div class="col-4">
		 <div class="input-group mb-3">
          <div class="input-group-prepend"><span class="input-group-text"><i class="fab fa-instagram text-danger fa-lg"></i></span></div>
            <input id="instagram" name="instagram" type="text" class="form-control" placeholder="Usuario de instagram">  
      </div> 
    </div>  
      
</div>
<div class="col-12">
	<button id="saveForm1" class="btn btn-success btn-flat float-right"> Siguiente <i class="far fa-arrow-alt-circle-right"></i> </button>
</div>

</div>
<div id="form2" class="col-12 p-0 Hideme">
<table class="table table-sm table-striped">
<thead>
	<tr>
		<th> <label> Parentezco</label>
			<select id="famRel" class="form-control">
					<option value="Cónyuge" gdr="M"> Cónyuge  (M) </option>
					<option value="Cónyuge" gdr="F"> Cónyuge  (F) </option>
					<option value="Padre" gdr="M"> Padre </option>
					<option value="Madre" gdr="F"> Madre </option>
					<option value="Hijo" gdr="M"> Hijo </option>
					<option value="Hija" gdr="F"> Hija </option>
			</select>
  
		</th>
		<th><label> Nombre </label><input type="text" id="famName" class="form-control" placeholder="Nombre Completo"/></th>
		<th><label> Genero </label>
			<select id="famGender" class="form-control">
				<option value="M"> M </option>
				<option value="F"> F </option>
			</select>
		</th>
 
		<th><label> Fecha Nacimineto</label><input type="text" id="famDate" class="form-control"  placeholder="día-mes-año" data-inputmask='"mask": "99-99-9999"' data-mask ></th>
		<th><label> Cedula</label><input type="text" id="famId" class="form-control" placeholder="Documento de Identidad"></th>
		<th> <button id="addMember" class="btn btn-success btn-flat"> <i class="fas fa-plus"></i> Añadir </button> </th>
	</tr>
</thead>
<tbody id="myTable">

	
</tbody>	
</table>

<div class="col-12 pt-4">
	<button id="backForm1" class="btn btn-danger btn-flat float-left">  <i class="far fa-arrow-alt-circle-left"></i>  Anterior </button>
	<button id="saveForm2" class="btn btn-success btn-flat float-right"> Siguiente <i class="far fa-arrow-alt-circle-right"></i> </button>
</div>

</div>
<div id="form3" class="col-12 p-0 Hideme">
<table class="table table-sm table-striped">
<thead>
	<tr>
		<th> <label> Grado</label>
			<select id="acGrado" class="form-control">
					<option value="Primaria"> Primaria </option>
					<option value="Secundaria"> Secundaria </option>
					<option value="Comercial"> Comercial </option>
					<option value="tecnico"> Tecnico </option>
					<option value="Universitario"> Universitario </option>
					<option value="Otros"> Otros </option>
					<option value="Idiomas"> Idiomas </option>
			</select>  
 
  
		</th>
		<th><label> Institucion </label><input type="text" id="acSchool" class="form-control" placeholder=""/></th>
		<th><label> Ciudad </label><input type="text" id="acCity" class="form-control" placeholder=""/></th>
		<th><label> Desde </label><input type="text" id="acDtFrom" class="form-control" placeholder="día-mes-año" data-inputmask='"mask": "99-99-9999"' data-mask    /></th>
		<th><label> Hasta </label><input type="text" id="acDtTo" class="form-control" placeholder="día-mes-año" data-inputmask='"mask": "99-99-9999"' data-mask /></th>
		<th><label> Titulo Alcanazado </label><input type="text" id="acTitle" class="form-control"></th>
		<th> <button id="addSchool" class="btn btn-success btn-flat"> <i class="fas fa-plus"></i> Añadir </button> </th>
	</tr>
</thead>
<tbody id="myTable2">

	
</tbody>	
</table>

<div class="col-12 pt-4">
	<button id="backForm2" class="btn btn-danger btn-flat float-left">  <i class="far fa-arrow-alt-circle-left"></i>  Anterior </button>
	<button id="saveForm3" class="btn btn-success btn-flat float-right"> Siguiente <i class="far fa-arrow-alt-circle-right"></i> </button>
</div>

</div>
<div id="form4" class="col-12 p-0 Hideme">
<table class="table table-sm table-striped">
<thead>
		<th><label> Empresa </label><input type="text" id="rlName" class="form-control" placeholder=""/></th>
		<th><label> Telefono </label><input type="text" id="rlPhone" class="form-control" placeholder=""/></th>
		<th><label> Tiempo Laborando </label><input type="text" id="rlTime" class="form-control" placeholder=""/></th>
		<th><label> Motivo de salida  </label><input type="text" id="rlLeave" class="form-control" placeholder=""/></th>
		<th><label> Ocupacion </label><input type="text" id="rlPosition" class="form-control"></th>
		<th><label> Salario Anterior </label><input type="text" id="rlSalary" class="form-control"></th>
		<th> <button id="addEmpresa" class="btn btn-success btn-flat"> <i class="fas fa-plus"></i> Añadir </button> </th>
	</tr>
</thead>
<tbody id="myTable3">

	
</tbody>	
</table>
<div class="col-12 pt-4">
	<button id="backForm3" class="btn btn-danger btn-flat float-left">  <i class="far fa-arrow-alt-circle-left"></i>  Anterior </button>
	<button id="saveForm4" class="btn btn-success btn-flat float-right"> Siguiente <i class="far fa-arrow-alt-circle-right"></i> </button>
</div>
</div>

<div id="form5" class="col-12 Hideme">
 
<div class="col-12 row">
    <div class="col-4"><label> Recomendado por Empleado: </label>
		 <div class="input-group mb-3">
          <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-user"></i></span></div>
          <input id="rcEmp" name="bday" type="text" class="form-control" placeholder="Nombre Completo">
      </div>
    </div>    
	
	<div class="col-4"> <label> En caso de emergencias avisar a:</label>
		 <div class="input-group mb-3">
          <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-user"></i></span></div>
          <input id="enName" name="emName" type="text" class="form-control" placeholder="Nombre Completo">
      </div>
    </div>	
	
	<div class="col-4"> <label> &nbsp;  </label>
		 <div class="input-group mb-3">
          <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-users"></i></span></div>
          <input id="emRel" name="emRel" type="text" class="form-control" placeholder="Parentezco">
      </div>
    </div>        
</div>
<div class="col-12 row">
 

    <div class="col-4">
		 <div class="input-group mb-3">
          <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-building"></i></span></div>
          <select id="rcCp" name="civilstatus"  class="form-control" >
			<option value="0"> Empresa </option>
<option value="MD Industries I"> MD Industries I </option>
<option value="MD Industries II"> MD Industries II </option>
<option value="MD Industries III">  MD Industries III </option>
<option value="Everbright Headwear I"> Everbright Headwear I </option>
<option value="Everbright Headwear II">  Everbright Headwear II </option>  
<option value="Fabrik">  Fabrik  </option>
<option value="BrandM (AM2)">  BrandM (AM2)  </option>
<option value="BrandM (AM1)">  BrandM (AM1) </option>
<option value="BrandM (AM3)">  BrandM (AM3) </option>
<option value="Mazava LTD 1">  Mazava LTD 1 </option>
<option value="Mazava LTD 2">  Mazava LTD 2 </option>
<option value="Mazava LTD 3">  Mazava LTD 3 </option> 
<option value="CIH 1">   CIH 1 </option> 
<option value="CIH 2">   CIH 2  </option>
<option value="BKI">      BKI  </option>   
<option value="Top Choice">   Top Choice  </option>
<option value="Uniwell Apparel">   Uniwell Apparel </option> 
<option value="Superior Group 1">   Superior Group 1  </option>
<option value="Superior Group 2">  Superior Group 2  </option>
<option value="Superior Group 3">   Superior Group 3 </option> 
		  </select>
      </div>
    </div>  

	
	  
	
	<div class="col-4">
		 <div class="input-group mb-3">
          <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span></div>
          <input id="emAddr" name="emAddr" type="text" class="form-control" placeholder="Dirrecion">
      </div>
    </div>	

	<div class="col-4">
		 <div class="input-group mb-3">
          <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-phone"></i></span></div>
          <input id="emPhone" name="emPhone" type="text" class="form-control" placeholder="Telefono">
      </div>
    </div>	
</div>
 
<div class="col-12">
	<button id="backForm4" class="btn btn-danger btn-flat float-left">  <i class="far fa-arrow-alt-circle-left"></i>  Anterior </button>
	<button id="saveForm5" class="btn btn-success btn-flat float-right"> Siguiente <i class="far fa-arrow-alt-circle-right"></i> </button>
</div>

</div>

			
			 </div>
              </div>
            </div>
     </div>	
 
<input id="form-data-json1" class="form-control" type="hidden" />	
<input id="form-data-json2" class="form-control" type="hidden" />	
<input id="form-data-json3" class="form-control" type="hidden" />	
<input id="form-data-json4" class="form-control" type="hidden" />	
<input id="form-data-json5" class="form-control" type="hidden" />	
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
<script src="view/plugins/jquery-number/jquery.number.js"></script>
<script src="view/plugins/moment/moment.min.js"></script>
<script src="view/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<script type="text/javascript">
 $( document ).ready(function() {
   $('[data-mask]').inputmask();
   $('#rlSalary').number(true,2);
   $('#form1').removeClass('Hideme');    
   document.getElementById('cat-section').innerHTML = 'Datos personales';
});	
 			 
$('.choosePane').on("click","button.opCategorie",function(){
	var op = $(this).attr('cid');
	
	switch(op){
		case '1':
			 document.getElementById('cat-section').innerHTML = 'Datos personales';  
			 selectedMenu($('#currentMenuSeleted').val(),op);
		 break;		
		  
		  case '2':
			 document.getElementById('cat-section').innerHTML = 'Datos de Familiares';  
			 selectedMenu($('#currentMenuSeleted').val(),op);
		  
		  break; 
		case '3': 
			 document.getElementById('cat-section').innerHTML = 'Nivel Académico ';  
			 selectedMenu($('#currentMenuSeleted').val(),op);
			break; 
		
		case '4':
			 document.getElementById('cat-section').innerHTML = 'Referencias Laborales ';  
			 selectedMenu($('#currentMenuSeleted').val(),op);
		  break; 

		case '5':
			 document.getElementById('cat-section').innerHTML = 'Referencia & emergencias ';  
			selectedMenu($('#currentMenuSeleted').val(),op);
		  break;		  
										
		case '6':
			 document.getElementById('cat-section').innerHTML = 'Imagen de Perfil';  
			  selectedMenu($('#currentMenuSeleted').val(),op);
		  break;		  
	}
});
$('#famRel').change(function(){
	$('#famGender').val($("#famRel option:selected").attr("gdr"));
});

/* Agregar un miembro familiar */ 
$('#addMember').click(function(){
$("#myTable").append('<tr><td class="text-center rel">'+$('#famRel').val()+'</td>'+
'<td class="nm">'+$('#famName').val()+'</td>'+	
'<td class="gd">'+$('#famGender').val()+'</td>'+	
'<td class="dt">'+$('#famDate').val()+'</td>'+	
'<td class="cd">'+$('#famId').val()+'</td>'+	
'<td><i class="fas fa-trash-alt text-danger pt-1 quitarItem"></i> </td></tr>');	
listarFormDt2();

//limpiar campos
$('#famName').val("");	
$('#famDate').val("");	
$('#famId').val("");	 
}); 

/* Quitar un miembro familiar */
$('#myTable').on('click','i.quitarItem',function(){
	 $(this).parent().parent().remove();
	 listarFormDt2();
	 var counter = document.getElementById("myTable").length;
	 if(counter==0){
		$("#form-data-json2").val("");
	}
});

/* Agregar estudios */
$('#addSchool').click(function(){
$("#myTable2").append('<tr><td class="text-center naId">'+$('#acGrado').val()+'</td>'+
'<td class="naName">'+$('#acSchool').val()+'</td>'+	
'<td class="naCity">'+$('#acCity').val()+'</td>'+	
'<td class="naDtFrom">'+$('#acDtFrom').val()+'</td>'+	
'<td class="naDtTo">'+$('#acDtTo').val()+'</td>'+	
'<td class="naTitle">'+$('#acTitle').val()+'</td>'+	
'<td><i class="fas fa-trash-alt text-danger pt-1 naQuitarItem"></i> </td></tr>');
listarFormDt3();	


// Limpiar los campos 
$('#acSchool').val("");	
$('#acCity').val("");	
$('#acDtFrom').val("");	
$('#acDtTo').val("");	
$('#acTitle').val("");

		
});

/* Quitar school */
$('#myTable2').on('click','i.naQuitarItem',function(){
	 $(this).parent().parent().remove();
	listarFormDt3();
	 var counter = document.getElementById("myTable2").length;
	 if(counter==0){
		$("#form-data-json3").val("");
	}
});

/* Agregar Empresa */
$('#addEmpresa').click(function(){
$("#myTable3").append('<tr><td class="text-center cpName">'+$('#rlName').val()+'</td>'+
'<td class="cpPhone">'+$('#rlPhone').val()+'</td>'+	
'<td class="cpTime">'+$('#rlTime').val()+'</td>'+	
'<td class="cpSalida">'+$('#rlLeave').val()+'</td>'+	
'<td class="cpPuesto">'+$('#rlPosition').val()+'</td>'+	
'<td class="cpSalary">'+$('#rlSalary').val()+'</td>'+	
'<td><i class="fas fa-trash-alt text-danger pt-1 cpQuitarItem"></i> </td></tr>');
listarFormDt4();	

$('#rlName').val("");
$('#rlPhone').val("");	
$('#rlTime').val("");	
$('#rlLeave').val("");	
$('#rlPosition').val("");
$('#rlSalary').val("");	
	
});


$('#myTable3').on('click','i.cpQuitarItem',function(){
	 $(this).parent().parent().remove();
	listarFormDt4();
	 var counter = document.getElementById("myTable3").length;
	 if(counter==0){
		$("#form-data-json4").val("");
	}
})




/* Guardar primera parte del formulario */
$('#saveForm1').click(function(){
var datosFormulario1 = [];
	datosFormulario1.push({
		"frm_code" : $("#frcode").val(),
		"frm_name" : $("#fname").val(),
		"frm_surname" : $("#surname").val(),
		"frm_cedula" : $("#nid").val(),
		"frm_addr" : $("#addr").val(),
		"frm_phone" : $("#phone").val(),
		"frm_bday" : $("#bday").val(),
		"frm_pbirth" : $("#pbirth").val(),
		"frm_nac" : $("#nac").val(),
		"frm_cs" : $("#cs").val(),
		"frm_gr" : $("#gr").val(),
		"frm_email" : $("#email").val(),
		"frm_facebook" : $("#facebook").val(),
		"frm_twitter" : $("#twitter").val(),
		"frm_instagram" : $("#instagram").val()
})
$("#form-data-json1").val(JSON.stringify(datosFormulario1)); 	
$('#btn2').click();	
}); 
$('#backForm1').click(function(){
	$('#btn1').click();
});

$('#saveForm2').click(function(){
  $('#btn3').click();	
});
$('#backForm2').click(function(){
	$('#btn2').click();
});


$('#saveForm3').click(function(){
  $('#btn4').click();	
}); 
$('#backForm3').click(function(){
	$('#btn3').click();
});


$('#saveForm4').click(function(){
  $('#btn5').click();	
});
$('#backForm4').click(function(){
	$('#btn4').click();
});


/* Salvar los datos */	
$('#saveForm5').click(function(){
var datosFormulario5 = [];
	datosFormulario5.push({
		"rec_nombre"  :$('#rcEmp').val(),
		"rec_empresa" :$('#rcCp').val(),
		"emr_nombre" :$('#enName').val(),
		"emr_direccion" :$('#emAddr').val(),
		"emr_parentezco" :$('#emRel').val(),
		"emr_telefono" :$('#emPhone').val(),
})
$("#form-data-json5").val(JSON.stringify(datosFormulario5));
saveFormData();


});  

 

function listarFormDt2(){
	var listaItems = [];
	var relation = $(".rel");
	var name = $(".nm");
	var gender = $(".gd");
	var date = $(".dt");
	var id = $(".cd");

	for(var i = 0; i < relation.length; i++){
		listaItems.push({ "relcode"	: $(relation[i]).html(),
						  "relname" : $(name[i]).html(), 	
						  "relgender" : $(gender[i]).html(), 	
						  "relbday" : $(date[i]).html(), 	
						  "relced" : $(id[i]).html() })
	}
	$("#form-data-json2").val(JSON.stringify(listaItems)); 
}

function listarFormDt3(){
	var listaItems = [];
	var grado =  $(".naId");
	var institucion =  $(".naName");
	var ciudad =  $(".naCity");
	var desde =  $(".naDtFrom");
	var hasta =  $(".naDtTo");
	var titulo =  $(".naTitle");
	
for(var i = 0; i < grado.length; i++){
		listaItems.push({ "grado"	: $(grado[i]).html(),
						  "institucion": $(institucion[i]).html(), 	
						  "ciudad" : $(ciudad[i]).html(), 	
						  "fecha_desde" : $(desde[i]).html(), 	
						  "fecha_hasta" : $(hasta[i]).html(), 	
						  "titulo" : $(titulo[i]).html() })
	}
	$("#form-data-json3").val(JSON.stringify(listaItems));
}

function listarFormDt4(){
	var listaItems = [];
	var empresa =  $(".cpName");
	var telefono =  $(".cpPhone");
	var tiempo =  $(".cpTime");
	var salida =  $(".cpSalida");
	var puesto =  $(".cpPuesto");
	var salario =  $(".cpSalary");
	
for(var i = 0; i < empresa.length; i++){
		listaItems.push({ "empresa"	: $(empresa[i]).html(),
						  "telefono": $(telefono[i]).html(), 	
						  "tiempo" : $(tiempo[i]).html(), 	
						  "salida" : $(salida[i]).html(), 	
						  "puesto" : $(puesto[i]).html(), 	
						  "salario" : $(salario[i]).html() })
	}
 $("#form-data-json4").val(JSON.stringify(listaItems)); 
}

function saveFormData(){
$.getJSON('model/saveFormData.php',{			  	 
	frCode: 	$('#frcode').val(),
	frEmplId: 	$('#nid').val(),
	frData1:  	$("#form-data-json1").val(),
	frData2:  	$("#form-data-json2").val(),
	frData3:  	$("#form-data-json3").val(),
	frData4:  	$("#form-data-json4").val(),
	frData5:  	$("#form-data-json5").val()
	},function(data){
	  switch(data['ok'])
	  {
		case 0: alert("No se pudo agregar el servico: "+data['err'] ); break;
		case 1: location.href="index.php?ruta=upload-image&code="+data['code']; break;		
	  }
  });		
}


function selectedMenu(od,nw){
	$('#btn'+od).removeClass('btn-success');
	$('#btn'+od).addClass('btn-outline-success');
	$('#form'+od).addClass('Hideme');
	$('#btn'+nw).removeClass('btn-outline-success');
	$('#btn'+nw).addClass('btn-success');
	$('#form'+nw).removeClass('Hideme');
	$('#currentMenuSeleted').val(nw);
}

</script>
</body>
</html>