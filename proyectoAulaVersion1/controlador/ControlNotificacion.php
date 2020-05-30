<?php 

  
class ControlNotificacion{

      


    var $objNotificacion;

    function __construct($objNotificacion){
    $this->objNotificacion=$objNotificacion;

    }




    function guardar(){

        $sv="localhost";
        $us="root";
        $ps="";
        $bd="bdproyectoaulav1";
        
    $id=$this->objNotificacion->getIdUsu();
    $nom=$this->objNotificacion->getNombre();
    $tipo=$this->objNotificacion->getTipoUsu();
    $objeto = $this->objNotificacion->getObjeto();
    $objConexion = new ControlConexion();
    $objConexion->abrirBd($sv,$us,$ps,$bd);
    $comandoSql="INSERT INTO NOTIFICACION(id_usuario,nombre,tipo_usuario,objeto) VALUES(".$id.",'".$nom."',".$tipo.", '".$objeto."')";
    $objConexion->ejecutarComandoSql($comandoSql);
    $objConexion->cerrarBd();
}

    function modificar(){

        $sv="localhost";
        $us="root";
        $ps="";
        $bd="bdproyectoaulav1";
    
        $id=$this->objNotificacion->getId();
        $usu=$this->objNotificacion->getNotificacion();
        $clave=$this->objNotificacion->getClave();
        $nivel=$this->objNotificacion->getNivel();
        $objConexion = new ControlConexion();
        $objConexion->abrirBd($sv,$us,$ps,$bd);
        

        $comandoSql="UPDATE Notificacion SET usuario='".$usu."',clave ='".$clave."',nivel='".$nivel."' WHERE id='".$id."'";
        $objConexion->ejecutarComandoSql($comandoSql);
        $objConexion->cerrarBd();

    }


    
    function consultar(){

        $sv="localhost";
        $us="root";
        $ps="";
        $bd="bdproyectoaulav1";
        
        $id=$this->objNotificacion->getIdUsu();
        $objConexion = new ControlConexion();
        $objConexion->abrirBd($sv,$us,$ps,$bd);
        $comandoSql="SELECT * FROM Notificacion  WHERE id_usuario=".$id."";
        $recordSet=$objConexion->ejecutarSelect($comandoSql);
        $registro = $recordSet->fetch_array(MYSQLI_BOTH);
        $objNotificacion1 = new Notificacion($registro["id_usuario"],$registro["nombre"],$registro["tipo_usuario"],$registro["objeto"]);
    
        $objConexion->cerrarBd();
    
        return $objNotificacion1;
    }


    function eliminar(){

      $id_Usu=$this->objNotificacion->getIdUsu();


            $objConexion = new ControlConexion();
      $objConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
      $comandoSql="DELETE FROM NOTIFICACION WHERE id_usuario=".$id_Usu."";
      $objConexion->ejecutarComandoSql($comandoSql);
      $objConexion->cerrarBd();
      header("location:TablaNotificacion.php");

    }


  function consultarAll(){

    
        $objConexion = new ControlConexion();
        $objConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
        $comandoSql="SELECT * FROM NOTIFICACION";
        $recordSet=$objConexion->ejecutarSelect($comandoSql);
        
        while($registro = $recordSet->fetch_all(MYSQLI_BOTH)){
    
            $notificacion=(array)$registro;
    
        }
        
             
        
        $objConexion->cerrarBd();
        return $notificacion;
    
    }

    function cantidad($empezar_desde,$notificacionsxPagina){

        $objConexion = new ControlConexion();
        $objConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
        $comandoSql="SELECT *  FROM NOTIFICACION LIMIT ".$empezar_desde." , ".$notificacionsxPagina."";
        
        
        $recordSet=$objConexion->ejecutarSelect($comandoSql);
        
        while($registro = $recordSet->fetch_all(MYSQLI_BOTH)){
    
            $notificacionPage=(array)$registro;
            
    
            
        }
        
             
        
        $objConexion->cerrarBd();
        return $notificacionPage;
    }

}



?>

