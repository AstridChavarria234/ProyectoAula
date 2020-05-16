<?php


class Usuario{

    var $id;
    var $nombre;
    var $clave;
    var $nivel;
    var $estado;
    function __construct($id,$usuario,$clave,$nivel,$estado)
    {
        $this->id=$id;
        $this->usuario=$usuario;
        $this->clave=$clave;
        $this->nivel=$nivel;
        $this->estado=$estado;

    }

    function setId($id) { $this->setId = $id; }
    function getId() { return $this->id; }

    function setUsuario($usuario) { $this->setUsuario = $usuario; }
    function getUsuario() { return $this->usuario; }

    function setClave($clave) { $this->setClave = $clave; }
    function getClave() { return $this->clave; }

    function setNivel($nivel) { $this->setNivel = $nivel; }
    function getNivel() { return $this->nivel; }
    
    function setEstado($estado) { $this->setEstado = $estado; }
    function getEstado() { return $this->estado; }

}

?>