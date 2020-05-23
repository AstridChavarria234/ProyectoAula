	<?php 

	class ControlProducto {
		var $objProducto;

		function __construct($objProducto){
		$this->objProducto=$objProducto;

		}


		function guardar(){

			
			$sv="localhost";
			$us="root";
			$ps="";
			$bd="bdproyectoaulav1";
			
		$cod=$this->objProducto->getCodigo();
		$nom=$this->objProducto->getNombre();
		$urlImg=$this->objProducto->getUrlImagen();
		$objConexion = new ControlConexion();
		$objConexion->abrirBd($sv,$us,$ps,$bd);
		$comandoSql="INSERT INTO PRODUCTO(codigo,nombre,url_imagen,deshabilitado) VALUES('".$cod."','".$nom."','".$urlImg."',0)";
		$objConexion->ejecutarComandoSql($comandoSql);
		$objConexion->cerrarBd();
	}

		function modificar(){

			$sv="localhost"; 
			$us="root";
			$ps="";
			$bd="bdproyectoaulav1";
			$cod=$this->objProducto->getCodigo();
			$nom=$this->objProducto->getNombre();
			$urlImg=$this->objProducto->getUrlImagen();
			$objConexion = new ControlConexion();
			$objConexion->abrirBd($sv,$us,$ps,$bd);

			$comandoSql="UPDATE PRODUCTO SET nombre='".$nom."',url_imagen ='".$urlImg."' WHERE codigo='".$cod."'";
			$objConexion->ejecutarComandoSql($comandoSql);
			$objConexion->cerrarBd();

		}

		function inactivar(){

			$sv="localhost";
			$us="root";
			$ps="";
			$bd="bdproyectoaulav1";

			$cod=$this->objProducto->getCodigo();
			$objConexion = new ControlConexion();
			$objConexion->abrirBd($sv,$us,$ps,$bd);
			$comandoSql="UPDATE PRODUCTO SET deshabilitado=1 WHERE codigo='".$cod."'";
			$objConexion->ejecutarComandoSql($comandoSql);
			$objConexion->cerrarBd();
		}


		function consultar(){

			$sv="localhost";
			$us="root";
			$ps="";
			$bd="bdproyectoaulav1";
			$cod=$this->objProducto->getCodigo();
			$objConexion = new ControlConexion();
			$objConexion->abrirBd($sv,$us,$ps,$bd);
			$comandoSql="SELECT * FROM Producto  WHERE CODIGO='".$cod."'";
			$recordSet=$objConexion->ejecutarSelect($comandoSql);
			$registro = $recordSet->fetch_array(MYSQLI_BOTH);
			$objProducto1 = new Producto($registro["codigo"],$registro["nombre"],$registro["url_imagen"],$registro["deshabilitado"]);
			$objConexion->cerrarBd();
		
			return $objProducto1;

		}

		  function consultarAll(){

    
        $objConexion = new ControlConexion();
        $objConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
        $comandoSql="SELECT * FROM PRODUCTO";
        $recordSet=$objConexion->ejecutarSelect($comandoSql);
        
        while($registro = $recordSet->fetch_all(MYSQLI_BOTH)){
    
            $producto=(array)$registro;
    
        }
        
             
        
        $objConexion->cerrarBd();
        return $producto;
    
    }

    function cantidad($empezar_desde,$productosxPagina){

        $objConexion = new ControlConexion();
        $objConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
        $comandoSql="SELECT *  FROM PRODUCTO LIMIT ".$empezar_desde." , ".$productosxPagina."";
        
        
        $recordSet=$objConexion->ejecutarSelect($comandoSql);
        
        while($registro = $recordSet->fetch_all(MYSQLI_BOTH)){
    
            $productoPage=(array)$registro;
            
    
            
        }
        
             
        
        $objConexion->cerrarBd();
        return $productoPage;
    }


		




		

		
		



	}
	?>