<?php


class Notificacion{

    var $idUsu;
    var $nombre;
    var $tipoUsu;
    var $objeto;
    function __construct($idUsu,$nombre,$tipoUsu,$objeto)
    {
        $this->idUsu=$idUsu;
        $this->nombre=$nombre;
        $this->tipoUsu=$tipoUsu;
        $this->objeto=$objeto;

    }

    function setIdUsu($idUsu) { $this->setIdUsu = $idUsu; }
    function getIdUsu() { return $this->idUsu; }

    function setNombre($nombre) { $this->setNombre = $nombre; }
    function getNombre() { return $this->nombre; }

    function setTipoUsu($tipoUsu) { $this->setTipoUsu = $tipoUsu; }
    function getTipoUsu() { return $this->tipoUsu; }

    function setObjeto($objeto) { $this->setObjeto = $objeto; }
    function getObjeto() { return $this->objeto; }


}

?>