<?php


class Proveedor{

    var $codigo;
    var $nombre;
    var $tipo;
    var $fRegistro;
    var $fInactivo;
    var $urlImagen;
    var $email;
    var $telefono;
    var $inactivo;
    function __construct($codigo,$nombre,$tipo,$fRegistro,$fInactivo,$urlImagen,$email,$telefono,$inactivo)
    {
        $this->codigo=$codigo;
        $this->nombre=$nombre;
        $this->tipo=$tipo;
        $this->fRegistro=$fRegistro;
        $this->fInactivo=$fInactivo;
        $this->urlImagen=$urlImagen;
        $this->email=$email;
        $this->telefono=$telefono;
        $this->inactivo=$inactivo;
        
      
    }

    function setCodigo($codigo) { $this->setCodigo = $codigo; }
    function getCodigo() { return $this->codigo; }

    function setNombre($nombre) { $this->setNombre = $nombre; }
    function getNombre() { return $this->nombre; }

    function setTipo($tipo) { $this->setTipo = $tipo; }
    function getTipo() { return $this->tipo; }

    function setFRegistro($fRegistro) { $this->setFRegistro = $fRegistro; }
    function getFRegistro() { return $this->fRegistro; }

     function setFInactivo($fInactivo) { $this->setFInactivo = $fInactivo; }
    function getFInactivo() { return $this->fInactivo; }

    function setUrlImagen($urlImagen) { $this->setUrlImagen = $urlImagen; }
    function getUrlImagen() { return $this->urlImagen; }

    function setEmail($email) { $this->setEmail = $email; }
    function getEmail() { return $this->email; }

    function setTelefono($telefono) { $this->setTelefono = $telefono; }
    function getTelefono() { return $this->telefono; }


    function setInactivo($inactivo) { $this->setInactivo = $inactivo; }
    function getInactivo() { return $this->inactivo; }


}

?>