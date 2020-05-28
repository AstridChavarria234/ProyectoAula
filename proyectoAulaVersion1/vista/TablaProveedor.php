<?php

          error_reporting(0);

            include("../controlador/configBd.php");
            include("../controlador/ControlConexion.php");
            include("../modelo/Proveedor.php");
            include("../controlador/ControlProveedor.php");

echo "
<!DOCTYPE html>
                <html>
                <head>
                <meta charset='UTF-8'>
          
                <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css\">
                <link rel=\"StyleSheet\" href=\"../estilosTablas.css\">

                <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js\"></script>
                <script src=\"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js\"></script>
                <script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js\"></script>
                <script src=\"jquery-3.0.0.min.js\"></script>

                <title>Proveedor</title>

                </head>
                <body>
                    
          <form action=\"\" method=\"POST\">
          <nav class=\"navbar navbar-expand-lg navbar-dark bg-dark\">
          <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarTogglerDemo01\" aria-controls=\"navbarTogglerDemo01\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
            <span class=\"navbar-toggler-icon\"></span>
          </button>
          <div class=\"collapse navbar-collapse\" id=\"navbarToggler\">
            <a class=\"navbar-brand\" href=\"#\">Administración de Proveedores</a>
            <ul class=\"navbar-nav mr-auto mt-2 mt-lg-0\">
            <li class=\"nav-item dropdown\">
      
            <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdownMenuLink\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
            Empleados
            </a>
            <div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdownMenuLink\">
            <a class=\"dropdown-item\" href=\"Empleado.php\">Empleado</a>
            <a class=\"dropdown-item\" href=\"ConsultarEmpleado.php\">Consultar Empleado</a>
            <a class=\"dropdown-item\" href=\"TablaEmpleado.php\">Listar Empleado</a>
            
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

        try{

          ////------- OBTENER EL NUMERO DE FILAS-------////

      $objProveedor= new Proveedor("","","","","","","","","","","");
      $objControlProveedor= new ControlProveedor($objProveedor);
      $objProveedor=$objControlProveedor->consultarAll();
      $datos= (array)$objProveedor;
      $num_filas = count($datos);
      
       

       $tam_paginas=5;

       $total_paginas= ceil($num_filas/$tam_paginas);

       if (isset($_GET["pagina"])) {
       

            if($_GET["pagina"]==1){
                 
                 header('location:TablaProveedor.php');


                 $pagina=1;
                 $ant=1;
                 if($total_paginas==1){
                  $sig=1;
                 }else{
                 $sig=$pagina+1;}

            }else{

              $pagina=$_GET["pagina"];
              $ant=$pagina-1;
              if($pagina>=$total_paginas)
                {

                    $sig=$total_paginas;
                }else{
              $sig=$pagina+1;
            }

            }

        }else{

          $pagina=1;
          $ant=1;
          if($total_paginas==1){
                  $sig=1;
                 }else{
                 $sig=$pagina+1;}

        }



        $empezar_desde=($pagina-1)*$tam_paginas;

   
        
        ////------- OBTENER EL NUMERO DE FILAS-------////



        //////-------GENERAR LOS LIMITES Y LA CONSULTA QUE TRAE LOS REGISTROS-------/////


        
     //   print("numero de filas ".$num_filas. "<br>");
     //   print("numero de paginas " .$total_paginas."<br>");
     //  print("mostrando la pagina ".$pagina." de ".$total_paginas. "<br>");


        $objProveedor= new Proveedor("","","","","","","","","","","");
        $objControlProveedor= new ControlProveedor($objProveedor);
        $objProveedor=$objControlProveedor->cantidad($empezar_desde,$tam_paginas);
        $datos= (array)$objProveedor;
        $longitud = count($datos);


        ////------COMIENZA LA TABLA---------////


       echo"
        <br><br>
                 <table class='table table-hover'>

                  <tr>
                  <th>Codigo</th>
                  <th>Nombre del Proveedor</th>
                  <th>Persona</th>
                  <th>Fecha de Registro</th>
                  <th>Fecha de Inactivacion</th>
                  <th>Imagen</th>
                  <th>Email</th>
                  <th>Telefono</th>
                  <th>Comuna</th>
                  <th>Barrio</th>

                </tr>

            ";

    /* ////----SE MUESTRAN Y ASIGNAN LOS REGISTROS A LAS LINEAS EN LA TABLA

               DEBE HACERSE CON UN FOR CONTROLADO POR LA CANTIDAD DE REGISTROS 

               O AL PARECER NO LOS RECONOCE-------/////// */



        for ($i=0;$i<$longitud; $i++) {

          echo"
              <tr>

                <td>".$datos[$i]["codigo"]."</td>
                <td>".$datos[$i]["nombre"]."</td>
                <td>".$datos[$i]["tipo"]."</td>
                <td>".$datos[$i]["fechaRegistro"]."</td>
                <td>".$datos[$i]["fechaInactivo"]."</td>
                <td><img src=".$datos[$i]['urlImagen']." height='80' width='100'></td>
                <td>".$datos[$i]["email"]."</td>
                <td>".$datos[$i]["telefono"]."</td>
                <td>".$datos[$i]["comuna"]."</td>
                <td>".$datos[$i]["barrio"]."</td>
                
                

              </tr>



        
              ";
          
        }

        echo"</table>";


        }catch(Exception $e){

            echo "linea de error: " .$e->getLine();

        }


        ////---------------PAGINACION-------------////


   echo"      
    <nav aria-label='Page navigation example'>
    <ul class='pagination list'>

    <li class='page-item'><a class='page-link key' href='TablaProveedor.php?pagina=".$ant."'>Anterior</a></li>"; 
      for($i=1; $i<=$total_paginas; $i++){

        if($pagina==$i){
        echo"
          <li class='page-item active ' ><a class='page-link key' href='#'>".$pagina."</a></li>";
        }
        else{
          echo"
          <li  class='page-item'><a class='page-link key' href='TablaProveedor.php?pagina=".$i."'>".$i."</a></li>";
        }
      }
       echo"
    
        <li class='page-item'><a class='page-link key' href='TablaProveedor.php?pagina=".$sig."'>Siguiente</a></li>
    </ul>
    </nav>
    ";


        echo"
                    
                </div>
                </div>
                </div>
                </body>
                </html>
                ";



?>