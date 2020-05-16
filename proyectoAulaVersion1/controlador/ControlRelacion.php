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

        
	

	
	function consultar($codigo){


		print("codi" . $codigo);

		$sv="localhost";
		$us="root";
		$ps="";
		$bd="bdproyectoaulav1";

		$objConexion = new ControlConexion();
		$objConexion->abrirBd($sv,$us,$ps,$bd);
	    $comandoSql="SELECT idProveedor FROM  productoproveedor  WHERE idProducto='".$codigo."'";
		$recordSet=$objConexion->ejecutarSelect($comandoSql);
		$registro = $recordSet->fetch_array(MYSQLI_BOTH);
		$this->objRelacion->setProducto($registro["idProducto"]);
     
		$objConexion->cerrarBd();
	
	
        return $registro["idProveedor"];
    
    }
   

}

    ?>