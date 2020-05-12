  <?php 
        error_reporting(E_ALL ^ E_NOTICE);
        session_start();

        if(!isset($_SESSION['usuario']) && !isset($_SESSION['clave']))
        ('Location:Index.php');

        include("../controlador/configBd.php");
        include("../modelo/Producto.php");
        include("../controlador/ControlProducto.php");
        include("../controlador/ControlConexion.php");


        $button =$_POST['Consultar']; 
        $statusConsultarFallido="display:none";
        $statusConsultarExito="display:none";
        $statusCodigo="display:none";
     
      if(isset($button)){
        $codigo=$_POST['txtCodigo']; 
        $objProducto= new Producto($codigo,"","","");
        $objControlProducto= new ControlProducto($objProducto);
        $objProducto=$objControlProducto->consultar();

        if(!empty($objProducto->getNombre())){
          $_SESSION["producto"] = serialize($objProducto);
          $statusConsultarExito="display:block";
          header('Location:Producto.php');
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
            <title>Producto</title>

            <script type=\"text/javascript\">

function validar(){

  var codigo =document.getElementById(\"txtCodigo\").value;
   
  if(isNaN(codigo)){
    alert('Codigo Invalido');
    return false;
   }else{
     return true; 
   }

}
</script>
          
            </head>
                <body>
            
                <form action=\"\" method=\"POST\">
      <nav class=\"navbar navbar-expand-lg navbar-dark bg-dark\">
      <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarTogglerDemo01\" aria-controls=\"navbarTogglerDemo01\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
        <span class=\"navbar-toggler-icon\"></span>
      </button>
      <div class=\"collapse navbar-collapse\" id=\"navbarToggler\">
        <a class=\"navbar-brand\" href=\"#\">Administracion de Productos</a>
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
          <th scope=\"col\">Consultar Producto</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          
          <td><input type=\"text\" class=\"form-control\" id=\"txtCodigo\" name=\"txtCodigo\" placeholder=\"Codigo del Producto\">
          <br></td>
          <td> <button type=\"submit\" class=\"btn btn-primary\" value=\"Consultar\"  name=\"Consultar\">Consultar Producto</button> <td>
        </tr>

        <tr>
        <td>  <div class=\"alert alert-warning\" role=\"alert\" id=\"txtConsultar\" style=\"$statusConsultarFallido\">
        <strong>Oh!</strong> El producto no se encuentra en la base de datos de xxxxx.
      </div>
        <br></td>
        <td>  <div class=\"alert alert-warning\" role=\"alert\" id=\"txtConsultar\" style=\"$statusConsultarExito\">
        <strong>Oh!</strong> El producto ha sido encontrado con exito en la base de datos de xxxxx.
      </div>
        <br></td>
        <td>  <div class=\"alert alert-warning\" role=\"alert\" id=\"txtConsultar\" style=\"$statusCodigo\">
        <strong>Oh!</strong> El codigo es invalido.
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