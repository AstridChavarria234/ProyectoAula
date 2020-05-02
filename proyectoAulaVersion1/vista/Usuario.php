<?php

session_start();
if(!isset($_SESSION['usuario']) && !isset($_SESSION['clave']))
header('Location:Index.php');


echo"
<!DOCTYPE html>
<html>
<head>
<meta charset='UTF-8'>

<link rel=\"StyleSheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css\" type=\"text/css\">
<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js\"></script>
<script src=\"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js\"></script>
<script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js\"></script>
<title>Home</title>
</head>
    <body>

    <form action=\"\" method=\"POST\">
    <nav class=\"navbar navbar-expand-lg navbar-dark bg-dark\">
    <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarTogglerDemo01\" aria-controls=\"navbarTogglerDemo01\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
      <span class=\"navbar-toggler-icon\"></span>
    </button>
    <div class=\"collapse navbar-collapse\" id=\"navbarToggler\">
      <a class=\"navbar-brand\" href=\"#\">xxxxxxxxxxxx</a>
      <ul class=\"navbar-nav mr-auto mt-2 mt-lg-0\">
      <li class=\"nav-item dropdown\">

      <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdownMenuLink\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
       Empleados
      </a>
      <div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdownMenuLink\">
      <a class=\"dropdown-item\" href=\"Empleado.php\">Empleado</a>
      <a class=\"dropdown-item\" href=\"BuscarEmpleado.php\">Consultar Empleado</a>

   
    </li>
        <li class=\"nav-item dropdown\">

        <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdownMenuLink\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
        Clientes
        </a>
        <div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdownMenuLink\">
        <a class=\"dropdown-item\" href=\"#\">Crear Cliente</a>
        <a class=\"dropdown-item\" href=\"#\">Consultar Cliente</a>
        <a class=\"dropdown-item\" href=\"#\">Actualizar Cliente</a>
        <a class=\"dropdown-item\" href=\"#\">Inactivar Cliente</a>
     
      </li>
        <li class=\"nav-item dropdown\">

        <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdownMenuLink\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
         Producto
        </a>
        <div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdownMenuLink\">
        <a class=\"btn btn-link\" href=\"\">Crear Producto</a>
        <a class=\"btn btn-link\" href=\"#\">Consultar Producto</a>
        <a class=\"btn btn-link\" href=\"#\">Actualizar Producto</a>
        <a class=\"btn btn-link\" href=\"#\">Inactivar Producto</a>
     
      </li>

        <li class=\"nav-item dropdown\">

        <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdownMenuLink\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
         Usuarios
        </a>
        <div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdownMenuLink\">
        <a class=\"btn btn-link\" name=\"opcion\" value =\"crear\" href=\"Usuario.php\">Crear Usuario</a>
        <a class=\"btn btn-link\"name=\"opcion\"  value=\"consultar\"href=\"#\">Consultar Usuario</a>
        <a class=\"btn btn-link\" name=\"opcion\" value=\"actualizar\"href=\"#\">Actualizar Usuario</a>
        <a class=\"btn btn-link\"  name=\"opcion\" value=\"eliminar\" href=\"#\">Eliminar Usuario</a>
     
      </li>
      </ul>
      <form class=\"form-inline my-2 my-lg-0\">
        <a class=\"btn btn-outline-success my-2 my-sm-0\" href=\"CerrarSesion.php\" style=\"color:white\">Cerrar Sesion
        </a>
      </form>
    </div>
  </nav>

  </form>


    </body>
</html>
";




?>