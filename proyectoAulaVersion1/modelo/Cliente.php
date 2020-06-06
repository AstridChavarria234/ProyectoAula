<?php


class Cliente{

    var $codigo;
    var $nombre;
    var $tipoPersona;
    var $fRegistro;
    var $fInactivo;
    var $urlImagen;
    var $email;
    var $telefono;
    var $topeCred;
    var $comuna;
    var $barrio;
    var $id_usuario;
    var $latitud;
    var $longitud;

    function __construct($codigo,$nombre,$tipoPersona,$fRegistro,$fInactivo,$urlImagen,$email,$telefono,$topeCred,$comuna,$barrio,$id_usuario,$latitud,$longitud)
    {
        $this->codigo=$codigo;
        $this->nombre=$nombre;
        $this->tipoPersona=$tipoPersona;
        $this->fRegistro=$fRegistro;
        $this->fInactivo=$fInactivo;
        $this->urlImagen=$urlImagen;
        $this->email=$email;
        $this->telefono=$telefono;
        $this->topeCred=$topeCred;
        $this->comuna=$comuna;
        $this->barrio=$barrio;
        $this->id_usuario=$id_usuario;
        $this->latitud=$latitud;
        $this->longitud=$longitud;
      
    }

    function setCodigo($codigo) { $this->setCodigo = $codigo; }
    function getCodigo() { return $this->codigo; }

    function setNombre($nombre) { $this->setNombre = $nombre; }
    function getNombre() { return $this->nombre; }

    function setTipoPersona($tipoPersona) { $this->setTipoPersona = $tipoPersona; }
    function getTipoPersona() { return $this->tipoPersona; }

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

    function setTopeCred($topeCred) { $this->setTopeCred = $topeCred; }
    function getTopeCred() { return $this->topeCred; }

    function setComuna($comuna) { $this->setComuna = $comuna; }
    function getComuna() { return $this->comuna; }

    function setBarrio($barrio) { $this->setBarrio = $barrio; }
    function getBarrio() { return $this->barrio; }

    function setId($id_usuario) { $this->id_usuario= $id_usuario; }
    function getId() { return $this->id_usuario; }

    function setLatitud($latitud) { $this->latitud= $latitud; }
    function getLatitud() { return $this->latitud; }

    function setLongitud($longitud) { $this->longitud= $longitud; }
    function getLongitud() { return $this->longitud; }

}

?>