<?php 

class ControlRelacion {
    var $objRelacion;

	function __construct($objRelacion){
	$this->objRelacion=$objRelacion;

    }
    


    function guardar(){


		$sv="localhost";
		$us="root";
		$ps="";
		$bd="bdproyectoaulav1";
		
		$proveedor=$this->objRelacion->getProveedor();
		$producto=$this->objRelacion->getProducto();

	$objConexion = new ControlConexion();
	$objConexion->abrirBd($sv,$us,$ps,$bd);

	$comandoSql="INSERT INTO PRODUCTOPROVEEDOR(idProveedor,idProducto) VALUES('".$proveedor."','".$producto."')";
	$objConexion->ejecutarComandoSql($comandoSql);
	$objConexion->cerrarBd();
}

        
		
	


	/*function modificar(){

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
		

        $proveedor=$this->objRelacion->getProveedor();
        $producto=$this->objRelacion->getProducto();
		$objConexion = new ControlConexion();
		$objConexion->abrirBd($sv,$us,$ps,$bd);
	    $comandoSql="SELECT * FROM  productoproveedor  WHERE idProveedor='".$proveedor."'AND  idProducto='".$producto."'";
		$recordSet=$objConexion->ejecutarSelect($comandoSql);
		$registro = $recordSet->fetch_array(MYSQLI_BOTH);
		$this->objRelacion->setProducto($registro["idProducto"]);
        $this->objEmpleado->setProveedor($registro["fecha_ingreso"]);
    

		$objConexion->cerrarBd();
	
        return $this->objEmpleado;
    
    }
       */ 

}

    ?>