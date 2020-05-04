<?php


class Usuario{

    var $id;
    var $nombre;
    var $clave;
    var $nivel;
    function __construct($id,$usuario,$clave,$nivel)
    {
        $this->id=$id;
        $this->usuario=$usuario;
        $this->clave=$clave;
        $this->nivel=$nivel;

    }

    function setId($id) { $this->setId = $id; }
    function getId() { return $this->id; }

    function setUsuario($usuario) { $this->setUsuario = $usuario; }
    function getUsuario() { return $this->usuario; }

    function setClave($clave) { $this->setClave = $clave; }
    function getClave() { return $this->clave; }

    function setNivel($nivel) { $this->setNivel = $nivel; }
    function getNivel() { return $this->nivel; }

}

?>