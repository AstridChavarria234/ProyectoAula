  <?php 
        error_reporting(E_ALL ^ E_NOTICE);
        session_start();

        if(!isset($_SESSION['usuario']) && !isset($_SESSION['clave']))
        ('Location:Index.php');

        include("../controlador/configBd.php");
        include("../modelo/Usuario.php");
        include("../controlador/ControlUsuario.php");
        include("../controlador/ControlConexion.php");

      
        $button =$_POST['Consultar']; 
        $statusConsultarFallido="display:none";
        $statusConsultarExito="display:none";
        $statusDocumento="display:none";
     
      if(isset($button)){
        $usu=$_POST['txtUsuario']; 
        $objUsuario= new Usuario("",$usu,"","");
        $objControlUsuario= new ControlUsuario($objUsuario);
        $objUsuario=$objControlUsuario->consultar();
        if(!empty($objUsuario->getUsuario())){
          $_SESSION["usuario"] = serialize($objUsuario);
          $statusConsultarExito="display:block";
          header('Location:Usuario.php');
        }else
          $statusConsultarFallido="display:block";      
      }

          

          
            echo"
            <!DOCTYPE html>
            <html>
            <head>
            <meta charset='UTF-8'>
      
            <link rel=\"StyleSheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css\" type=\"text/css\">
            <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js\"></script>
            <script src=\"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js\"></script>
            <script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js\"></script>
            <title>Usuario</title>

            <script type=\"text/javascript\">
/*
function validar(){

  var usuario =document.getElementById(\"txtUsuario\").value;
   
  if(isNaN(usuario)){
    alert('usuario Invalido');
    return false;
   }else{
     return true; 
   }

}*/
</script>
          
            </head>
                <body>
            
                <form action=\"\" method=\"POST\">
      <nav class=\"navbar navbar-expand-lg navbar-dark bg-dark\">
      <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarTogglerDemo01\" aria-controls=\"navbarTogglerDemo01\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
        <span class=\"navbar-toggler-icon\"></span>
      </button>
      <div class=\"collapse navbar-collapse\" id=\"navbarToggler\">
        <a class=\"navbar-brand\" href=\"#\">Administracion de Usuarios</a>
        <ul class=\"navbar-nav mr-auto mt-2 mt-lg-0\">
            <li class=\"nav-item dropdown\">
      
            <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdownMenuLink\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
            Empleados
            </a>
            <div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdownMenuLink\">
            <a class=\"dropdown-item\" href=\"Empleado.php\">Empleado</a>
            <a class=\"dropdown-item\" href=\"ConsultarEmpleado.php\">Consultar Empleado</a>
            <a class=\"dropdown-item\" href=\"TablaEmpleadophp\">Listar Empleado</a>
            
          </li>
              <li class=\"nav-item dropdown\">
      
              <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdownMenuLink\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
              Clientes
              </a>
              <div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdownMenuLink\">
              <a class=\"dropdown-item\" href=\"Cliente.php\">Cliente</a>
              <a class=\"dropdown-item\" href=\"ConsultarCliente.php\">Consultar Cliente</a>
              <a class=\"dropdown-item\" href=\"TablaCliente.php\">Listar Clientes</a>
          
            </li>
              <li class=\"nav-item dropdown\">
      
              <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdownMenuLink\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
              Producto
              </a>
              <div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdownMenuLink\">
              <a class=\"dropdown-item\" href=\"Producto.php\">Producto</a>
              <a class=\"dropdown-item\" href=\"ConsultarProducto.php\">Consultar Producto</a>
              <a class=\"dropdown-item\" href=\"TablaProducto.php\">Listar Productos</a>

          
            </li>

            <li class=\"nav-item dropdown\">
      
              <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdownMenuLink\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
              Proveedor
              </a>
              <div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdownMenuLink\">
              <a class=\"dropdown-item\" href=\"Proveedor.php\">Proveedor</a>
              <a class=\"dropdown-item\" href=\"ConsultarProveedor.php\">Consultar Proveedor</a>
              <a class=\"dropdown-item\" href=\"TablaProveedor.php\">Listar Proveedores</a>

          
            </li>
      
              <li class=\"nav-item dropdown\">
      
              <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdownMenuLink\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
              Usuarios
              </a>
              <div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdownMenuLink\">
        <a class=\"dropdown-item\" href=\"Usuario.php\">Usuario</a>
              <a class=\"dropdown-item\" href=\"ConsultarUsuario.php\">Consultar Usuario</a>
              <a class=\"dropdown-item\" href=\"TablaUsuario.php\">Listar Usuarios</a>

          
            </li>
            </ul>
        <form class=\"form-inline my-2 my-lg-0\">
          <a class=\"btn btn-outline-success my-2 my-sm-0\" href=\"CerrarSesion.php\" style=\"color:white\">Cerrar Sesion
          </a>
        </form>
      </div>
    </nav>
    </form>

    <form action=\"\" method=\"POST\" onsubmit=\"return validar()\">
    <div class=\"container\" id=\"mi_tabla\">
    <br><br><br>
    <table class=\"table table-hover table-success tableFixHead\" >
      <thead>
        <tr class=\"\">
          <th scope=\"col\">Consultar Usuario Perteniciente a xxxxxx</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          
          <td><input type=\"text\" class=\"form-control\" id=\"txtUsuario\" name=\"txtUsuario\" placeholder=\"Nombre de Usuario\">
          <br></td>
          <td> <button type=\"submit\" class=\"btn btn-primary\" value=\"Consultar\"  name=\"Consultar\">Consultar Usuario</button> <td>
        </tr>

        <tr>
        <td>  <div class=\"alert alert-warning\" role=\"alert\" id=\"txtConsultar\" style=\"$statusConsultarFallido\">
        <strong>Oh!</strong> El Usuario no se encuentra en la base de datos de la compañia.
      </div>
        <br></td>
        <td>  <div class=\"alert alert-warning\" role=\"alert\" id=\"txtConsultar\" style=\"$statusConsultarExito\">
        <strong>Oh!</strong> El Usuario ha sido encontrado con exito en la base de datos de la compañia.
      </div>
        <br></td>
        <td>  <div class=\"alert alert-warning\" role=\"alert\" id=\"txtConsultar\" style=\"$statusDocumento\">
        <strong>Oh!</strong> El codigo de Usuario es invalido.
      </div>
        <br></td>
        <tr>
      
      </tbody>
    </table>
  </div>
    </form>
          
                </body>
            </html>
            ";
      
        ?>