<?php 

class ControlProveedor {
    var $objProveedor;

	function __construct($objProveedor){
	$this->objProveedor=$objProveedor;

	}


	function guardar(){

		print("ingreso a guardar"); 
		$sv="localhost";
		$us="root";
		$ps="";
		$bd="bdproyectoaulav1";
		
	$codigo=$this->objProveedor->getCodigo();
	$nombre=$this->objProveedor->getNombre();
	$tipo=$this->objProveedor->getTipo();
	$fRet=$this->objProveedor->getFRegistro(); 
	$fInac=$this->objProveedor->getFInactivo();
	$urlImagen=$this->objProveedor->getUrlImagen();
	$email=$this->objProveedor->getEmail();
	$telefono=$this->objProveedor->getTelefono();
	
	$objConexion = new ControlConexion();
	$objConexion->abrirBd($sv,$us,$ps,$bd);
	$comandoSql="INSERT INTO PROVEEDOR(codigo,nombre,tipo,fechaRegistro,fechaInactivo,urlImagen,email,telefono,inactivo) VALUES('".$codigo."','".$nombre."',".$tipo.",'".$fRet."','".$fInac."','".$urlImagen."', '".$email."', '".$telefono."',,0)";
	$objConexion->ejecutarComandoSql($comandoSql);
	$objConexion->cerrarBd();
}

	function modificar(){

		$sv="localhost";
		$us="root";
		$ps="";
		$bd="bdproyectoaulav1";
		print("ingreso modificacion");
	
	
        $codigo=$this->objProveedor->getCodigo();
        $nombre=$this->objProveedor->getNombre();
        $tipo=$this->objProveedor->getTipo();
        $fRet=$this->objProveedor->getFRegistro(); 
        $fInac=$this->objProveedor->getFInactivo();
        $urlImagen=$this->objProveedor->getUrlImagen();
        $email=$this->objProveedor->getEmail();
        $telefono=$this->objProveedor->getTelefono();
		$objConexion = new ControlConexion();
		$objConexion->abrirBd($sv,$us,$ps,$bd);
		
        $comandoSql="UPDATE PROVEEDOR SET nombre='".$nombre."',tipo =".$tipo.",fechaRegistro='".$fRet."',fechaInactivo='".$fInac."',urlImagen=".$urlImagen.",email ='".$email."',telefono ='".$telefono."',email ='".$email."' WHERE codigo='".$codigo."'";
	    $objConexion->ejecutarComandoSql($comandoSql);
	    $objConexion->cerrarBd();

	}

	function inactivar(){

		$sv="localhost";
		$us="root";
		$ps="";
		$bd="bdproyectoaulav1";

		$codigo=$this->objProveedor->getCodigo();
		PRINT("documento inac" .$doc);
		$objConexion = new ControlConexion();
		$objConexion->abrirBd($sv,$us,$ps,$bd);
		$comandoSql="UPDATE Proveedor SET inactivo=1 WHERE codigo='".$codigo."'";
		$objConexion->ejecutarComandoSql($comandoSql);
		$objConexion->cerrarBd();
	}

	
	function consultar(){

		$sv="localhost";
		$us="root";
		$ps="";
		$bd="bdproyectoaulav1";
		$codigo=$this->objProveedor->getCodigo();
		print("ingreso a consultar".$codigo);
		$objConexion = new ControlConexion();
		$objConexion->abrirBd($sv,$us,$ps,$bd);
	    $comandoSql="SELECT * FROM Proveedor  WHERE CODIGO='".$codigo."'";
		$recordSet=$objConexion->ejecutarSelect($comandoSql);
        $registro = $recordSet->fetch_array(MYSQLI_BOTH);
        
		$this->objProveedor->setNombre($registro["nombre"]);
        $this->objProveedor->setFRegistro($registro["fechaRegistro"]);
        $this->objProveedor->setFInactivo($registro["fechaInactivo"]);
        $this->objProveedor->setUrlImagen($registro["urlImagen"]);
        $this->objProveedor->setEmail($registro["email"]);
        $this->objProveedor->setTelefono($registro["telefono"]);
       
		$objConexion->cerrarBd();
	
		return $this->objProveedor;
	}



}
?>