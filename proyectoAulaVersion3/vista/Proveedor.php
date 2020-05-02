<?php 
            error_reporting(E_ALL ^ E_NOTICE);
            session_start();

if(!isset($_SESSION['usuario']) && !isset($_SESSION['clave']))
header('Location:InicioSesion.php');

            include("../controlador/configBd.php");
            include("../modelo/Proveedor.php");
            include("../controlador/ControlProveedor.php");
            include("../controlador/ControlConexion.php");


            $cod=$_POST['txtCodigo']; 
            $nom=$_POST['txtNombre']; 
            $fInac=$_POST['txtInactividad'];
            $fRegistro = date("y-m-d");
            $urlFoto;
            $email=$_POST['txtEmail'];
            $telefono=$_POST['txtTelefono'];
            $button=$_POST['button'];
            $statusActualizar="display:none";
            $statusProveedor="display:none";
            $statusInactivar="display:none";
            $statusRegistrar="display:block";
            $statusImgFoto="display:block";

if(!empty($_FILES['archivo']['name']))
{
      $urlFoto= "../archivos/".$_FILES['archivo']['name'];
      if (file_exists($urlFoto)) {
      $statusArchivoFoto="display:block";
  }else{
       $ruta_temporal = $_FILES['archivo']['tmp_name'];
        move_uploaded_file($ruta_temporal, $urlFoto);

         }

}

        switch($button){

              case "registrar":
               
                $_SESSION['codigo']=$cod;
               
                $objProveedor= new Proveedor($codigo,$nombre,$tipo,$fRegistro,$fInac,$urlFoto,$email,$telefono);
                $objControlProveedor= new ControlProveedor($objProveedor);
                $objProveedor=$objControlProveedor->consultar();

                if(empty($objProveedor->getNombre())){
                    /*$objProveedor= new Proveedor($codigo,$nombre,$tipo,$fRegistro,$fInac,$urlFoto,$email,$telefono);
                    $objControlProveedor= new ControlProveedor($objProveedor);
                    $objControlProveedor->guardar();
                    */
                    header('Location:Producto.php');
                }else{
                   $statusProveedor = "display:block";
                }

            break;


            case "actualizar": {

                
            }
            }

            

           
            function actualizarValor(){
                unset($_SESSION["Producto"]);
                header('Refresh:4; URL=Prueba.php');
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

                function validarCampos(){
                
                        var documento =document.getElementById(\"documento\").value;
                        var nombre =document.getElementById(\"nombre\").value;
                        var deduccion =document.getElementById(\"deduccion\").value;
                        var salario =document.getElementById(\"salario\").value;
                        var fijo =document.getElementById(\"fijo\").value;
                        var cel =document.getElementById(\"cel\").value;
                        var retiro =document.getElementById(\"retiro\").value;
                        var ingreso =document.getElementById(\"ingreso\").value;
                        var arrayRetiro=retiro.split(\"-\"); 
                        var arrayIngreso=ingreso.split(\"-\"); 

                

                        if(isNaN(documento)){
                          alert('Formato Invalido');
                          return false;
                         }
      
                     
                         if(!isNaN(nombre)){
                          alert('Formato de Nombre Invalido');
                          return false;
                         }
 
                         if(isNaN(deduccion)){
                          alert('Formato de Deduccion Invalida');
                          return false;
                         }

                         if(isNaN(salario)){
                          alert('Formato de Salario Invalido');
                          return false;
                         }
      
                         if(isNaN(fijo)){
                          alert('Formato de Telefono Fijo Invalido');
                          return false;
                         }
      
                        
                         if(isNaN(cel)){
                          alert('Formato de Telefono Movil Invalido');
                          return false;
                         }

                         if((arrayRetiro[0]<arrayIngreso[0]) || (arrayRetiro[2]<arrayIngreso[2])){
                          alert('Fecha de Retiro Invalida: Debe ser superior o igual a la Fecha de Ingreso');
                          return false;
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
            <a class=\"navbar-brand\" href=\"#\">Administracion de Proveedores</a>
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


            </li>
            <li class=\"nav-item dropdown\">
    
            <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdownMenuLink\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
            Proveedor
            </a>
            <div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdownMenuLink\">
            <a class=\"dropdown-item\" href=\"Proveedor.php\">Proveedor</a>
            <a class=\"dropdown-item\" href=\"\">Consultar Proveedor</a>

        
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
                    <div class=\"container\">
                    <div class=\"row\">
                    <div class=\"col-sm-12\">
              <form method=\"POST\" enctype=\"multipart/form-data\" onsubmit=\"\"> <br><br>


              <div class=\"alert alert-warning\" role=\"alert\"  id=\"txtProveedor\" style=\"$statusProveedor\">
              <strong>Ups!</strong>Ya existe un proveedor con el codigo ingresado anteriormente
              </div>

              <?php>
              <div class=\"alert alert-warning\" role=\"alert\"  id=\"txtArchivo\" style=\"$statusArchivoFoto\">
              <strong>Ups!</strong>Intente subir un archivo diferente.El archivo $urlFoto ya existe
              </div>
              <?>
   
               <img src=\"$urlFoto\" height=\"80\" width=\"100\" style =\"$statusImgFoto\">
               
               <div class=\"form-group\" id=\"imagenProducto\">
                <label for=\"imagenProducto\">Imagen</label>
                <input type=\"file\" class=\"form-control-file\" name=\"archivo\"  style =\"$statusFoto\">
                <br>
                </div>
               
        
                <div class=\"form-group\">
                <label for=\"codigo\">Codigo</label>
                <input type=\"text\" class=\"form-control\"value=\"$CODIGO\"  id=\"codigo\" name=\"txtCodigo\" placeholder=\"Documento de identidad\" $statusLectura>
                </div>
          
                <div class=\"form-group\">
                <label for=\"fRetiro\">Nombre</label>
                <input type=\"text\" class=\"form-control\" value=\"$NOMBRE\" id=\"nombre\" name=\"txtNombre\" placeholder=\"Nombre\" required>
                </div>
          
        
                <div class=\"form-group\">
                <label for=\"fRetiro\">Fecha de Inactivo</label>
              <input type=\"date\" class=\"form-control\"value=\"$INACTIVO\" id=\"inactivo\" name=\"txtInactividad\" placeholder=\"Fecha de Inactividad\">
                </div>
              
                <div class=\"form-group\">
                <label for=\"email\">Correo Electronico </label>
                <input type=\"email\" class=\"form-control\"value=\"$EMAIL\" name=\"txtEmail\" aria-describedby=\"emailHelp\" placeholder=\"Correo Electronico Personal\">
                <small id=\"emailHelp\" class=\"form-text text-muted\">We'll never share your email with anyone else.</small>
                </div>
          
                <div class=\"form-group\">
                <label for=\"telefonoFijo\">Telefono Fijo</label>
                <input type=\"text\" class=\"form-control\" value=\"$TELEFONO\" id=\"telefono\" name=\"txtTelefono\" placeholder=\"Telefono\">
                </div>
          
        
                <tbody>
                  <tr>
                  <td><button type=\"submit\" class=\"btn btn-primary\" value=\"registrar\" id=\"registrar\" name=\"button\"style=\"$statusRegistrar\" >Registrar Proveedor</button>
                  <br></td>
                  <td>  <button type=\"submit\" class=\"btn btn-primary\" value=\"actualizar\" id=\"actualizar\"  name=\"button\" style=\"$statusActualizar\">Actualizar Proveedor</button>
                  <br> <td>
                  <button type=\"submit\" class=\"btn btn-primary\" value=\"inactivar\"  id=\"inactivar\"  name=\"button\" style=\"$statusInactivar\">Inactivar Proveedor</button>
                  <br> <td>
                  </tr> 
                </tbody>
                 </table>
          
                </form>
          
                </div>
                </div>
                </div>
                </body>
                </html>
                ";
          
            ?>