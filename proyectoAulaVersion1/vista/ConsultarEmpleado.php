  <?php 
        error_reporting(E_ALL ^ E_NOTICE);
        session_start();

        if(!isset($_SESSION['usuario']) && !isset($_SESSION['clave']))
        ('Location:InicioSesion.php');

        include("../controlador/configBd.php");
        include("../modelo/Empleado.php");
        include("../controlador/ControlEmpleado.php");
        include("../controlador/ControlConexion.php");

      
        $button =$_POST['Consultar']; 
        $statusConsultarFallido="display:none";
        $statusConsultarExito="display:none";
        $statusDocumento="display:none";
     
      if(isset($button)){
        $documento=$_POST['txtDocumento']; 
        $objEmpleado= new Empleado($documento,"","","","","","","","","","","");
        $objControlEmpleado= new ControlEmpleado($objEmpleado);
        $objEmpleado=$objControlEmpleado->consultar();

        if(!empty($objEmpleado->getNombre())){
          $_SESSION["empleado"] = serialize($objEmpleado);
          $statusConsultarExito="display:block";
          header('Location:Empleado.php');
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
            <title>Empleado</title>

            <script type=\"text/javascript\">

function validar(){

  var documento =document.getElementById(\"txtDocumento\").value;
   
  if(isNaN(documento)){
    alert('Numero de Documento Invalido');
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
        <a class=\"navbar-brand\" href=\"#\">Administracion de Empleados</a>
        <ul class=\"navbar-nav mr-auto mt-2 mt-lg-0\">
        <li class=\"nav-item dropdown\">
      
            <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdownMenuLink\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
            Empleados
            </a>
            <div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdownMenuLink\">
            <a class=\"dropdown-item\" href=\"Empleado.php\">Empleado</a>
            <a class=\"dropdown-item\" href=\"ConsultarEmpleado.php\">Consultar Empleado</a>
            
          </li>
              <li class=\"nav-item dropdown\">
      
              <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdownMenuLink\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
              Clientes
              </a>
              <div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdownMenuLink\">
              <a class=\"dropdown-item\" href=\"Cliente.php\">Cliente</a>
              <a class=\"dropdown-item\" href=\"ConsultarCliente.php\">Consultar Cliente</a>
          
            </li>
              <li class=\"nav-item dropdown\">
      
              <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdownMenuLink\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
              Producto
              </a>
              <div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdownMenuLink\">
              <a class=\"dropdown-item\" href=\"Producto.php\">Producto</a>
              <a class=\"dropdown-item\" href=\"ConsultarProducto.php\">Consultar Producto</a>
            </li>
            <li class=\"nav-item dropdown\">
    
            <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdownMenuLink\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
            Proveedor
            </a>
            <div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdownMenuLink\">
            <a class=\"dropdown-item\" href=\"Proveedor.php\">Proveedor</a>
            <a class=\"dropdown-item\" href=\"ConsultarProveedor.php\">Consultar Proveedor</a>
          </li>
      
              <li class=\"nav-item dropdown\">
      
              <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdownMenuLink\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
              Usuarios
              </a>
              <div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdownMenuLink\">
        <a class=\"dropdown-item\" href=\"Usuarios.php\">Producto</a>
              <a class=\"dropdown-item\" href=\"ConsultarUsuario.php\">Consultar Producto</a>

          
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
          <th scope=\"col\">Consultar Empleado Perteniciente a XXXXX</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          
          <td><input type=\"text\" class=\"form-control\" id=\"txtDocumento\" name=\"txtDocumento\" placeholder=\"Identidad de Empleado\">
          <br></td>
          <td> <button type=\"submit\" class=\"btn btn-primary\" value=\"Consultar\"  name=\"Consultar\">Consultar Empleado</button> <td>
        </tr>

        <tr>
        <td>  <div class=\"alert alert-warning\" role=\"alert\" id=\"txtConsultar\" style=\"$statusConsultarFallido\">
        <strong>Oh!</strong> El empleado no se encuentra en la base de datos de xxxxx.
      </div>
        <br></td>
        <td>  <div class=\"alert alert-warning\" role=\"alert\" id=\"txtConsultar\" style=\"$statusConsultarExito\">
        <strong>Oh!</strong> El empleado ha sido encontrado con exito en la base de datos de xxxxx.
      </div>
        <br></td>
        <td>  <div class=\"alert alert-warning\" role=\"alert\" id=\"txtConsultar\" style=\"$statusDocumento\">
        <strong>Oh!</strong> El numero de identidad es invalido.
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