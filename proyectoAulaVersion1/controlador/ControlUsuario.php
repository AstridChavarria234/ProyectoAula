<?php 

class ControlUsuario {
    var $objUsuario;

	function __construct($objUsuario){
	$this->objUsuario=$objUsuario;

    }
    


    function consultar(){



        $sv="localhost";
		$us="root";
		$ps="";
        $bd="bdproyectoaulav1";
        $usuario=$this->objUsuario->getUsuario();
        $clave=$this->objUsuario->getClave();

        $objConexion = new ControlConexion();
        $objConexion->abrirBd($sv,$us,$ps,$bd);
        
        $comandoSql="SELECT * FROM USUARIO  WHERE USUARIO='".$usuario."' AND CLAVE='".$clave."'";
		$recordSet=$objConexion->ejecutarSelect($comandoSql);
		$registro = $recordSet->fetch_array(MYSQLI_BOTH);
        $objConexion->cerrarBd();

        return $registro["nivel"];

    
    
    }

}
?>