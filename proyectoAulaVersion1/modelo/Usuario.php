<?php


class Usuario{

    var $nombre;
    var $clave;
    var $nivel;
    function __construct($usuario,$clave,$nivel)
    {
        $this->usuario=$usuario;
        $this->clave=$clave;
        $this->nivel=$nivel;

    }

    function setUsuario($usuario) { $this->setUsuario = $usuario; }
    function getUsuario() { return $this->usuario; }

    function setClave($clave) { $this->setClave = $clave; }
    function getClave() { return $this->clave; }

    function setNivel($nivel) { $this->setNivel = $nivel; }
    function getNivel() { return $this->nivel; }

}

?>