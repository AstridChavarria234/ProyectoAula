<?php
class Empleado{
    var $documento;
    var $nombre;
    var $fIngreso;
    var $fRetiro;
    var $salario;
    var $deduccion;
    var $urlFoto;
    var $CV;
    var $email;
    var $telFijo;
    var $telCel;
    var $id_usuario;
    function __construct($documento,$nombre,$fIngreso,$fRetiro,$salario,$deduccion,$urlFoto,$CV,$email,$telFijo,$telCel,$id_usuario)
    {
        $this->documento=$documento;
        $this->nombre=$nombre;
        $this->fIngreso=$fIngreso;
        $this->fRetiro=$fRetiro;
        $this->salario=$salario;
        $this->deduccion=$deduccion;
        $this->urlFoto=$urlFoto;
        $this->CV=$CV;
        $this->email=$email;
        $this->telFijo=$telFijo;
        $this->telCel=$telCel;
        $this->id_usuario=$id_usuario;
    }
    function setDocumento($documento) { $this->documento = $documento; }
    function getDocumento() { return $this->documento; }

    function setNombre($nombre) { $this->nombre = $nombre; }
    function getNombre() { return $this->nombre; }

    function setFIngreso($fIngreso) { $this->fIngreso = $fIngreso; }
    function getFIngreso() { return $this->fIngreso; }

     function setFRetiro($fRetiro) { $this->fRetiro = $fRetiro; }
    function getFRetiro() { return $this->fRetiro; }

     function setSalario($salario) { $this->salario = $salario; }
    function getSalario() { return $this->salario; }

     function setDeduccion($deduccion) { $this->deduccion = $deduccion; }
    function getDeduccion() { return $this->deduccion; }

     function setUrlFoto($urlFoto) { $this->urlFoto = $urlFoto; }
    function getUrlFoto() { return $this->urlFoto; }

     function setCV($CV) { $this->CV = $CV; }
    function getCV() { return $this->CV; }

     function setEmail($email) { $this->email = $email; }
    function getEmail() { return $this->email; }

     function setTelFijo($telFijo) { $this->telFijo = $telFijo; }
    function getTelFijo() { return $this->telFijo; }

     function setTelCel($telCel) { $this->telCel = $telCel; }
    function getTelCel() { return $this->telCel; }

    function setId($id_usuario) { $this->id_usuario = $id_usuario; }
    function getId() { return $this->id_usuario; }

}
?>