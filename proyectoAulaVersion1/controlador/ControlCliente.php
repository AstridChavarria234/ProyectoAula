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
	$comuna=$this->objCliente->getComuna();
	$barrio=$this->objCliente->getBarrio();
	$latitud=$this->objCliente->getLatitud();
	$longitud=$this->objCliente->getLongitud();
	$id = $this->objCliente->getId();
	$objConexion = new ControlConexion();

	$objConexion->abrirBd($sv,$us,$ps,$bd);
	$comandoSql="INSERT INTO CLIENTE(codigo,nombre,tipo_persona,fecha_registro,fecha_inactivo,url_imagen,email,telefono,tope_credito,comuna,barrio,id_usuario,latitud,longitud) VALUES('".$cod."','".$nom."','".$tPersona."','".$fReg."','".$fInact."','".$urlImg."','".$email."',".$tel.",".$topCred.",'".$comuna."','".$barrio."',".$id.",'".$latitud."','".$longitud."')";

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
		$comuna=$this->objCliente->getComuna();
		$barrio=$this->objCliente->getBarrio();
		$latitud=$this->objCliente->getLatitud();
		$longitud=$this->objCliente->getLongitud();
		$objConexion = new ControlConexion();
		$objConexion->abrirBd($sv,$us,$ps,$bd);
		

        $comandoSql="UPDATE CLIENTE SET nombre='".$nom."',tipo_persona ='".$tPersona."',fecha_registro ='".$fReg."',fecha_inactivo='".$fInact."',url_imagen ='".$urlImg."',email ='".$email."',telefono =".$tel.",tope_credito =".$topCred.",comuna ='".$comuna."',barrio ='".$barrio."',latitud ='".$latitud."',longitud ='".$longitud."' WHERE codigo='".$cod."'";
	    $objConexion->ejecutarComandoSql($comandoSql);
	    $objConexion->cerrarBd();

	}

	/*function inactivar(){

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

	*/
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
		$registro["telefono"],$registro["tope_credito"],$registro["comuna"],$registro["barrio"],$registro["id_usuario"],$registro["latitud"],$registro["longitud"]);
		
		$objConexion->cerrarBd();

		return $objCliente1;
	}


	function consultarPorId(){

		$sv="localhost";
		$us="root";
		$ps="";
		$bd="bdproyectoaulav1";
		

		$id_usuario=$this->objCliente->getId();

		
		$objConexion = new ControlConexion();
		$objConexion->abrirBd($sv,$us,$ps,$bd);
	    $comandoSql="SELECT * FROM Cliente  WHERE id_usuario=".$id_usuario."";
		$recordSet=$objConexion->ejecutarSelect($comandoSql);
		$registro = $recordSet->fetch_array(MYSQLI_BOTH);

		$objCliente1 = new Cliente ($registro["codigo"],$registro["nombre"],$registro["tipo_persona"],$registro["fecha_registro"],$registro["fecha_inactivo"],$registro["url_imagen"],$registro["email"],
		$registro["telefono"],$registro["tope_credito"],$registro["comuna"],$registro["barrio"],$registro["id_usuario"],$registro["latitud"],$registro["longitud"]);


		
		$objConexion->cerrarBd();	
		return $objCliente1;
	}

	  function consultarAll(){

    
        $objConexion = new ControlConexion();
        $objConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
        $comandoSql="SELECT * FROM CLIENTE";
        $recordSet=$objConexion->ejecutarSelect($comandoSql);
        
        while($registro = $recordSet->fetch_all(MYSQLI_BOTH)){
    
            $cliente=(array)$registro;
    
        }
        
        $objConexion->cerrarBd();
        return $cliente;
    
    }

    function cantidad($empezar_desde,$clientesxPagina){

        $objConexion = new ControlConexion();
        $objConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
        $comandoSql="SELECT *  FROM CLIENTE LIMIT ".$empezar_desde." , ".$clientesxPagina."";
        
        
        $recordSet=$objConexion->ejecutarSelect($comandoSql);
        
        while($registro = $recordSet->fetch_all(MYSQLI_BOTH)){
    
            $clientePage=(array)$registro;
            
    
            
        }
              
        $objConexion->cerrarBd();
        return $clientePage;
	}
	


	
	function arrayCliente($datosUsuario){



		$sv="localhost";
		$us="root";
		$ps="";
		$bd="bdproyectoaulav1";

	$objConexion=new ControlConexion();
	$objConexion->abrirBd($sv,$us,$ps,$bd);
		
	for($i=0;$i<count($datosUsuario);$i++)
	{
		$id= $datosUsuario[$i][0];
		$comandoSql="SELECT * FROM Cliente  WHERE id_usuario=".$id."";
		$recordSet=$objConexion->ejecutarSelect($comandoSql);
		$registro = $recordSet->fetch_array(MYSQLI_BOTH);
		$datos[] = $registro;	
	}
	
	$objConexion->cerrarBd();
	return $datos;
	
	
	}
  	
  }

?>