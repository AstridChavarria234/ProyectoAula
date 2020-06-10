  <?php

  session_start();


  if(!isset($_SESSION['usuario']) && !isset($_SESSION['clave']))
  header('Location:Index.php');

  include("../controlador/configBd.php");
                        include("../controlador/ControlConexion.php");
                        include("../modelo/Proveedor.php");
                        include("../controlador/ControlProveedor.php");
                        include("../modelo/Empleado.php");
                        include("../controlador/ControlEmpleado.php");
                        include("../modelo/Cliente.php");
                        include("../controlador/ControlCliente.php");
                        include("../modelo/Usuario.php");
                        include("../controlador/ControlUsuario.php");


                        $objUsuario = new Usuario ("", "", "", "", 0);
                        $objControlUsuario = new ControlUsuario($objUsuario); 
                        $datosUsuario =$objControlUsuario->arrayUsuarioProveedor();
                        
                        $objProveedor= new Proveedor("","","","","","","","","","","","","");
                        $objControlProveedor = new ControlProveedor($objProveedor);
                        $datos=$objControlProveedor->arrayProveedor($datosUsuario);                        
  
                        $objUsuario = new Usuario ("", "", "", "", 0);
                        $objControlUsuario = new ControlUsuario($objUsuario); 
                        $datosUsuario =$objControlUsuario->arrayUsuarioEmpleado();
                        
                        $objEmpleado= new Empleado("","","","","","","","","","","","","","","","");
                        $objControlEmpleado = new ControlEmpleado($objEmpleado);
                        $datosEmpleado=$objControlEmpleado->arrayEmpleado($datosUsuario);
  
                      
                        $objUsuario = new Usuario ("", "", "", "", 0);
                        $objControlUsuario = new ControlUsuario($objUsuario); 
                        $datosUsuario =$objControlUsuario->arrayUsuarioCliente();
                        
                        $objCliente= new Cliente("","","","","","","","","","","","","","");
                        $objControlCliente= new ControlCliente($objCliente);
                        $datosCliente=$objControlCliente->arrayCliente($datosUsuario);
                    
                      
?>


  <!DOCTYPE html>
  <html>
  <head>
  <meta charset='UTF-8'>

  <link rel="StyleSheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" type="text/css">
  <link rel="shortcut icon" type="image/x-icon" href="docs/images/favicon.ico" />

  <link rel="StyleSheet" href="../estilosMapa.css">
  <link rel="StyleSheet" href="../estilosTablas.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>


  <title>Home</title>
  </head>
      <body>

      <form action="" method="POST">
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarToggler">
        <a class="navbar-brand" href="#">HOME</a>
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item dropdown">
      
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Empleados
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="Empleado.php">Empleado</a>
            <a class="dropdown-item" href="ConsultarEmpleado.php">Consultar Empleado</a>
            <a class="dropdown-item" href="TablaEmpleado.php">Listar Empleado</a>
            
          </li>
              <li class="nav-item dropdown">
      
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Clientes
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="Cliente.php">Cliente</a>
              <a class="dropdown-item" href="ConsultarCliente.php">Consultar Cliente</a>
              <a class="dropdown-item" href="TablaCliente.php">Listar Clientes</a>
          
            </li>
              <li class="nav-item dropdown">
      
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Producto
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="Producto.php">Producto</a>
              <a class="dropdown-item" href="ConsultarProducto.php">Consultar Producto</a>
              <a class="dropdown-item" href="TablaProducto.php">Listar Productos</a>

          
            </li>

            <li class="nav-item dropdown">
      
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Proveedor
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="Proveedor.php">Proveedor</a>
              <a class="dropdown-item" href="ConsultarProveedor.php">Consultar Proveedor</a>
              <a class="dropdown-item" href="TablaProveedor.php">Listar Proveedores</a>

          
            </li>

              <li class="nav-item dropdown">
      
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Usuarios
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
        <a class="dropdown-item" href="Usuario.php">Usuario</a>
              <a class="dropdown-item" href="ConsultarUsuario.php">Consultar Usuario</a>
              <a class="dropdown-item" href="TablaUsuario.php">Listar Usuarios</a>
              <a class="dropdown-item" href="TablaNotificacion.php">Solicitudes de Actualizacion</a>

          
            </li>
            </ul>
        <form class="form-inline my-2 my-lg-0">
          <a class="btn btn-outline-success my-2 my-sm-0" href="CerrarSesion.php" style="color:white">Cerrar Sesion
          </a>
        </form>
      </div>
    </nav>

    </form>
    <br><br><br>
  
<div class = "container-fluid">
    <div id="mapid" class ="mapa" style="width: 800px; height: 400px;"></div>
    <div class="row">
    <div class="col-6 align-self-center">
       <div class="card card-block">

    <script >
    var mymap = L.map('mapid').setView([6.242341,-75.5915513,17], 13);
    
      L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        maxZoom: 18,
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
          '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
          'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1
      }).addTo(mymap);

   <?php for($i=0; $i<count($datos); $i++){?>

          <?php $latitud = $datos[$i][11]; ?>
          <?php $longitud = $datos[$i][12];?>

        L.circle([<?= $latitud ?> , <?= $longitud ?>], 100, {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.5
      }).addTo(mymap).bindPopup('PROVEEDOR: <?= $datos[$i][1] ?>');

   <?php }?>

    
   <?php for($i=0; $i<count($datosEmpleado); $i++){?>

<?php $latitud = $datosEmpleado[$i][14]; ?>
<?php $longitud = $datosEmpleado[$i][15];?>

L.circle([<?= $latitud ?> , <?= $longitud ?>], 100, {
color: 'blue',
fillColor: '#0033ff',
fillOpacity: 0.5
}).addTo(mymap).bindPopup('EMPLEADO:<?= $datosEmpleado[$i][0]?>');

<?php }?>

<?php for($i=0; $i<count($datosCliente); $i++){?>

<?php $latitud = $datosCliente[$i][12]; ?>
<?php $longitud = $datosCliente[$i][13];?>

L.circle([<?= $latitud ?> , <?= $longitud ?>], 100, {
color: 'green',
fillColor: '#33ff00',
fillOpacity: 0.5
}).addTo(mymap).bindPopup('CLIENTE :  <?= $datosCliente[$i][1]?>');

<?php }?>
    
    
      function onMapClick(e) {
        popup
          .setLatLng(e.latlng)
          .setContent("You clicked the map at " + e.latlng.toString())
          .openOn(mymap);
      }
    
      mymap.on('click', onMapClick);
    </script>
      </div>
    </div>
  
 </div>
 </div>
      </body>
      <footer class="foot">
    <div class="foot">
    <li class="list-inline-item">
      <h4> Proyecto Aula dirigido por : <br>
      Carlos Castro </h4>
      <h4> Instituto Tecnologico Metropolitano </h4>
    </li>
    <li class="list-inline-item">
      <h4 > Desarrollo <br>
        @Astrid Chavarria Serna<br> 
        @Kevin Orrego Castañeda</h4>
    </li>
    <li class="list-inline-item">
      <h4 > Redes Sociales <br>
        Github:astriCh1234 <br>
        Github:Kibadachy</h4>
    </li>
    </div>
    </footer>
  </html>
