  <?php 
          error_reporting(E_ALL ^ E_NOTICE);
          session_start();

          if(!isset($_SESSION['usuario']) && !isset($_SESSION['clave']))
          ('Location:InicioSesion.php');

          include("../controlador/configBd.php");
          include("../modelo/Proveedor.php");
          include("../controlador/ControlProveedor.php");
          include("../controlador/ControlConexion.php");

          $button =$_POST['Consultar']; 
          $statusConsultarFallido="display:none";
          $statusConsultarExito="display:none";
          $statusDocumento="display:none";
      
        if(isset($button)){
          $codigo=$_POST['txtCodigo']; 
          $objProveedor= new Proveedor($codigo,"","","","","","","","");
          $objControlProveedor= new ControlProveedor($objProveedor);
          $objProveedor1=$objControlProveedor->consultar();

          if($objProveedor!=null){
            $_SESSION["proveedor"] = serialize($objProveedor1);
            $statusConsultarExito="display:block";
            header('Location:Proveedor.php');
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
              <title>Proveedor</title>

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
          <a class=\"navbar-brand\" href=\"#\">Administracion de Proveedor</a>
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
          <a class=\"dropdown-item\" href=\"Usuario.php\">Usuario</a>
                <a class=\"dropdown-item\" href=\"ConsultarUsuario.php\">Consultar Usuario</a>

            
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
            <th scope=\"col\">Consultar Proveedor Perteniciente a XXXXX</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            
            <td><input type=\"text\" class=\"form-control\" id=\"txtCodigo\" name=\"txtCodigo\" placeholder=\"Codigo del Proveedor\">
            <br></td>
            <td> <button type=\"submit\" class=\"btn btn-primary\" value=\"Consultar\"  name=\"Consultar\">Consultar Proveedor</button> <td>
          </tr>

          <tr>
          <td>  <div class=\"alert alert-warning\" role=\"alert\" id=\"txtConsultar\" style=\"$statusConsultarFallido\">
          <strong>Oh!</strong> El proveedor no se encuentra en la base de datos de xxxxx.
        </div>
          <br></td>
          <td>  <div class=\"alert alert-warning\" role=\"alert\" id=\"txtConsultar\" style=\"$statusConsultarExito\">
          <strong>Oh!</strong> El proveedor ha sido encontrado con exito en la base de datos de xxxxx.
        </div>
          <br></td>
          <td>  <div class=\"alert alert-warning\" role=\"alert\" id=\"txtConsultar\" style=\"$statusDocumento\">
          <strong>Oh!</strong> El documento es invalido.
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