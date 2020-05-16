<?php
   error_reporting(E_ALL ^ E_NOTICE);
            include("../controlador/configBd.php");
            include("../controlador/ControlConexion.php");

echo "
<!DOCTYPE html>
                <html>
                <head>
                <meta charset='UTF-8'>
          
                <link rel=\"StyleSheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css\" type=\"text/css\">
                <link rel=\"StyleSheet\" href=\"../estilosTabla.css\">
                <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js\"></script>
                <script src=\"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js\"></script>
                <script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js\"></script>
                <script src=\"jquery-3.0.0.min.js\"></script>

                <title>Usuario</title>

                </head>
                <body>
                    
          <form action=\"\" method=\"POST\">
          <nav class=\"navbar navbar-expand-lg navbar-dark bg-dark\">
          <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarTogglerDemo01\" aria-controls=\"navbarTogglerDemo01\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
            <span class=\"navbar-toggler-icon\"></span>
          </button>
          <div class=\"collapse navbar-collapse\" id=\"navbarToggler\">
            <a class=\"navbar-brand\" href=\"#\">Administración de Empleados</a>
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

        ";

        $sv="localhost";
        $us="root";
        $ps="";
        $bd="bdproyectoaulav1";
        

        $objConexion = new ControlConexion();
        $objConexion->abrirBd($sv,$us,$ps,$bd);
        $comandoSql="SELECT * FROM EMPLEADO";
        $recordSet=$objConexion->ejecutarSelect($comandoSql);
        $objConexion->cerrarBd();


            echo"
<br><br>

<table class =\"table table-sm table-secondary\">
 

                <tr class=\"bg-success\">
                  <th>Nombre</th>
                  <th>Documento</th>
                  <th>Fecha Ingreso</th>
                  <th>Fecha Retiro</th>
                  <th>Salario Basico</th>
                  <th>Deduccion</th>
                  <th>Foto</th>
                  <th>Hoja de Vida</th>
                  <th>Email</th>
                  <th>Telefono</th>
                  <th>Celular</th>

                </tr>

            ";

            while ($registro = $recordSet->fetch_array(MYSQLI_BOTH)) {

                $urlFoto=$registro["foto"]; 
                $CV = $registro["hoja_vida"];
                
               
              echo"
              <tr>

                <td id='nombre' data-id_nombre='".$registro["id"]."'>".$registro["nombre"]."</td>
                <td id='documento' data-id_documento='".$registro["id"]."'>".$registro["documento"]."</td>
                <td id='fechaIngreso' data-id_ingreso='".$registro["id"]."'>".$registro["fecha_ingreso"]."</td>
                <td id='fechaRetiro' data-id_retiro='".$registro["id"]."'>".$registro["fecha_retiro"]."</td>
                <td id='salario' data-id_salario='".$registro["id"]."'>".$registro["salario_basico"]."</td>
                <td id='deduccion' data-id_deduccion='".$registro["id"]."'>".$registro["deduccion"]."</td>
                <td id='foto' data-id_foto='".$registro["id"]."'><img src=\"$urlFoto\" height=\"80\" width=\"100\"></td>
                <td id='CV' data-id_CV='".$registro["id"]."'><a href=\"$CV\" download=\"$CV\">Descargar</a></td>
                <td id='email' data-id_email='".$registro["id"]."'>".$registro["email"]."</td>
                <td id='telefono' data-id_telefono='".$registro["id"]."'>".$registro["telefono"]."</td>
                <td id='celular' data-id_celular='".$registro["id"]."'>".$registro["celular"]."</td>
                
              </tr>
              ";
           }

            echo"</table>";





        echo"
      
        </form>
                    
                <div id=\"container\">
                  <div id=\"result\"></div>
                </div>
          
                </div>
                </div>
                </div>
                </body>
                </html>
                ";



?>