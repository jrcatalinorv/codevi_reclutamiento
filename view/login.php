<?php $img = './view/dist/img/bg-01.jpg'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>CODEVI SSC  </title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/png" href="favicon.ico"/>
<link rel="stylesheet" type="text/css" href="view/dist/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="view/plugins/fontawesome-free/css/all.min.css">
<link rel="stylesheet" type="text/css" href="view/plugins/animate/animate.css">
<link rel="stylesheet" type="text/css" href="view/plugins/css-hamburgers/hamburgers.min.css">
<link rel="stylesheet" type="text/css" href="view/plugins/animsition/css/animsition.min.css">
<link rel="stylesheet" type="text/css" href="view/plugins/toastr/toastr.min.css">	
<link rel="stylesheet" type="text/css" href="view/plugins/roux/css/util.css">
<link rel="stylesheet" type="text/css" href="view/plugins/roux/css/main.css">
<link rel="stylesheet" type="text/css" href="view/plugins/toastr/toastr.min.css">	
</head>
<body style="background-color: #777777;">
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form validate-form">
					<span class="login100-form-title p-b-43">
					<i class="fas fa-users  fa-4x col-12 mb-2"></i>
					 Reclutamiento CODEVI 
					</span>
					
					<div class="wrap-input100 validate-input" data-validate = "User is required">
						<input id="user" class="input100" type="text" name="user">
						<span class="focus-input100"></span>
						<span class="label-input100">usuario</span>
					</div>
					
					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input id="pass" class="input100" type="password" name="pass">
						<span class="focus-input100"></span>
						<span class="label-input100">Password</span>
					</div>

					<div class="container-login100-form-btn"> <!-- 00A65A -->
						<button id="login" class="login100-form-btn"> Acceder &nbsp; <i class="fa fa-sign-in fa-2x"></i> </button>
					</div>
			 
				 
				</div>
				<div class="login100-more" style="background-image: url('<?php echo  $img; ?>');"></div>
			</div>
		</div>
	</div>
		
<script src="view/plugins/jquery/jquery-3.2.1.min.js"></script>
<script src="view/plugins/animsition/js/animsition.min.js"></script>
<script src="view/plugins/bootstrap/js/popper.js"></script>
<script src="view/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="view/plugins/toastr/toastr.min.js"></script>
<script type="text/javascript">
var input = document.getElementById("pass");
input.addEventListener("keyup", function(event) {
  if (event.keyCode === 13) {
   event.preventDefault();
   document.getElementById("login").click();
  }
});


$('#login').click(function(){
$.getJSON('model/security_login.php',{			  	 
	usr: $('#user').val(),	    	 
	pass: $('#pass').val() 	 
	},function(data){
	   switch(data['ok'])
		{
			case 0: 
				toastr.error('Usuario o clave incorrectos');
				$('#user').val("");
				$('#pass').val("");
			  break;
			case 1: 
			 if(data['status']==0){
				 toastr.warning('El usuario esta inactivo. Favor contactar el departamento de Soporte.');
				 $('#pass').val("");					
				}else{
				   location.href = "home"; 
				 }
			break;		
		 }
	});				 
}); 
</script>
</body>
</html>