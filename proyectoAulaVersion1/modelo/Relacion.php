<?php


class Relacion{

    var $codProveedor;
    var $codProducto;
    
    function __construct($codProveedor,$codProducto)
    {
        $this->codProducto=$codProducto;
        $this->codProveedor=$codProveedor;

    }

    function setProducto($codProducto) { $this->setProducto = $setProducto; }
    function getProducto() { return $this->codProducto; }

    function setProveedor($codProveedor) { $this->setProveedor = $codProveedor; }
    function getProveedor() { return $this->codProveedor; }

  

}

?>