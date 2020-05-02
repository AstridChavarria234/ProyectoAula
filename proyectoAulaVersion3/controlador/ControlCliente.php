<?php 

class ControlCliente {
    var $objCliente;
    var $objCliente1;


	function __construct($objCliente){
	$this->objCliente=$objCliente;

	}


	function guardar(){


		$sv="localhost";
		$us="root";
		$ps="";
		$bd="bdproyectoaulav1";
		
	$cod=$this->objCliente->getCodigo();
	$nom=$this->objCliente->getNombre();
	$tPersona=$this->objCliente->getTipoPersona();
	$fReg=$this->objCliente->getFRegistro();
	$fInact=$this->objCliente->getFInactivo(); 
	$urlImg=$this->objCliente->getUrlImagen();
	$email=$this->objCliente->getEmail();
	$tel=$this->objCliente->getTelefono();
	$topCred=$this->objCliente->getTopeCred();
	$objConexion = new ControlConexion();
	$objConexion->abrirBd($sv,$us,$ps,$bd);
	$comandoSql="INSERT INTO CLIENTE(codigo,nombre,tipo_persona,fecha_registro,fecha_inactivo,url_imagen,email,telefono,tope_credito,inactivo) VALUES('".$cod."','".$nom."','".$tPersona."','".$fReg."','".$fInact."','".$urlImg."','".$email."',".$tel.",".$topCred.",0)";
	$objConexion->ejecutarComandoSql($comandoSql);
	$objConexion->cerrarBd();
}

	function modificar(){

		$sv="localhost";
		$us="root";
		$ps="";
		$bd="bdproyectoaulav1";
		
	
	
		$cod=$this->objCliente->getCodigo();
		$nom=$this->objCliente->getNombre();
		$tPersona=$this->objCliente->getTipoPersona();
		$fReg=$this->objCliente->getFRegistro();
		$fInact=$this->objCliente->getFInactivo(); 
		$urlImg=$this->objCliente->getUrlImagen();
		$email=$this->objCliente->getEmail();
		$tel=$this->objCliente->getTelefono();
		$topCred=$this->objCliente->getTopeCred();
		$objConexion = new ControlConexion();
		$objConexion->abrirBd($sv,$us,$ps,$bd);
		

        $comandoSql="UPDATE CLIENTE SET nombre='".$nom."',tipo_persona ='".$tPersona."',fecha_registro ='".$fReg."',fecha_inactivo='".$fInact."',url_imagen ='".$urlImg."',email ='".$email."',telefono =".$tel.",tope_credito =".$topCred.",inactivo=0 WHERE codigo='".$cod."'";
	    $objConexion->ejecutarComandoSql($comandoSql);
	    $objConexion->cerrarBd();

	}

	function inactivar(){

		$sv="localhost";
		$us="root";
		$ps="";
		$bd="bdproyectoaulav1";

		$cod=$this->objCliente->getCodigo();

		$objConexion = new ControlConexion();
		$objConexion->abrirBd($sv,$us,$ps,$bd);
		$comandoSql="UPDATE CLIENTE SET inactivo=1 WHERE codigo='".$cod."'";
		$objConexion->ejecutarComandoSql($comandoSql);
		$objConexion->cerrarBd();
	}

	
	function consultar(){

		$sv="localhost";
		$us="root";
		$ps="";
		$bd="bdproyectoaulav1";
		

		$cod=$this->objCliente->getCodigo();

        
		$objConexion = new ControlConexion();
		$objConexion->abrirBd($sv,$us,$ps,$bd);
	    $comandoSql="SELECT * FROM CLIENTE  WHERE codigo='".$cod."'";
		$recordSet=$objConexion->ejecutarSelect($comandoSql);
		$registro = $recordSet->fetch_array(MYSQLI_BOTH);
		$objCliente1 = new Cliente ($registro["codigo"],$registro["nombre"],$registro["tipo_persona"],$registro["fecha_registro"],$registro["fecha_inactivo"],$registro["url_imagen"],$registro["email"],
		$registro["telefono"],$registro["tope_credito"],$registro["inactivo"]);
		
		$objConexion->cerrarBd();

		return $objCliente1;
	}



  	
  }

?>