<?php


class Producto{

    var $codigo;
    var $nombre;
    var $urlImagen;
    var $ddeshabilitado;

    function __construct($codigo,$nombre,$urlImagen,$deshabilitado)
    {
        $this->codigo=$codigo;
        $this->nombre=$nombre;
        $this->urlImagen=$urlImagen;
        $this->deshabilitado=$deshabilitado;
      
    }

    function setCodigo($codigo) { $this->setCodigo = $codigo; }
    function getCodigo() { return $this->codigo; }

    function setNombre($nombre) { $this->setNombre = $nombre; }
    function getNombre() { return $this->nombre; }

    function setUrlImagen($urlImagen) { $this->setUrlImagen = $urlImagen; }
    function getUrlImagen() { return $this->urlImagen; }

    function setDeshabilitado($deshabilitado) { $this->setDeshabilitado = $deshabilitado; }
    function getDeshabilitado() { return $this->deshabilitado; }


}

?>