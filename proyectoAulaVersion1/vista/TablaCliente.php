<?php

            include("../controlador/configBd.php");
            include("../controlador/ControlConexion.php");




echo "
<!DOCTYPE html>
                <html>
                <head>
                <meta charset='UTF-8'>
          
                <link rel=\"StyleSheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css\" type=\"text/css\">
                <link rel=\"StyleSheet\" href=\"estilosTablas.css\">
                <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js\"></script>
                <script src=\"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js\"></script>
                <script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js\"></script>
                <script src=\"jquery-3.0.0.min.js\"></script>

                <title>Cliente</title>
                </head>
                <body>
                    
          <form action=\"\" method=\"POST\">
          <nav class=\"navbar navbar-expand-lg navbar-dark bg-dark\">
          <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarTogglerDemo01\" aria-controls=\"navbarTogglerDemo01\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
            <span class=\"navbar-toggler-icon\"></span>
          </button>
          <div class=\"collapse navbar-collapse\" id=\"navbarToggler\">
            <a class=\"navbar-brand\" href=\"#\">Administración de Usuarios</a>
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
        $comandoSql="SELECT * FROM CLIENTE";
        $recordSet=$objConexion->ejecutarSelect($comandoSql);


        $objConexion->cerrarBd();


            echo"
        

            <table border='2px' align='center'>

                <tr>
                  <th>Codigo</th>
                  <th>Nombre</th>
                  <th>Tipo Persona</th>
                  <th>Fecha de Registro</th>
                  <th>Fecha de Inactividad</th>
                  <th>Imagen</th>
                  <th>Email</th>
                  <th>Telefono</th>
                  <th>Tope de credito</th>
                  <th>Inactividad</th>
                </tr>

            ";

            while ($registro = $recordSet->fetch_array(MYSQLI_BOTH)) {

              echo"
              <tr>

                <td>".$registro["codigo"]."</td>
                <td id='nombre' data-id_nombre='".$registro["codigo"]."'>".$registro["nombre"]."</td>
                <td id='tipo_persona' data-id_tipo_persona='".$registro["codigo"]."'>".$registro["tipo_persona"]."</td>
                <td id='fRegistro' data-id_fRegistro='".$registro["codigo"]."'>".$registro["fecha_registro"]."</td>
                <td id='fInactivo' data-id_fInactivo='".$registro["codigo"]."'>".$registro["fecha_inactivo"]."</td>
                <td id='urlImagen' data-id_urlImagen='".$registro["codigo"]."'>".$registro["url_imagen"]."</td>
                <td id='email' data-id_email='".$registro["codigo"]."'>".$registro["email"]."</td>
                <td id='telefono' data-id_telefono='".$registro["codigo"]."'>".$registro["telefono"]."</td>
                <td id='tCred' data-id_tCred='".$registro["codigo"]."'>".$registro["tope_credito"]."</td>
                <td id='inactividad' data-id_inactividad='".$registro["codigo"]."'>".$registro["inactivo"]."</td>
                

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