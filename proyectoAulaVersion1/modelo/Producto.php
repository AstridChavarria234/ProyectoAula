<?php


class Producto{

    var $codigo;
    var $nombre;
    var $urlImagen;

    function __construct($codigo,$nombre,$urlImagen)
    {
        $this->codigo=$codigo;
        $this->nombre=$nombre;
        $this->urlImagen=$urlImagen;
      
    }

    function setCodigo($codigo) { $this->setCodigo = $codigo; }
    function getCodigo() { return $this->codigo; }

    function setNombre($nombre) { $this->setNombre = $nombre; }
    function getNombre() { return $this->nombre; }

    function setUrlImagen($urlImagen) { $this->setUrlImagen = $urlImagen; }
    function getUrlImagen() { return $this->urlImagen; }


}

?>