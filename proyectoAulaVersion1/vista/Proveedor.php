          <?php 
                      error_reporting(E_ALL ^ E_NOTICE);
                      session_start();

          if(!isset($_SESSION['usuario']) && !isset($_SESSION['clave']))
          header('Location:Index.php');

                      include("../controlador/configBd.php");
                      include("../modelo/Proveedor.php");
                      include("../controlador/ControlProveedor.php");
                      include("../controlador/ControlConexion.php");
              


                      $cod=$_POST['txtCodigo']; 
                      $nom=$_POST['txtNombre']; 
                      $fInac=$_POST['txtInactividad'];
                      $fRegistro = date("d-m-y");
                      $urlFoto;
                      $email=$_POST['txtEmail'];
                      $telefono=$_POST['txtTelefono'];
                      $button=$_POST['button'];
                      $tipo = $_POST['txtTipo'];


                      $statusActualizar="display:none";
                      $statusInactivar="display:none";
                      $statusRegistrar="display:block";
                      $statusImgFoto="display:none";
                      $statusActualizarM="display:none"; 
                      $statusInactivarM="display:block"; 
                      $statusRegistrarM="display:none"; 
                      $statusInactivarM="display:none";
                      $statusExistencia="display:none";
                      $statusActivado="display:none";
                      $statusConfInactivar="display:none";
                      $statusArchivoFoto="display:none";
                      $statusRegistro="display:none";
                      $statusFoto ="display:block";
                      $objetoSesion = $_SESSION["proveedor"];
                      $objetoSesion = unserialize($objetoSesion); 
                      $button=$_POST['button'];

                      if($objetoSesion!=null){
                        $NOMBRE=$objetoSesion->getNombre();
                        $CODIGO=$objetoSesion->getCodigo();
                        $FRET=$objetoSesion->getFRegistro();

                        $FINAC=$objetoSesion->getFInactivo();
                      
                        if($objetoSesion->getTipo()=="Natural"){
                          $TIPO="Natural";
                        }else
                          $TIPO="Juridica";
                    
                        $TELEFONO=$objetoSesion->getTelefono();
                        $EMAIL=$objetoSesion->getEmail();
                        $urlFoto= $objetoSesion->getUrlImagen();
                        $statusActualizar="display:block";
                        $statusInactivar="display:block";
                        $statusRegistrar="display:none";
                        $statusImgFoto ="dispplay:block";
                        $statusRegistro="display:block";
                        $statusFoto ="dispplay:block";
                        $statusLectura="readonly='true'";
                        

                      }

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
                        
                          $objProveedor= new Proveedor($cod,$nom,$tipo,$fRegistro,$fInac,$urlFoto,$email,$telefono,0);
                          $objControlProveedor= new ControlProveedor($objProveedor);
                          $objProveedor1=$objControlProveedor->consultar();
                          
                          if(empty($objProveedor1->getCodigo()) || $objProveedor1==null){

                              $objProveedor= new Proveedor($cod,$nom,$tipo,$fRegistro,$fInac,$urlFoto,$email,$telefono,0);
                              $objControlProveedor= new ControlProveedor($objProveedor);
                              $objControlProveedor->guardar();
                              $statusRegistrarM="display:block";
                              actualizarValor();
                          }else{
                            $statusExistencia = "display:block";
                          }


                      break;


                      case "actualizar": 

                        $objProveedor= new Proveedor($cod,"","","","","","","","");
                        $objControlProveedor= new ControlProveedor($objProveedor);
                        $objProveedor=$objControlProveedor->consultar();

                        if($objProveedor->getInactivo()==1){
                        $statusConfInactivar="display:block";
                        }else{
                          $objProveedor= new Proveedor($cod,$nom,$tipo,$fRegistro,$fInac,$urlFoto,$email,$telefono,0);
                          $objControlProveedor= new ControlProveedor($objProveedor);
                          $objControlProveedor->modificar();
                          $statusActualizarM="display:block";
                          actualizarValor();
                          
                        }

                      break;
                      
                      
                      case "inactivar":

                        $objProveedor= new Proveedor($cod,"","","","","","","","");
                        $objControlProveedor= new ControlProveedor($objProveedor);
                        $objProveedor=$objControlProveedor->consultar();

                          if($objProveedor->getInactivo()==1){
                            $statusConfInactivar="display:block";
                          }else{
                            $objControlProveedor= new ControlProveedor($objProveedor);
                            $objControlProveedor->inactivar();
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
                          <link rel=\"StyleSheet\" href=\"//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css\" type=\"text/css\">
                          <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js\"></script>
                          <script src=\"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js\"></script>
                          <script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js\"></script>
                          <script src=\"//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js\"></script>
                          <script src = \"https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js\"> </script>
                          <title>Empleado</title>


                          <script type=\"text/javascript\">

                          

                          function validarCampos(){
                          
                                  var codigo =document.getElementById(\"codigo\").value;
                                  var nombre =document.getElementById(\"nombre\").value;
                                  var telefono =document.getElementById(\"telefono\").value;
                                  var tipo =document.getElementById(\"tipo\").value;

                                  if(isNaN(codigo)){
                                    alert('Formato Invalido');
                                    return false;
                                  }
                
                              
                                  if(!isNaN(nombre)){
                                    alert('Formato de Nombre Invalido');
                                    return false;
                                  }


                                  if(!isNaN(tipo)){
                                    alert('Formato de Tipo Invalido');
                                    return false;
                                  }
          
                                  if(isNaN(telefono)){
                                    alert('Formato Invalido');
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
                  <div class=\"container\">
                  <div class=\"row\">
                  <div class=\"col-sm-12\">
            <form method=\"POST\" enctype=\"multipart/form-data\" onsubmit=\"return validarCampos();\"> <br><br>

            <div class=\"alert alert-success\" role=\"alert\" id=\"txtActualizado\" style=\"$statusActualizarM\">
            <strong>Bien Hecho!</strong> El proveedor ha sido actualizado con exito.
            </div>
            <div class=\"alert alert-success\" role=\"alert\"  id=\"txtInactivado\" style=\"$statusRegistrarM\">
            <strong>Bien Hecho!</strong> El proveedor ha sido registrado con exito.
            </div>
            <div class=\"alert alert-success\" role=\"alert\"  id=\"txtInactivado\" style=\"$statusInactivarM\">
            <strong>Bien Hecho!</strong> El proveedor ha sido inactivado con exito.
            </div>
            <div class=\"alert alert-warning\" role=\"alert\"  id=\"txtInactivado\" style=\"$statusConfInactivar\">
            <strong>Ups!</strong> El proveedor se encuentra en estado inactivado.
            </div>
            <div class=\"alert alert-warning\" role=\"alert\"  id=\"txtInactivado\" style=\"$statusExistencia\">
            <strong>Ups!</strong> El proveedor con codigo $cod ya existe en la base de datos xxxxx
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
                          <label for=\"codigo\">Tipo de Persona</label>
                          <input type=\"text\" class=\"form-control\"value=\"$TIPO\"  id=\"tipo\" name=\"txtTipo\" placeholder=\"Natural/Juridica\">
                          </div>
                  
                          <div class=\"form-group\">
                          <label for=\"codigo\">Codigo</label>
                          <input type=\"text\" class=\"form-control\"value=\"$CODIGO\"  id=\"codigo\" name=\"txtCodigo\" placeholder=\"Documento de identidad\" $statusLectura>
                          </div>
        
                          <div class=\"form-group\">
                          <label for=\"nombre\">Nombre</label>
                          <input type=\"text\" class=\"form-control\" value=\"$NOMBRE\" id=\"nombre\" name=\"txtNombre\" placeholder=\"Nombre\">
                          </div>
                    

                          <div class=\"form-group\">
                          <label for=\"fRetiro\">Fecha de Inactivo</label>
                        <input type=\"date\" class=\"form-control\"value=\"$FINAC\" id=\"inactivo\" name=\"txtInactividad\" placeholder=\"Fecha de Inactividad\">
                          </div>

                          <div class=\"form-group\" style =\"$statusRegistro\">
                          <label for=\"fRetiro\">Fecha de Registro</label>
                        <input type=\"text\" class=\"form-control\"value=\"$FRET\" id=\"registro\" name=\"txtRegistro\" $statusLectura>
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
        
              <br>
              <table class=\"table table-hover  tableFixHead\" >

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