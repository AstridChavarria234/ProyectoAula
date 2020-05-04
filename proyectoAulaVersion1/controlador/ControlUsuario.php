<?php 

class ControlUsuario{
    var $objUsuario;

    function __construct($objUsuario){
    $this->objUsuario=$objUsuario;

    }


    function guardar(){

        $sv="localhost";
        $us="root";
        $ps="";
        $bd="bdproyectoaulav1";
        
    $usu=$this->objUsuario->getUsuario();
    $clave=$this->objUsuario->getClave();
    $nivel=$this->objUsuario->getNivel();
    $objConexion = new ControlConexion();
    $objConexion->abrirBd($sv,$us,$ps,$bd);
    $comandoSql="INSERT INTO USUARIO(usuario,clave,nivel) VALUES('".$usu."','".$clave."','".$nivel."')";
    $objConexion->ejecutarComandoSql($comandoSql);
    $objConexion->cerrarBd();
}

    function modificar(){

        $sv="localhost";
        $us="root";
        $ps="";
        $bd="bdproyectoaulav1";
    
        $id=$this->objUsuario->getId();
        $usu=$this->objUsuario->getUsuario();
        $clave=$this->objUsuario->getClave();
        $nivel=$this->objUsuario->getNivel();
        $objConexion = new ControlConexion();
        $objConexion->abrirBd($sv,$us,$ps,$bd);
        

        $comandoSql="UPDATE USUARIO SET usuario='".$usu."',clave ='".$clave."',nivel='".$nivel."' WHERE id='".$id."'";
        $objConexion->ejecutarComandoSql($comandoSql);
        $objConexion->cerrarBd();

    }

    function inactivar(){

        $sv="localhost";
        $us="root";
        $ps="";
        $bd="bdproyectoaulav1";
        $id=$this->objUsuario->getId();
        $objConexion = new ControlConexion();
        $objConexion->abrirBd($sv,$us,$ps,$bd);
        $comandoSql="UPDATE USUARIO SET inactivo=1 WHERE id='".$id."'";
        $objConexion->ejecutarComandoSql($comandoSql);
        $objConexion->cerrarBd();
    }

    
    function consultar(){

        $sv="localhost";
        $us="root";
        $ps="";
        $bd="bdproyectoaulav1";
        

        $usu=$this->objUsuario->getUsuario();
        $objConexion = new ControlConexion();
        $objConexion->abrirBd($sv,$us,$ps,$bd);
        $comandoSql="SELECT * FROM USUARIO  WHERE usuario='".$usu."'";
        $recordSet=$objConexion->ejecutarSelect($comandoSql);
        $registro = $recordSet->fetch_array(MYSQLI_BOTH);
        $objUsuario1 = new Usuario($registro["id"],$registro["usuario"],$registro["clave"],$registro["nivel"]);
        $objConexion->cerrarBd();
    
        return $objUsuario1;
    }




     function consultarExistencia(){



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

