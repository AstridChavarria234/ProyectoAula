                <?php 
                error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
               
                session_start();

                if(!isset($_SESSION['usuario']) && !isset($_SESSION['clave']))
                header('Location:Index.php');

                include("../controlador/configBd.php");
                include("../modelo/Empleado.php");
                include("../controlador/ControlEmpleado.php");
                include("../controlador/ControlConexion.php");
                include("../modelo/Usuario.php");
                include("../controlador/ControlUsuario.php");
                include("../modelo/Notificacion.php");
                include("../controlador/ControlNotificacion.php");

                $doc=$_POST['txtDocumento']; 
                $nom=$_POST['txtNombre']; 
                $fIng=$_POST['txtIngreso'];
                $fRet=$_POST['txtRetiro'];
                $salario=$_POST['txtSalario'];
                $dedu=$_POST['txtDeduccion'];
                $email=$_POST['txtEmail'];
                $telFijo=$_POST['txtFijo'];
                $telCel=$_POST['txtMovil'];
                $comuna=$_POST['txtComuna'];
                $barrio=$_POST['txtBarrio'];
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
                $statusArchivoFoto="display:none";
                $statusArchivoCV="display:none";
                $statusImgFoto="display:none"; 
                $statusImgCV="display:none";
                $urlFoto;
                $CV;
                $objetoSesion = $_SESSION["empleado"];
                $objetoSesionDefault = $_SESSION["empleadoDefault"];
              
                $objetoSesion = unserialize($objetoSesion); 
                $objetoSesionDefault = unserialize($objetoSesionDefault); 

                $button=$_POST['button'];

              
                if(!empty($objetoSesion)){
                  $NOMBRE=$objetoSesion->getNombre();
                  $DOCUMENTO=$objetoSesion->getDocumento();
                  $RETIRO=$objetoSesion->getFRetiro();
                  $INGRESO=$objetoSesion->getFIngreso();
                  $SALARIO=$objetoSesion->getSalario();
                  $DEDUCCION=$objetoSesion->getDeduccion();
                  $EMAIL=$objetoSesion->getEmail();
                  $FIJO=$objetoSesion->getTelFijo();
                  $CEL=$objetoSesion->getTelCel();
                  $COMUNA=$objetoSesion->getComuna();
                  $BARRIO=$objetoSesion->getBarrio();
                  $CV= $objetoSesion->getCV();
                  $urlFoto= $objetoSesion->getUrlFoto();
                  $statusActualizar="display:block";
                  $statusInactivar="display:block";
                  $statusRegistrar="display:none";
                  $statusImgCV ="display:block";
                  $statusImgFoto ="display:block";
                  $statusLectura="readonly='true'";
                  $statusNavBar = "display:none";
                }

                if(!empty($objetoSesionDefault)){

                  $NOMBRE=$objetoSesionDefault->getNombre();
                  $DOCUMENTO=$objetoSesionDefault->getDocumento();
                  $RETIRO=$objetoSesionDefault->getFRetiro();
                  $INGRESO=$objetoSesionDefault->getFIngreso();
                  $SALARIO=$objetoSesionDefault->getSalario();
                  $DEDUCCION=$objetoSesionDefault->getDeduccion();
                  $EMAIL=$objetoSesionDefault->getEmail();
                  $FIJO=$objetoSesionDefault->getTelFijo();
                  $CEL=$objetoSesionDefault->getTelCel();
                  $COMUNA=$objetoSesionDefault->getComuna();
                  $BARRIO=$objetoSesionDefault->getBarrio();
                  $CV= $objetoSesionDefault->getCV();
                  $urlFoto= $objetoSesionDefault->getUrlFoto();
                  $statusActualizar="display:block";
                  $statusInactivar="display:none";
                  $statusRegistrar="display:none";
                  $statusImgCV ="display:block";
                  $statusImgFoto ="display:block";
                  $statusLectura="readonly='true'";
                  $statusNavBar = "display:none";
                }


              


        $num_archivos=count($_FILES['archivo']['name']);
        for ($i=0; $i <=$num_archivos ; $i++) { 
          if(!empty($_FILES['archivo']['name'][$i]))
          {
            switch ($i) {
              case 0:
                $urlFoto= "../archivos/".$_FILES['archivo']['name'][$i];
                if (file_exists($urlFoto)) {
                $statusArchivoFoto ="display:block";

                }else{
                  $ruta_temporal = $_FILES['archivo']['tmp_name'][$i];
                  move_uploaded_file($ruta_temporal, $urlFoto);
                          }
                break;
              
              case 1:
                
                $CV= "../archivos/".$_FILES['archivo']['name'][$i];
                if (file_exists($urlCv)) {
                  $statusArchivoCV ="display:block";
                }else{
                  $ruta_temporal1 = $_FILES['archivo']['tmp_name'][$i];
                  move_uploaded_file($ruta_temporal1, $CV);
                }
                break;
            }}}
            
            
            
            switch($button){

                  case "registrar":
                  $objEmpleado= new Empleado($doc,$nom,$fIng,$fRet,$salario,$dedu,$urlFoto,$CV,$email,$telFijo,$telCel,$comuna,$barrio,0);
                  $objControlEmpleado= new ControlEmpleado($objEmpleado);
                  $objEmpleado=$objControlEmpleado->consultar();

                  if(empty($objEmpleado->getNombre())){

                    $objUsuario = new Usuario("",$nom,$doc,2,0);
                    $objControlUsuario = new ControlUsuario($objUsuario);
                    $objControlUsuario->guardar();
                    $objUsuario1=$objControlUsuario->consultarExistencia();
                    $objEmpleado= new Empleado($doc,$nom,$fIng,$fRet,$salario,$dedu,$urlFoto,$CV,$email,$telFijo,$telCel,$comuna,$barrio,$objUsuario1->getId());
                    $objControlEmpleado= new ControlEmpleado($objEmpleado);
                    $objControlEmpleado->guardar();
                    $statusRegistrarM="display:block";
                    actualizarValor();
                                  
                  }else
                  $statusExistencia="display:block";
                  
                break; 

                  case "actualizar": 
                    
                    
                    $objEmpleado= new Empleado($doc,$nom,$fIng,$fRet,$salario,$dedu,$urlFoto,$CV,$email,$telFijo,$telCel,$comuna,$barrio,0);
                    $objControlEmpleado= new ControlEmpleado($objEmpleado);
                    $objEmpleado=$objControlEmpleado->consultar();
                  
                    $objUsuario = new Usuario($objEmpleado->getId(),"","","","");
                    $objControlUsuario = new ControlUsuario($objUsuario);
                    $objUsuario=$objControlUsuario->consultar();

                    if($objUsuario->getEstado()==1){
                    $statusConfInactivar="display:block";
                    }else{
                      $idUsu=$objUsuario->getId();
                            $objEmpleado= new Empleado($doc,$nom,$fIng,$fRet,$salario,$dedu,$urlFoto,$CV,$email,$telFijo,$telCel,$comuna,$barrio,0);
                           $emp= (array)$objEmpleado;

                            $str=implode('&', $emp);
                            

                            $objNotificacion= new Notificacion($idUsu,$nom,2,$str);
                            $objControlNotificacion= new ControlNotificacion($objNotificacion);
                            $objControlNotificacion->guardar();
                            $statusActualizarM="display:block";
                            actualizarValor();
                    }

                  break; 
                  
                  case "inactivar":


                    $objEmpleado= new Empleado($doc,$nom,$fIng,$fRet,$salario,$dedu,$urlFoto,$CV,$email,$telFijo,$telCel,$comuna,$barrio,0);
                    $objControlEmpleado= new ControlEmpleado($objEmpleado);
                    $objEmpleado=$objControlEmpleado->consultar();

                    $objUsuario = new Usuario($objEmpleado->getId(),"","","","");
                    $objControlUsuario = new ControlUsuario($objUsuario);
                    $objUsuario=$objControlUsuario->consultar();

                    if($objUsuario->getEstado()==1){
                      $statusConfInactivar="display:block";
                    }else{

                      $objControlUsuario= new ControlUsuario($objUsuario);
                      $objControlUsuario->inactivar();
                      $statusInactivarM="display:block";
                      actualizarValor();
                    }
                  
                  break; 

                }

                function actualizarValor(){
                  unset($_SESSION["empleado"]);
                  unset($_SESSION["empleadoDefault"]);
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


                            if(arrayRetiro[0]!=''){

                              if(arrayRetiro[1]<arrayIngreso[1]){
                                alert('Fecha de Retiro debe ser mayor a la Fecha de Ingreso');
                                return false;
                              }
                              if(arrayRetiro[2]<arrayIngreso[2]){
                                alert('Fecha de Retiro debe ser mayor a la Fecha de Ingreso');
                                return false;
                              }
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
                <a class=\"navbar-brand\" href=\"#\">Empleados</a>
                <ul class=\"navbar-nav mr-auto mt-2 mt-lg-0\">
              <li class=\"nav-item dropdown\">
        
              <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdownMenuLink\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
              Empleados
              </a>
              <div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdownMenuLink\">
              <a class=\"dropdown-item\" href=\"Empleado.php\">Empleado</a>
              <a class=\"dropdown-item\" style=\"$statusNavBar\" href=\"ConsultarEmpleado.php\">Consultar Empleado</a>
              <a class=\"dropdown-item\" style=\"$statusNavBar\" href=\"TablaEmpleado.php\">Listar Empleado</a>
              
            </li>
                <li class=\"nav-item dropdown\">
        
                <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdownMenuLink\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                Clientes
                </a>
                <div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdownMenuLink\">
                <a class=\"dropdown-item\" style=\"$statusNavBar\" href=\"Cliente.php\">Cliente</a>
                <a class=\"dropdown-item\" style=\"$statusNavBar\" href=\"ConsultarCliente.php\">Consultar Cliente</a>
                <a class=\"dropdown-item\"  style=\"$statusNavBar\" href=\"TablaCliente.php\">Listar Clientes</a>
            
              </li>
                <li class=\"nav-item dropdown\">
        
                <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdownMenuLink\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                Producto
                </a>
                <div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdownMenuLink\">
                <a class=\"dropdown-item\"  style=\"$statusNavBar\" href=\"Producto.php\">Producto</a>
                <a class=\"dropdown-item\"  style=\"$statusNavBar\" href=\"ConsultarProducto.php\">Consultar Producto</a>
                <a class=\"dropdown-item\"  style=\"$statusNavBar\" href=\"TablaProducto.php\">Listar Productos</a>

            
              </li>

              <li class=\"nav-item dropdown\">
        
                <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdownMenuLink\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                Proveedor
                </a>
                <div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdownMenuLink\">
                <a class=\"dropdown-item\" style=\"$statusNavBar\" href=\"Proveedor.php\">Proveedor</a>
                <a class=\"dropdown-item\" style=\"$statusNavBar\" href=\"ConsultarProveedor.php\">Consultar Proveedor</a>
                <a class=\"dropdown-item\"  style=\"$statusNavBar\" href=\"TablaProveedor.php\">Listar Proveedores</a>

            
              </li>
        
                <li class=\"nav-item dropdown\">
        
                <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdownMenuLink\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                Usuarios
                </a>
                <div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdownMenuLink\">
          <a class=\"dropdown-item\"  style=\"$statusNavBar\" href=\"Usuario.php\">Usuario</a>
                <a class=\"dropdown-item\"style=\"$statusNavBar\" href=\"ConsultarUsuario.php\">Consultar Usuario</a>
                <a class=\"dropdown-item\"  style=\"$statusNavBar\" href=\"TablaUsuario.php\">Listar Usuarios</a>
                <a class=\"dropdown-item\" style=\"$statusNavBar\" href=\"TablaNotificacion.php\">Solicitudes de Actualizacion</a>

            
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
          <strong>Bien Hecho!</strong> Los datos del empleado han sido enviados para autorizar su actualizacion.
          </div>
          <div class=\"alert alert-success\" role=\"alert\"  id=\"txtInactivado\" style=\"$statusRegistrarM\">
          <strong>Bien Hecho!</strong> El empleado ha sido registrado con exito.
          </div>
          <div class=\"alert alert-success\" role=\"alert\"  id=\"txtInactivado\" style=\"$statusInactivarM\">
          <strong>Bien Hecho!</strong> El empleado ha sido inactivado con exito.
          </div>
          <div class=\"alert alert-warning\" role=\"alert\"  id=\"txtInactivado\" style=\"$statusConfInactivar\">
          <strong>Ups!</strong> El empleado se encuentra en estado inactivado.
          </div>
          <div class=\"alert alert-warning\" role=\"alert\"  id=\"txtInactivado\" style=\"$statusExistencia\">
          <strong>Ups!</strong> El empleado con numero de identificacion $doc ya existe en la base de datos xxxxx
          </div>
          <?php>
          <div class=\"alert alert-warning\" role=\"alert\"  id=\"txtArchivo\" style=\"$statusArchivoFoto\">
          <strong>Ups!</strong>Intente subir un archivo diferente.El archivo $urlFoto ya existe
          </div>
          <?>
          <?php>
          <div class=\"alert alert-warning\" role=\"alert\"  id=\"txtArchivo\" style=\"$statusArchivoCV\">
          <strong>Ups!</strong>Intente subir un archivo diferente.El archivo $CV ya existe
          </div>
          <?>

      
      
                  <img src=\"$urlFoto\" height=\"80\" width=\"100\" style =\"$statusImgFoto\">
                  
                  <div class=\"form-group\" id=\"fotoPerfil\">
                    <label for=\"fotoPerfil\">Foto de Perfil</label>
                    <input type=\"file\" class=\"form-control-file\" name=\"archivo[]\"  style =\"$statusFoto\">
                    <br>
                    </div>
                    <a href=\"$CV\" download=\"CV_$nom\" style =\"$statusImgCV\">Descargar $CV
                    </a>
                    
                    <div class=\"form-group\" id=\"Hoja de Vida\">
                    <label for=\"hojaVida\">Hoja de Vida</label>
                    <input type=\"file\" class=\"form-control-file\" name=\"archivo[]\" style =\"$statusCV\">
                    <br>
                    </div>
              
                    <div class=\"form-group\">
                    <label for=\"fRetiro\">Documento</label>
                    <input type=\"text\" class=\"form-control\"value=\"$DOCUMENTO\"  id=\"documento\" name=\"txtDocumento\" placeholder=\"Documento de identidad\" $statusLectura>
                    </div>
              
                    <div class=\"form-group\">
                    <label for=\"fRetiro\">Nombre</label>
                    <input type=\"text\" class=\"form-control\" value=\"$NOMBRE\" id=\"nombre\" name=\"txtNombre\" placeholder=\"Nombre\" required>
                    </div>
              
                    <div class=\"form-group\">
                    <label for=\"fIngreso\">Fecha de Ingreso</label>
                    <input type=\"date\" class=\"form-control\"  value=\"$INGRESO\" id=\"ingreso\"name=\"txtIngreso\" placeholder=\"Fecha de Ingreso a la empresa\" >
                    </div>
              
                    <div class=\"form-group\">
                    <label for=\"fRetiro\">Fecha de Retiro</label>
                  <input type=\"date\" class=\"form-control\"value=\"$RETIRO\" id=\"retiro\" name=\"txtRetiro\" placeholder=\"Fecha de Retiro de la empresa\">
                    </div>
                      
                    <div class=\"form-group\">
                    <label for=\"salario\">Salario</label>
                    <input type=\"text\" class=\"form-control\" value=\"$SALARIO\" id=\"salario\" name=\"txtSalario\" placeholder=\"Salario basico actual\">
                    </div>
              
                    <div class=\"form-group\">
                    <label for=\"deduccion\">Deducciones</label>
                    <input type=\"text\" class=\"form-control\" value=\"$DEDUCCION\" id=\"deduccion\" name=\"txtDeduccion\" placeholder=\"Deducciones a la fecha\">
                    </div>
              
              
                    <div class=\"form-group\">
                    <label for=\"email\">Correo Electronico </label>
                    <input type=\"email\" class=\"form-control\"value=\"$EMAIL\" name=\"txtEmail\" aria-describedby=\"emailHelp\" placeholder=\"Correo Electronico Personal\">
                    <small id=\"emailHelp\" class=\"form-text text-muted\">We'll never share your email with anyone else.</small>
                    </div>
              
              
                    <div class=\"form-group\">
                    <label for=\"telefonoFijo\">Telefono Fijo</label>
                    <input type=\"text\" class=\"form-control\" value=\"$FIJO\" id=\"fijo\" name=\"txtFijo\" placeholder=\"Telefono Fijo\">
                    </div>
              
                    <div class=\"form-group\">
                    <label for=\"telefonoMovil\">Telefono Movil</label>
                    <input type=\"text\" class=\"form-control\"value=\"$CEL\" id=\"cel\" name=\"txtMovil\" placeholder=\"Telefono Movil\">
                    </div>

                    <div class=\"form-group\">
                  <label for=\"comuna\">Comuna en la que se ubica</label>
                  <input type=\"text\" class=\"form-control\" value=\"$COMUNA\" id=\"comuna\" name=\"txtComuna\" placeholder=\"Comuna de ubicacion\" onkeyup=\"this.value = this.value.toUpperCase();\">
                  </div>

                  <div class=\"form-group\">
                  <label for=\"barrio\">Barrio en el que se ubica</label>
                  <input type=\"text\" class=\"form-control\" value=\"$BARRIO\" id=\"barrio\" name=\"txtBarrio\" placeholder=\"Barrio de ubicacion\" onkeyup=\"this.value = this.value.toUpperCase();\">
                  </div>

                  <br>
                    <table class=\"table table-hover  tableFixHead\" >
            
                    <tbody>
                      <tr>
                      <td><button type=\"submit\" class=\"btn btn-primary\" value=\"registrar\" id=\"registrar\" name=\"button\"style=\"$statusRegistrar\" >Registrar Empleado</button>
                      <br></td>
                      <td>  <button type=\"submit\" class=\"btn btn-primary\" value=\"actualizar\" id=\"actualizar\"  name=\"button\" style=\"$statusActualizar\">Actualizar Empleado</button>
                      <br> <td>
                      <button type=\"submit\" class=\"btn btn-primary\" value=\"inactivar\"  id=\"inactivar\"  name=\"button\" style=\"$statusInactivar\">Inactivar Empleado</button>
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