	<?php

	error_reporting(E_ALL ^ E_NOTICE);
	session_start();

	include("../modelo/Usuario.php");
	include("../controlador/ControlUsuario.php");
	include("../controlador/ControlConexion.php");
	include("../modelo/Empleado.php");
	include("../controlador/ControlEmpleado.php");
	include("../modelo/Cliente.php");
	include("../controlador/ControlCliente.php");
	include("../modelo/Proveedor.php");
	include("../controlador/ControlProveedor.php");

	$usuario= $_POST['txtUsuario'];
	$clave= $_POST['txtClave'];
	$statusAcceso = "display:none";
	$statusIngreso = "display:none";
	$button =$_POST['btn']; 

	if($button="Login"){

	if(isset($usuario) && isset($clave)){
		
		$objUsuario= new Usuario("",$usuario,$clave,"","");
		$objControlUsuario= new ControlUsuario($objUsuario);
		$objUsuario=$objControlUsuario->consultarExistencia();

		$_SESSION['usuario']=$objUsuario->getUsuario();
		$_SESSION['clave']= $objUsuario->getClave();

	
		switch($objUsuario->getNivel()){

				case 1:

					if($objUsuario->getEstado==0)
					header('Location:HomeAula.php');
					else
					$statusAcceso="display:block";
					
				break; 

				case 2: 

					if($objUsuario->getEstado()==0){
						$objEmpleado= new Empleado("","","","","","","","","","","","","",$objUsuario->getId(),"","");
						$objControlEmpleado= new ControlEmpleado($objEmpleado);
						$objEmpleado=$objControlEmpleado->consultarPorId();
                        print($objEmpleado->getFRetiro());
						$_SESSION["empleadoDefault"] = serialize($objEmpleado);
						header('Location:Empleado.php');
					}else{
						$statusAcceso="display:block";
					}
					
				break;

				case 3:
					if($objUsuario->getEstado()==0){
						print("if".$objUsuario->getId());
						$objProveedor= new Proveedor("","","","","","","","","","","","","");
						$objControlProveedor= new ControlProveedor($objProveedor);
						$objProveedor=$objControlProveedor->consultarPorId($objUsuario->getId());  

						$_SESSION["proveedorDefault"] = serialize($objProveedor);
						header('Location:Proveedor.php');
					}else{
						$statusAcceso="display:block";
					}

				

				break;

				case 4:					
					if($objUsuario->getEstado()==0){

						print("ingreso 4". $objUsuario->getEstado());

						$objCliente= new Cliente("","","","","","","","","","","",$objUsuario->getId(),"","");
						$objControlCliente= new ControlCliente($objCliente);
						$objCliente1=$objControlCliente->consultarPorId();
                        $_SESSION["clienteDefault"] = serialize($objCliente1);
						header('Location:Cliente.php');
					}else{
						$statusAcceso="display:block";
					}



				break;
					default: 
					$statusIngreso = "display:block";
				break;
		}
	}
	}


	echo"
	<!DOCTYPE html>
	<html>
	<head>
	<meta charset='UTF-8'>

	<link rel=\"StyleSheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css\" type=\"text/css\">
	<link rel=\"Stylesheet\" href=\"https://use.fontawesome.com/releases/v5.6.1/css/all.css\" integrity=\"sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP\" crossorigin=\"anonymous\">
	<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js\"></script>
	<script src=\"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js\"></script>
	<script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js\"></script>



	<script type=\"text/javascript\">

	function validar(){

		var usuario =document.getElementById(\"usuario\").value;
		var clave =document.getElementById(\"clave\").value;
		
		if(clave.length==0){

			alert('Clave requerida');
			return false;
		}
		if(usuario.length==0 ){  
			alert('Usuario requerido'); 
			return false;
		}


		if(usuario.length>30 ){ 
			alert('Usuario invalido.Maximo de caracteres 30'); 
			document.getElementById(\"usuario\").value = '';
			return false;
		}


		if(clave.length>50 ){
			alert('Clave invalida. Maximo de Caracteres 50');
			document.getElementById(\"clave\").value = '';
			return false;
		}
	}
	</script>

	<style>

	html,body{
	background-size: cover;
	background-repeat: no-repeat;
	height: 100%;
	font-family: 'Numans', sans-serif;
	}

	.container{
	height: 100%;
	align-content: center;
	}

	.card{
	height: 370px;
	margin-top: auto;
	margin-bottom: auto;
	width: 400px;
	background-color: rgba(0,0,0,0.5) !important;
	}

	.social_icon span{
	font-size: 50px;
	margin-left: 20px;
	color: #33FF36;
	}

	.social_icon span:hover{
	color: white;
	cursor: pointer;
	}

	.card-header h3{
	color: white;
	}

	.social_icon{
	position: absolute;
	right: 20px;
	top: -45px;
	}

	.input-group-prepend span{
	width: 50px;
	background-color: #33FF36;
	color: black;
	border:0 !important;
	}

	input:focus{
	outline: 0 0 0 0  !important;
	box-shadow: 0 0 0 0 !important;

	}

	.remember{
	color: white;
	}

	.remember input
	{
	width: 20px;
	height: 20px;
	margin-left: 15px;
	margin-right: 5px;
	}

	.login_btn{
	color: black;
	background-color: #33FF36;
	width: 100px;
	}

	.login_btn:hover{
	color: black;
	background-color: white;
	}

	.links{
	color: white;
	}

	.links a{
	margin-left: 4px;
	}
	</style>




	<title>Inicio Sesion</title>
	</head>
		<body>


		<div class=\"alert alert-warning\" role=\"alert\"  id=\"txtInactivado\" style=\"$statusAcceso\">
        <strong>Ups!</strong> El usuario se encuentra inactivo
		</div>

		<div class=\"alert alert-warning\" role=\"alert\"  id=\"txtInactivado\" style=\"$statusIngreso\">
        <strong>Ups!</strong> El usuario no se encuentra registrado en la base de datos
		</div>
		

		<div class=\"container\">
		<div class=\"d-flex justify-content-center h-100\">
			<div class=\"card\">
				<div class=\"card-header\"><h3>Inicio de Sesion</h3></div>
				<div class=\"card-body\">
				<form action=\"Index.php\" method=\"POST\" onsubmit=\"return validar()\">
						<div class=\"input-group form-group\">
							<div class=\"input-group-prepend\">
								<span class=\"input-group-text\"><i class=\"fas fa-user\"></i></span>
							</div>
							<input type=\"text\" class=\"form-control\" id=\"usuario\" name=\"txtUsuario\" placeholder=\"Usuario\">
							
						</div>
						<div class=\"input-group form-group\">
							<div class=\"input-group-prepend\">
								<span class=\"input-group-text\"><i class=\"fas fa-key\"></i></span>
							</div>
							<input type=\"password\" class=\"form-control\" id=\"clave\" name=\"txtClave\" placeholder=\"Clave\">
						</div>
						<div class=\"row align-items-center remember\">
							<input type=\"checkbox\">Remember Me
						</div>
						<div class=\"form-group\">
							<input type=\"submit\"  name =\"btn\" value=\"Login\"  class=\"btn float-right login_btn\">
						</div>
				
				</div>
				<div class=\"card-footer\">
					
					<div class=\"d-flex justify-content-center\">
					<a href=\"#\" style=\"color:black\">Olvido su clave?</a>
					</div>
				</div>
			</form>
			</div>
		</div>
	</div>
	</body>
		</body>
	</html>
	";
	?>