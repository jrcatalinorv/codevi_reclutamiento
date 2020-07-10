<?php 
session_start();
require_once "../modelos/conexion.php";
require_once "../modelos/data.php";

 
 
$stmt2 = Conexion::conectar()->prepare("SELECT * FROM ".DB_SCHEMA.".applications ORDER BY formid");
$stmt2 -> execute();



while($results = $stmt2 -> fetch()){
	
$img = $results['formimg']; 
 
$folder = explode('.',$img);
	
	 $data = json_decode($results['formdata'], true);
	 foreach ($data as $key => $value) {
		 $fullName = $value['frm_name'].' '.$value['frm_surname'];
		 $id = $value['frm_name'].' '.$value['frm_surname'];
	 }
	
echo '<div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
              <div class="card bg-light">
                <div class="card-header text-muted border-bottom-0">
                   
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b>'.$fullName.'</b></h2>
                 
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small pt-1"><span class="fa-li"><i class="fas fa-lg fa-id-badge"></i></span> '.$results['emplid'].'&nbsp;</li>
                        <li class="small pt-1"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> '.$value['frm_phone'].'&nbsp;</li>
                        <li class="small pt-1"><span class="fa-li"><i class="fas fa-map-marked-alt"></i></span> '.$value['frm_addr'].'&nbsp;</li>
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="../../../solicitud-empleo/src/vistas/upload/'.$folder[0].'/'.$img.'" alt="" class="img-fluid">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                  
                    <a href="#" class="btn btn-sm btn-primary">
                      <i class="fas fa-user"></i> Ver Perfil 
                    </a>
                  </div>
                </div>
              </div>
            </div>     
           
       
      ';
}								 
?>

 