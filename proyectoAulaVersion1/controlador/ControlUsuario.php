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
    $estado = $this->objUsuario->getEstado();
    $objConexion = new ControlConexion();
    $objConexion->abrirBd($sv,$us,$ps,$bd);
    $comandoSql="INSERT INTO USUARIO(usuario,clave,nivel,estado) VALUES('".$usu."','".$clave."',".$nivel.", ".$estado.")";
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
        $comandoSql="UPDATE USUARIO SET estado=1 WHERE id='".$id."'";
        $objConexion->ejecutarComandoSql($comandoSql);
        $objConexion->cerrarBd();
    }

    
    function consultar(){

        $sv="localhost";
        $us="root";
        $ps="";
        $bd="bdproyectoaulav1";
        
        $id=$this->objUsuario->getId();
        $objConexion = new ControlConexion();
        $objConexion->abrirBd($sv,$us,$ps,$bd);
        $comandoSql="SELECT * FROM USUARIO  WHERE id=".$id."";
        $recordSet=$objConexion->ejecutarSelect($comandoSql);
        $registro=$recordSet->fetch_array(MYSQLI_BOTH);
        $objUsuario1 = new Usuario($registro["id"],$registro["usuario"],$registro["clave"],$registro["nivel"],$registro["estado"]);
    
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
        $objUsuario1= new Usuario($registro["id"], $registro["usuario"], $registro["clave"],$registro["nivel"],$registro["estado"]);
        $objConexion->cerrarBd();

        return $objUsuario1;
    
    
    }



    function consultarPorUsuario(){

        $sv="localhost";
        $us="root";
        $ps="";
        $bd="bdproyectoaulav1";
        
        $usuario=$this->objUsuario->getUsuario();
        $objConexion = new ControlConexion();
        $objConexion->abrirBd($sv,$us,$ps,$bd);
        $comandoSql="SELECT * FROM USUARIO  WHERE usuario='".$usuario."'";
        $recordSet=$objConexion->ejecutarSelect($comandoSql);
        $registro = $recordSet->fetch_array(MYSQLI_BOTH);
        $objUsuario1 = new Usuario($registro["id"],$registro["usuario"],$registro["clave"],$registro["nivel"],$registro["estado"]);
        $objConexion->cerrarBd();
    
        return $objUsuario1;
    }
    
    function arrayUsuarioProveedor(){

         $sv="localhost";
         $us="root";
         $ps="";
         $bd="bdproyectoaulav1";
       $objConexion=new ControlConexion();
       $objConexion->abrirBd($sv,$us,$ps,$bd);
       $comandoSql="SELECT * FROM usuario WHERE nivel = 3 AND estado =0";
       $recordSet=$objConexion->ejecutarSelect($comandoSql);
         
             while ($registro = $recordSet->fetch_array(MYSQLI_BOTH))
             {
                 $datos[] = $registro;	
             }
 
          $objConexion->cerrarBd();
         return $datos;
         
 }

  function consultarAll(){

    
        $objConexion = new ControlConexion();
        $objConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
        $comandoSql="SELECT * FROM USUARIO";
        $recordSet=$objConexion->ejecutarSelect($comandoSql);
        
        while($registro = $recordSet->fetch_all(MYSQLI_BOTH)){
    
            $usuario=(array)$registro;
    
        }
        
             
        
        $objConexion->cerrarBd();
        return $usuario;
    
    }

    function cantidad($empezar_desde,$usuariosxPagina){

        $objConexion = new ControlConexion();
        $objConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
        $comandoSql="SELECT *  FROM USUARIO LIMIT ".$empezar_desde." , ".$usuariosxPagina."";
        
        
        $recordSet=$objConexion->ejecutarSelect($comandoSql);
        
        while($registro = $recordSet->fetch_all(MYSQLI_BOTH)){
    
            $usuarioPage=(array)$registro;
            
    
            
        }
        
             
        
        $objConexion->cerrarBd();
        return $usuarioPage;
    }

}



?>

