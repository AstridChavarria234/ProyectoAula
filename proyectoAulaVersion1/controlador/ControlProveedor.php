	<?php 

	class ControlProveedor {
		var $objProveedor;

		function __construct($objProveedor){
		$this->objProveedor=$objProveedor;

		}


		function guardar(){

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
		$comuna=$this->objProveedor->getComuna();
		$barrio=$this->objProveedor->getBarrio();
		$id=$this->objProveedor->getId();
		
		$objConexion = new ControlConexion();
		$objConexion->abrirBd($sv,$us,$ps,$bd);
		$comandoSql="INSERT INTO PROVEEDOR(codigo,nombre,tipo,fechaRegistro,fechaInactivo,urlImagen,email,telefono,comuna,barrio,id_usuario) VALUES('".$codigo."','".$nombre."','".$tipo."','".$fRet."','".$fInac."','".$urlImagen."', '".$email."', '".$telefono."','".$comuna."','".$barrio."',".$id.")";
		$objConexion->ejecutarComandoSql($comandoSql);
		$objConexion->cerrarBd();
	}

		function modificar(){

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
			$comuna=$this->objProveedor->getComuna();
		    $barrio=$this->objProveedor->getBarrio();
			$objConexion = new ControlConexion();
			$objConexion->abrirBd($sv,$us,$ps,$bd);
			$comandoSql="UPDATE PROVEEDOR SET nombre='".$nombre."' ,tipo='".$tipo."',fechaInactivo='".$fInac."',urlImagen='".$urlImagen."',email ='".$email."',telefono ='".$telefono."',comuna ='".$comuna."',barrio ='".$barrio."' WHERE codigo='".$codigo."'";
			$objConexion->ejecutarComandoSql($comandoSql);
			$objConexion->cerrarBd();

		}

		/*function inactivar(){

			$sv="localhost";
			$us="root";
			$ps="";
			$bd="bdproyectoaulav1";

			$codigo=$this->objProveedor->getCodigo();
			$objConexion = new ControlConexion();
			$objConexion->abrirBd($sv,$us,$ps,$bd);
			$comandoSql="UPDATE Proveedor SET inactivo=1 WHERE codigo='".$codigo."'";
			$objConexion->ejecutarComandoSql($comandoSql);
			$objConexion->cerrarBd();
		}

		*/

		function consultar(){

			$sv="localhost";
			$us="root";
			$ps="";
			$bd="bdproyectoaulav1";
			$codigo=$this->objProveedor->getCodigo();
			$objConexion = new ControlConexion();
			$objConexion->abrirBd($sv,$us,$ps,$bd);
			$comandoSql="SELECT * FROM Proveedor  WHERE CODIGO='".$codigo."'";
			$recordSet=$objConexion->ejecutarSelect($comandoSql);
			$registro = $recordSet->fetch_array(MYSQLI_BOTH);
			
			$objProveedor1 = new Proveedor($registro["codigo"], $registro["nombre"],$registro["tipo"],$registro["fechaRegistro"],
			$registro["fechaInactivo"],$registro["urlImagen"],$registro["email"],$registro["telefono"],$registro["comuna"],$registro["barrio"],$registro["id_usuario"]);
			$objConexion->cerrarBd();
			return $objProveedor1;
		}

		function arrayProveedor($datosUsuario){



			$sv="localhost";
			$us="root";
			$ps="";
			$bd="bdproyectoaulav1";

		$objConexion=new ControlConexion();
		$objConexion->abrirBd($sv,$us,$ps,$bd);
			
		for($i=0;$i<count($datosUsuario);$i++)
		{
			$id= $datosUsuario[$i][0];
			$comandoSql="SELECT * FROM Proveedor  WHERE id_usuario=".$id."";
			$recordSet=$objConexion->ejecutarSelect($comandoSql);
			$registro = $recordSet->fetch_array(MYSQLI_BOTH);
			$datos[] = $registro;	
		}
		
		$objConexion->cerrarBd();

		return $datos;
		
		
	
		}
		


		function consultarPorId($id){

			$sv="localhost";
			$us="root";
			$ps="";
			$bd="bdproyectoaulav1";

			$objConexion = new ControlConexion();
			$objConexion->abrirBd($sv,$us,$ps,$bd);
			$comandoSql="SELECT * FROM Proveedor  WHERE ID_USUARIO=".$id."";
			$recordSet=$objConexion->ejecutarSelect($comandoSql);
			$registro = $recordSet->fetch_array(MYSQLI_BOTH);
			$objProveedor1 = new Proveedor($registro["codigo"], $registro["nombre"],$registro["tipo"],$registro["fechaRegistro"],
			$registro["fechaInactivo"],$registro["urlImagen"],$registro["email"],$registro["telefono"],$registro["comuna"],$registro["barrio"],$registro["id_usuario"]);
			
			$objConexion->cerrarBd();
			
			
			return $objProveedor1;
		}

		  function consultarAll(){

    
        $objConexion = new ControlConexion();
        $objConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
        $comandoSql="SELECT * FROM PROVEEDOR";
        $recordSet=$objConexion->ejecutarSelect($comandoSql);
        
        while($registro = $recordSet->fetch_all(MYSQLI_BOTH)){
    
            $proveedor=(array)$registro;
    
        }
        
             
        
        $objConexion->cerrarBd();
        return $proveedor;
    
    }

    function cantidad($empezar_desde,$proveedoresxPagina){

        $objConexion = new ControlConexion();
        $objConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
        $comandoSql="SELECT *  FROM PROVEEDOR LIMIT ".$empezar_desde." , ".$proveedoresxPagina."";
        
        
        $recordSet=$objConexion->ejecutarSelect($comandoSql);
        
        while($registro = $recordSet->fetch_all(MYSQLI_BOTH)){
    
            $proveedorPage=(array)$registro;
            
    
            
        }
        
             
        
        $objConexion->cerrarBd();
        return $proveedorPage;
    }


	}
	?>