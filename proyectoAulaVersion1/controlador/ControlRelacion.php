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

			$sv="localhost";
			$us="root";
			$ps="";
			$bd="bdproyectoaulav1";
			$objConexion = new ControlConexion();
			$objConexion->abrirBd($sv,$us,$ps,$bd);
			$comandoSql="SELECT idProveedor FROM  productoproveedor WHERE idProducto='".$codigo."'";
			$recordSet=$objConexion->ejecutarSelect($comandoSql);
			$registro = $recordSet->fetch_array(MYSQLI_BOTH);
			$this->objRelacion->setProducto($registro["idProducto"]);
			$objConexion->cerrarBd();
			return $registro["idProveedor"];
		
		}


		  function consultarAll(){

    	$codigo=$this->objRelacion->getProveedor();
        $objConexion = new ControlConexion();
        $objConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
        $comandoSql="SELECT * FROM PRODUCTOPROVEEDOR WHERE idProveedor='".$codigo."'";
        $recordSet=$objConexion->ejecutarSelect($comandoSql);
        
        while($registro = $recordSet->fetch_all(MYSQLI_BOTH)){
    
            $relacion=(array)$registro;
    
        }
        
             
        
        $objConexion->cerrarBd();
        return $relacion;
    
    }

    function cantidad($empezar_desde,$usuariosxPagina,$codigo){



        $objConexion = new ControlConexion();
        $objConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
        $comandoSql="SELECT prod.codigo,prod.nombre,prod.url_imagen,prod.deshabilitado
        from proveedor pro INNER JOIN productoproveedor prodpro ON (pro.codigo=prodpro.idProveedor)
                           INNER JOIN producto prod ON (prod.codigo=prodpro.idProducto)
        WHERE pro.codigo='".$codigo."' LIMIT ".$empezar_desde." , ".$usuariosxPagina."";
        
        $recordSet=$objConexion->ejecutarSelect($comandoSql);
        
        while($registro = $recordSet->fetch_all(MYSQLI_BOTH)){

        	
    
            $relacionPage=(array)$registro;
            
    
            
        }
        
             
        
        $objConexion->cerrarBd();
        return $relacionPage;
    }
	

	}

		?>