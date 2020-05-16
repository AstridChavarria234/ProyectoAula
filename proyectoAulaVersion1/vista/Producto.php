  <?php 
              error_reporting(E_ALL ^ E_NOTICE);
              session_start();

              if(!isset($_SESSION['usuario']) && !isset($_SESSION['clave']))
              header('Location:Index.php');

              include("../controlador/configBd.php");
              include("../modelo/Producto.php");
              include("../controlador/ControlProducto.php");
              include("../modelo/Proveedor.php");
              include("../controlador/ControlProveedor.php");
              include("../controlador/ControlConexion.php");
              include("../modelo/Relacion.php");
              include("../controlador/ControlRelacion.php");
              include("../modelo/Usuario.php");
              include("../controlador/ControlUsuario.php");
              
              
          

              $cod=$_POST['txtCodigo']; 
              $nom=$_POST['txtNombre'];  
              $VALOR = "000 Default"; 
              $proveedor=$_POST["proveedor"];     
              $statusActualizar="display:none";
              $statusInactivar="display:none";
              $statusRegistrar="display:block";
              $statusActualizarM="display:none"; 
              $statusInactivarM="display:block"; 
              $statusRegistrarM="display:none"; 
              $statusInactivarM="display:none";
              $statusExistencia="display:none";
              $statusActivado="display:none";
              $statusConfInactivar="display:none";
              $statusArchivoImg="display:none";
              $statusImg="display:none";
              $urlImg;
              $objetoSesion = $_SESSION["producto"];
              $objetoSesion = unserialize($objetoSesion); 
              $button=$_POST['button'];
  
            
              if(!empty($objetoSesion)){

             
                $objRelacion= new Relacion("","");
                $objControlRelacion= new ControlRelacion($objRelacion);
                $dato=$objControlRelacion->consultar($objetoSesion->getCodigo());
            

                $CODIGO=$objetoSesion->getCodigo();
                $NOMBRE=$objetoSesion->getNombre();
                $VALOR= $dato;
                $urlImg=$objetoSesion->getUrlImagen();
                $statusImg="display:block";
                $statusActualizar="display:block";
                $statusInactivar="display:block";
                $statusRegistrar="display:none";
                $statusLectura="readonly='true'";
              }

                if(!empty($_FILES['archivo']['name']))
                {
                
                      
                      $urlImg= "../archivos/".$_FILES['archivo']['name'];
                      if (file_exists($urlImg)) {
                      $statusArchivoImg ="display:block";

                  }else{

                        $ruta_temporal = $_FILES['archivo']['tmp_name'];
                        move_uploaded_file($ruta_temporal, $urlImg);

                        }

              }

              switch($button){

                case "registrar":


                $objProducto= new Producto($cod,"","","");
                $objControlProducto= new ControlProducto($objProducto);
                $objProducto=$objControlProducto->consultar();

                if(empty($objProducto->getCodigo())){

                  $objProducto= new Producto($cod,$nom,$urlImg,0);
                  $objControlProducto= new ControlProducto($objProducto);
                  $objControlProducto->guardar();

                  $objRelacion= new Relacion($proveedor,$cod);
                  $objControlRelacion= new ControlRelacion($objRelacion);
                  $objControlRelacion->guardar();
                  $statusRegistrarM="display:block";
                  actualizarValor();
                }else
                $statusExistencia="display:block";
              
                
              break; 


          
              break; 
                case "actualizar":  
                
                  $objProducto= new Producto($cod,"","","");
                  $objControlProducto= new ControlProducto($objProducto);
                  $objProducto=$objControlProducto->consultar();
                  if($objProducto->getDeshabilitado()==1){
                    $statusConfInactivar="display:block";
                  }else{
                    $objProducto= new Producto($cod,$nom,$urlImg,0);
                    $objControlProducto= new ControlProducto($objProducto);
                    $objControlProducto->modificar();
                    $statusActualizarM="display:block";
                    actualizarValor();
                  }
                  
            
                break; 
              
                
                case "inactivar":

                  $objProducto= new Producto($cod,"","","");
                  $objControlProducto= new ControlProducto($objProducto);
                  $objProducto=$objControlProducto->consultar();
                  if($objProducto->getDeshabilitado()==1){
                    $statusConfInactivar="display:block";
                  }else{
                    $objControlProducto= new ControlProducto($objProducto);
                    $objControlProducto->inactivar();
                    $statusInactivarM="display:block";
                    actualizarValor();
                  }

                
                
                break; 

              }


              function actualizarValor(){
                unset($_SESSION["Producto"]);
                header('Refresh:4; URL=HomeAula.php');
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

                  function validarCampos(){
                  
                    
                          
                        
                    
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
              <a class=\"navbar-brand\" href=\"#\">Administración de Productos</a>
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
        
          </form>
                      <div class=\"container\">
                      <div class=\"row\">
                      <div class=\"col-sm-12\">
                <form method=\"POST\" enctype=\"multipart/form-data\" onsubmit=\"return validarCampos();\"> <br><br>

        <div class=\"alert alert-success\" role=\"alert\" id=\"txtActualizado\" style=\"$statusActualizarM\">
        <strong>Bien Hecho!</strong> El Productos ha sido actualizado con exito.
        </div>
        <div class=\"alert alert-success\" role=\"alert\"  id=\"txtInactivado\" style=\"$statusRegistrarM\">
        <strong>Bien Hecho!</strong> El Producto ha sido registrado con exito.
        </div>
        <div class=\"alert alert-success\" role=\"alert\"  id=\"txtInactivado\" style=\"$statusInactivarM\">
        <strong>Bien Hecho!</strong> El Producto ha sido deshabilitado con exito.
        </div>
        <div class=\"alert alert-warning\" role=\"alert\"  id=\"txtInactivado\" style=\"$statusConfInactivar\">
        <strong>Ups!</strong> El Producto se encuentra en estado inactivado.
        </div>
        <div class=\"alert alert-warning\" role=\"alert\"  id=\"txtInactivado\" style=\"$statusExistencia\">
        <strong>Ups!</strong> El Producto con numero de identificacion $doc ya existe en la base de datos xxxxx
        </div>

        <div class=\"alert alert-warning\" role=\"alert\"  id=\"txtInactivado\" style=\"$statusActivado\">
        <strong>Ups!</strong> Al actualizar el Producto esta activando su acceso en caso que este inactivado
        </div>
        <?php>
        <div class=\"alert alert-warning\" role=\"alert\"  id=\"txtArchivo\" style=\"$statusArchivoImg\">
        <strong>Ups!</strong>Intente subir un archivo diferente.El archivo $urlImg ya existe
        </div>

        <?>
              
                  
                  <img src=\"$urlImg\" height=\"150\" width=\"120\" style =\"$statusImg\"> 

                  <div class=\"form-group\" id=\"Imagen\">
                  <label for=\"Imagen\">Imagen del producto</label>
                  <input type=\"file\" class=\"form-control-file\" name=\"archivo\" style =\"$statusImagen\">
                  <br>
                  </div>
            
                  <div class=\"form-group\">
                  <label for=\"codigo\">Codigo</label>
                  <input type=\"text\" class=\"form-control\"value=\"$CODIGO\"  id=\"codigo\" name=\"txtCodigo\" placeholder=\"Codigo de Productos\" $statusLectura>
                  </div>
            
                  <div class=\"form-group\">
                  <label for=\"nombre\">Nombre</label>
                  <input type=\"text\" class=\"form-control\" value=\"$NOMBRE\" id=\"nombre\" name=\"txtNombre\" placeholder=\"Nombre de Producto\">
                  </div>

                  <div class=\"form-group\">
                  <label for=\"nombre\">Proveedor del Producto</label>
                  <br>

                  <select class=\"custom-select\"  name=\"proveedor\">
                  <option disabled selected>$VALOR</option>
              
            "; 

            $objUsuario = new Usuario ("", "", "", "", 0);
            $objControlUsuario = new ControlUsuario($objUsuario); 
            $datosUsuario =$objControlUsuario->arrayUsuarioProveedor();
            
            $objProveedor= new Proveedor("","","","","","","","","");
            $objControlProveedor = new ControlProveedor($objProveedor);
            $datos=$objControlProveedor->arrayProveedor($datosUsuario);
         
             for($i=0;$i<count($datos);$i++)
              {
                echo '<option value='.$datos[$i][0].'>'.$datos[$i][1].'</option >';
              }
        
                echo "
                </select>
                </div>
                  <br>
                  <table class=\"table table-hover  tableFixHead\" >
          
                  <tbody>
                    <tr>
                    <td><button type=\"submit\" class=\"btn btn-primary\" value=\"registrar\" id=\"registrar\" name=\"button\"style=\"$statusRegistrar\" >Registrar </button>
                    <br></td>
                    <td>  <button type=\"submit\" class=\"btn btn-primary\" value=\"actualizar\" id=\"actualizar\"  name=\"button\" style=\"$statusActualizar\">Actualizar Producto</button>
                    <br> <td>
                    <button type=\"submit\" class=\"btn btn-primary\" value=\"inactivar\"  id=\"inactivar\"  name=\"button\" style=\"$statusInactivar\">Deshabilitar Producto</button>
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