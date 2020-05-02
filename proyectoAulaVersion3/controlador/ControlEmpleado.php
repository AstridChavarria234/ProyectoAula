<?php 

class ControlEmpleado {
    var $objEmpleado;

	function __construct($objEmpleado){
	$this->objEmpleado=$objEmpleado;

	}


	function guardar(){

		print("ingreso a guardar"); 
		$sv="localhost";
		$us="root";
		$ps="";
		$bd="bdproyectoaulav1";
		
	$doc=$this->objEmpleado->getDocumento();
	$nom=$this->objEmpleado->getNombre();
	$fIng=$this->objEmpleado->getFIngreso();
	$fRet=$this->objEmpleado->getFRetiro(); 
	$salario=$this->objEmpleado->getSalario();
	$dedu=$this->objEmpleado->getDeduccion();
	$urlF=$this->objEmpleado->getUrlFoto();
	$CV=$this->objEmpleado->getCV();
	$email=$this->objEmpleado->getEmail();
	$telFijo=$this->objEmpleado->getTelFijo();
	$telCel=$this->objEmpleado->getTelCel();
	$urlFoto=$this->objEmpleado->getUrlFoto();
	$CV=$this->objEmpleado->getCV();
	$objConexion = new ControlConexion();
	$objConexion->abrirBd($sv,$us,$ps,$bd);
	$comandoSql="INSERT INTO EMPLEADO(nombre,documento,fecha_ingreso,fecha_retiro,salario_basico,deduccion,foto,hoja_vida,email,telefono,celular,inactivo) VALUES('".$nom."','".$doc."','".$fIng."','".$fRet."','".$salario."','".$dedu."', '".$urlFoto."', '".$CV."', '".$email."',".$telFijo.",".$telCel.",0)";
	$objConexion->ejecutarComandoSql($comandoSql);
	$objConexion->cerrarBd();
}

	function modificar(){

		$sv="localhost";
		$us="root";
		$ps="";
		$bd="bdproyectoaulav1";
		print("ingreso modificacion");
	
	
		$doc=$this->objEmpleado->getDocumento();
		$nom=$this->objEmpleado->getNombre();
		$fIng=$this->objEmpleado->getFIngreso();
		$fRet=$this->objEmpleado->getFRetiro();
		$salario=$this->objEmpleado->getSalario();
		$dedu=$this->objEmpleado->getDeduccion();
		$urlF=$this->objEmpleado->getUrlFoto();
		$CV=$this->objEmpleado->getCV();
		$email=$this->objEmpleado->getEmail();
		$telFijo=$this->objEmpleado->getTelFijo();
		$telCel=$this->objEmpleado->getTelCel();
		$urlFoto=$this->objEmpleado->getUrlFoto();
		$CV=$this->objEmpleado->getCV();
		$objConexion = new ControlConexion();
		$objConexion->abrirBd($sv,$us,$ps,$bd);
		

        $comandoSql="UPDATE Empleado SET nombre='".$nom."',fecha_ingreso ='".$fIng."',fecha_retiro='".$fRet."',salario_basico ='".$salario."',deduccion=".$dedu.",foto ='".$urlFoto."',hoja_vida ='".$CV."',email ='".$email."',telefono =".$telFijo.",celular =".$telCel." WHERE documento='".$doc."'";
	    $objConexion->ejecutarComandoSql($comandoSql);
	    $objConexion->cerrarBd();

	}

	function inactivar(){

		$sv="localhost";
		$us="root";
		$ps="";
		$bd="bdproyectoaulav1";

		$doc=$this->objEmpleado->getDocumento();
		PRINT("documento inac" .$doc);
		$objConexion = new ControlConexion();
		$objConexion->abrirBd($sv,$us,$ps,$bd);
		$comandoSql="UPDATE Empleado SET inactivo=1 WHERE documento='".$doc."'";
		$objConexion->ejecutarComandoSql($comandoSql);
		$objConexion->cerrarBd();
	}

	
	function consultar(){

		$sv="localhost";
		$us="root";
		$ps="";
		$bd="bdproyectoaulav1";
		

		$doc=$this->objEmpleado->getDocumento();
		print("ingreso a consultar".$doc);

		$objConexion = new ControlConexion();
		$objConexion->abrirBd($sv,$us,$ps,$bd);
	    $comandoSql="SELECT * FROM Empleado  WHERE DOCUMENTO='".$doc."'";
		$recordSet=$objConexion->ejecutarSelect($comandoSql);
		$registro = $recordSet->fetch_array(MYSQLI_BOTH);
		$this->objEmpleado->setNombre($registro["nombre"]);
        $this->objEmpleado->setFIngreso($registro["fecha_ingreso"]);
        $this->objEmpleado->setFRetiro($registro["fecha_retiro"]);
        $this->objEmpleado->setSalario($registro["salario_basico"]);
        $this->objEmpleado->setDeduccion($registro["deduccion"]);
        $this->objEmpleado->setUrlFoto($registro["foto"]);
        $this->objEmpleado->setCV($registro["hoja_vida"]);
        $this->objEmpleado->setEmail($registro["email"]);
		$this->objEmpleado->setTelFijo($registro["telefono"]);
		$this->objEmpleado->setInactivo($registro["inactivo"]);
		$this->objEmpleado->setTelCel($registro["celular"]);

		$objConexion->cerrarBd();
	
		return $this->objEmpleado;
	}



}
?>