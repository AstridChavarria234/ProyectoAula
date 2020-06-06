  <?php 
              error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
              session_start();

              if(!isset($_SESSION['usuario']) && !isset($_SESSION['clave']))
              header('Location:Index.php');


              include("../controlador/configBd.php");
              include("../modelo/Cliente.php");
              include("../controlador/ControlCliente.php");
              include("../controlador/ControlConexion.php");
              include("../modelo/Usuario.php");
              include("../controlador/ControlUsuario.php");
              include("../modelo/Notificacion.php");
              include("../controlador/ControlNotificacion.php");
              

              $cod=$_POST['txtCodigo']; 
              $nom=$_POST['txtNombre'];
              $tPersona=$_POST['txtTipo_Persona'];
              $fReg=$_POST['txtRegistro'];
              $fInact=$_POST['txtInactivo'];
              $email=$_POST['txtEmail'];
              $tel=$_POST['txtTelefono'];
              $topCred=$_POST['txtTope_Credito'];
              $comuna=$_POST['txtComuna'];
              $longitud=$_POST['txtLongitud'];
              $latitud=$_POST['txtLatitud'];
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
              $statusArchivoImg="display:none";
              $statusImg="display:none"; 
              $urlImg;
              $objetoSesion = $_SESSION["cliente"];
              $objetoSesion = unserialize($objetoSesion); 

              $objetoSesionDefault = $_SESSION["clienteDefault"];
              $objetoSesionDefault = unserialize($objetoSesionDefault); 

              $button=$_POST['button'];

            
              if(!empty($objetoSesion)){
                $CODIGO=$objetoSesion->getCodigo();
                $NOMBRE=$objetoSesion->getNombre();
                $PERSONA=$objetoSesion->getTipoPersona();
                $REGISTRO=$objetoSesion->getFRegistro();
                $INACTIVO=$objetoSesion->getFInactivo();
                $EMAIL=$objetoSesion->getEmail();
                $TELEFONO=$objetoSesion->getTelefono();
                $TCREDITO=$objetoSesion->getTopeCred();
                $COMUNA=$objetoSesion->getComuna();
                $BARRIO=$objetoSesion->getBarrio();
                $urlImg=$objetoSesion->getUrlImagen();
                $LONGITUD= $objetoSesion->getLatitud();
                $LATITUD= $objetoSesion->getLongitud();
                $statusImg="display:block";
                $statusActualizar="display:block";
                $statusInactivar="display:block";
                $statusRegistrar="display:none";
                $statusLectura="readonly='true'";
                $statusNavBar = "display:none";
              }

              if(!empty($objetoSesionDefault)){
                $CODIGO=$objetoSesionDefault->getCodigo();
                $NOMBRE=$objetoSesionDefault->getNombre();
                $PERSONA=$objetoSesionDefault->getTipoPersona();
                $REGISTRO=$objetoSesionDefault->getFRegistro();
                $INACTIVO=$objetoSesionDefault->getFInactivo();
                $EMAIL=$objetoSesionDefault->getEmail();
                $TELEFONO=$objetoSesionDefault->getTelefono();
                $TCREDITO=$objetoSesionDefault->getTopeCred();
                $COMUNA=$objetoSesionDefault->getComuna();
                $BARRIO=$objetoSesionDefault->getBarrio();
                $urlImg=$objetoSesionDefault->getUrlImagen();
                $LATITUD=$objetoSesionDefault->getLatitud();
                $LONGITUD=$objetoSesionDefault->getLongitud();
                $statusImg="display:block";
                $statusActualizar="display:block";
                $statusInactivar="display:none";
                $statusRegistrar="display:none";
                $statusLectura="readonly='true'";
                $statusNavBar = "display:none";
              }


  // Aqui comienza el guardado de archivos

                if(!empty($_FILES['archivo']['name']))
                {
                
                      
                      $urlImg= "../archivos/".$_FILES['archivo']['name'];
                      if (file_exists($urlImg)) {
                      $statusArchivoImg ="display:block";

                  }else{

                        $ruta_temporal = $_FILES['archivo']['tmp_name'];
                        move_uploaded_file($ruta_temporal, $urlImg);

                        echo "<script>
                                  alert('El archivo se subio de manera exitosa');
                              
                                  </script>";

                        }

              }

              

              
  // Aqui termina el guardado

              switch($button){

                case "registrar":

                $objCliente= new Cliente($cod,"","","","","","","","","","","","","");
                $objControlCliente= new ControlCliente($objCliente);
                $objCliente=$objControlCliente->consultar();

              
                if(empty($objCliente->getNombre())){

                  $objUsuario = new Usuario("",$nom,$cod,4,0);
                  $objControlUsuario = new ControlUsuario($objUsuario);
                  $objControlUsuario->guardar();
                  $objUsuario1=$objControlUsuario->consultarExistencia();
                  $objCliente= new Cliente($cod,$nom,$tPersona,$fReg,$fInact,$urlImg,$email,$tel,$topCred,$comuna,$barrio,$objUsuario1->getId(),$latitud,$longitud);
                  $objControlCliente= new ControlCliente($objCliente);
                  $objControlCliente->guardar();
                  $statusRegistrarM="display:block";
                  actualizarValor();
                }else
                $statusExistencia="display:block";
                
              break; 

                case "actualizar":  

                  $objCliente= new Cliente($cod,"","","","","","","","","","","","","");
                  $objControlCliente= new ControlCliente($objCliente);
                  $objCliente=$objControlCliente->consultar();
    

                  $objUsuario = new Usuario($objCliente->getId(),"","","","");
                  $objControlUsuario = new ControlUsuario($objUsuario);
                  $objUsuario=$objControlUsuario->consultar();

                  if($objUsuario->getEstado()==0){
                    $idUsu=$objUsuario->getId();
                            $objCliente= new Cliente($cod,$nom,$tPersona,$fReg,$fInact,$urlImg,$email,$tel,$topCred,$comuna,$barrio,0,$latitud,$longitud);
                           $cli= (array)$objCliente;

                            $str=implode('&', $cli);
                          

                            $objNotificacion= new Notificacion($idUsu,$nom,4,$str);
                            $objControlNotificacion= new ControlNotificacion($objNotificacion);
                            $objControlNotificacion->guardar();
                            $statusActualizarM="display:block";
                            actualizarValor();
            
                  }else{
                    $statusConfInactivar= "display:block";
                  }
              
                
                break; 
              
                case "inactivar":
                  
                  $objCliente= new Cliente($cod,"","","","","","","","","","","","","");
                  $objControlCliente= new ControlCliente($objCliente);
                  $objCliente=$objControlCliente->consultar();

                  $objUsuario = new Usuario($objCliente->getId(),"","","","");
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
                unset($_SESSION["cliente"]);
                unset($_SESSION["clienteDefault"]);
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
                  <title>Cliente</title>

                  <script type=\"text/javascript\">

                  function validarCampos(){
                  
                          var codigo =document.getElementById(\"codigo\").value;
                          var nombre =document.getElementById(\"nombre\").value;
                        // var persona =document.getElementById(\"persona\").value;
                          var telefono =document.getElementById(\"telefono\").value;
                          var credito =document.getElementById(\"credito\").value;
                          var registro =document.getElementById(\"registro\").value;
                          //var inactivo =document.getElementById(\"inactivo\").value;
                          var arrayRegistro=registro.split(\"-\"); 
                          //var arrayInactivo=inactivo.split(\"-\"); 

                  

                          if(isNaN(codigo)){
                            alert('Formato Invalido');
                            return false;
                          }
        
                      
                          if(!isNaN(nombre)){
                            alert('Formato de Nombre Invalido');
                            return false;
                          }
  
                          /*if(isNaN(persona)){
                            alert('Formato de Tipo de persona Invalido');
                            return false;
                          }*/
        
                          if(isNaN(telefono)){
                            alert('Formato de Telefono Invalido');
                            return false;
                          }
        
                          
                          if(isNaN(credito)){
                            alert('Formato de Credito Invalido');
                            return false;
                          }

                          /* if((arrayInactivo[0]<arrayRegistro[0]) || (arrayInactivo[2]<arrayRegistro[2])){
                            alert('Fecha de Inactividad Invalida: Debe ser superior o igual a la Fecha de Registro');
                            return false;
                          }*/
                        
                    
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
              <a class=\"navbar-brand\" href=\"#\">Clientes</a>
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
                <a class=\"dropdown-item\" style=\"$statusNavBar\"  href=\"ConsultarCliente.php\">Consultar Cliente</a>
                <a class=\"dropdown-item\" style=\"$statusNavBar\" href=\"TablaCliente.php\">Listar Clientes</a>
            
              </li>
                <li class=\"nav-item dropdown\">
        
                <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdownMenuLink\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                Producto
                </a>
                <div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdownMenuLink\">
                <a class=\"dropdown-item\" style=\"$statusNavBar\" href=\"Producto.php\">Producto</a>
                <a class=\"dropdown-item\" style=\"$statusNavBar\" href=\"ConsultarProducto.php\">Consultar Producto</a>
                <a class=\"dropdown-item\" style=\"$statusNavBar\" href=\"TablaProducto.php\">Listar Productos</a>

            
              </li>

              <li class=\"nav-item dropdown\">
        
                <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdownMenuLink\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                Proveedor
                </a>
                <div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdownMenuLink\">
                <a class=\"dropdown-item\" style=\"$statusNavBar\"  href=\"Proveedor.php\">Proveedor</a>
                <a class=\"dropdown-item\"style=\"$statusNavBar\"  href=\"ConsultarProveedor.php\">Consultar Proveedor</a>
                <a class=\"dropdown-item\" style=\"$statusNavBar\" href=\"TablaProveedor.php\">Listar Proveedores</a>

            
              </li>
        
                <li class=\"nav-item dropdown\">
        
                <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdownMenuLink\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                Usuarios
                </a>
                <div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdownMenuLink\">
          <a class=\"dropdown-item\"style=\"$statusNavBar\" href=\"Usuario.php\">Usuario</a>
                <a class=\"dropdown-item\" style=\"$statusNavBar\" href=\"ConsultarUsuario.php\">Consultar Usuario</a>
                <a class=\"dropdown-item\" style=\"$statusNavBar\" href=\"TablaUsuario.php\">Listar Usuarios</a>
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
        <strong>Bien Hecho!</strong> Los datos del cliente han sido enviados para autorizar su actualizacion.
        </div>
        <div class=\"alert alert-success\" role=\"alert\"  id=\"txtInactivado\" style=\"$statusRegistrarM\">
        <strong>Bien Hecho!</strong> El cliente ha sido registrado con exito.
        </div>
        <div class=\"alert alert-success\" role=\"alert\"  id=\"txtInactivado\" style=\"$statusInactivarM\">
        <strong>Bien Hecho!</strong> El cliente ha sido inactivado con exito.
        </div>
        <div class=\"alert alert-warning\" role=\"alert\"  id=\"txtInactivado\" style=\"$statusConfInactivar\">
        <strong>Ups!</strong> El cliente se encuentra en estado inactivado.
        </div>
        <div class=\"alert alert-warning\" role=\"alert\"  id=\"txtInactivado\" style=\"$statusExistencia\">
        <strong>Ups!</strong> El cliente con numero de identificacion $cod ya existe en la base de datos xxxxx
        </div>

        <div class=\"alert alert-warning\" role=\"alert\"  id=\"txtInactivado\" style=\"$statusActivado\">
        <strong>Ups!</strong> Al actualizar el cliente esta activando su acceso en caso que este inactivado
        </div>

        <?php>
        <div class=\"alert alert-warning\" role=\"alert\"  id=\"txtArchivo\" style=\"$statusArchivoImg\">
        <strong>Ups!</strong>Intente subir un archivo diferente.El archivo $urlImg ya existe
        </div>

        <?>
                  
                  <img src=\"$urlImg\" height=\"150\" width=\"120\" style =\"$statusImg\">

                  <div class=\"form-group\" id=\"Imagen\">
                  <label for=\"Imagen\">Imagen del Cliente</label>
                  <input type=\"file\" class=\"form-control-file\" name=\"archivo\" style =\"$statusImagen\">
                  <br>
                  </div>
            
                  <div class=\"form-group\">
                  <label for=\"codigo\">Codigo</label>
                  <input type=\"text\" class=\"form-control\"value=\"$CODIGO\"  id=\"codigo\" name=\"txtCodigo\" placeholder=\"Codigo de Cliente\" $statusLectura>
                  </div>
            
                  <div class=\"form-group\">
                  <label for=\"nombre\">Nombre</label>
                  <input type=\"text\" class=\"form-control\" value=\"$NOMBRE\" id=\"nombre\" name=\"txtNombre\" placeholder=\"Nombre de cliente\" required>
                  </div>

                  <div class=\"form-group\">
                  <label for=\"persona\">Tipo Persona</label>
                  <input type=\"text\" class=\"form-control\" value=\"$PERSONA\" id=\"persona\" name=\"txtTipo_Persona\" placeholder=\"Persona natural o juridica\">
                  </div>
            
                  <div class=\"form-group\">
                  <label for=\"fRegistro\">Fecha de Registro</label>
                  <input type=\"date\" class=\"form-control\"  value=\"$REGISTRO\" id=\"registro\"name=\"txtRegistro\" placeholder=\"Fecha de Registro a la empresa\" >
                  </div>
            
                  <div class=\"form-group\">
                  <label for=\"fInactivo\">Fecha de Inactividad</label>
                <input type=\"date\" class=\"form-control\"value=\"$INACTIVO\" id=\"inactivo\" name=\"txtInactivo\" placeholder=\"Fecha de Inactividad en la empresa\">
                  </div>
                    
            
                  <div class=\"form-group\">
                  <label for=\"email\">Correo Electronico </label>
                  <input type=\"email\" class=\"form-control\"value=\"$EMAIL\" name=\"txtEmail\" aria-describedby=\"emailHelp\" placeholder=\"Correo Electronico Personal\">
                  <small id=\"emailHelp\" class=\"form-text text-muted\">We'll never share your email with anyone else.</small>
                  </div>
            
            
                  <div class=\"form-group\">
                  <label for=\"telefono\">Telefono</label>
                  <input type=\"text\" class=\"form-control\" value=\"$TELEFONO\" id=\"telefono\" name=\"txtTelefono\" placeholder=\"Telefono\">
                  </div>
            
                  <div class=\"form-group\">
                  <label for=\"credito\">Tope de credito</label>
                  <input type=\"text\" class=\"form-control\"value=\"$TCREDITO\" id=\"credito\" name=\"txtTope_Credito\" placeholder=\"Tope de credito del cliente\">
                  </div>

                  <div class=\"form-group\">
                  <label for=\"comuna\">Comuna en la que se ubica</label>
                  <input type=\"text\" class=\"form-control\"value=\"$COMUNA\" id=\"comuna\" name=\"txtComuna\" placeholder=\"Comuna de ubicacion\" onkeyup=\"this.value = this.value.toUpperCase();\">
                  </div>

                  <div class=\"form-group\">
                  <label for=\"barrio\">Barrio en el que se ubica</label>
                  <input type=\"text\" class=\"form-control\"value=\"$BARRIO\" id=\"barrio\" name=\"txtBarrio\" placeholder=\"Barrio de ubicacion\" onkeyup=\"this.value = this.value.toUpperCase();\">
                  </div>

                  <div class=\"form-group\">
                  <label for=\"comuna\">Latitud de su ubicacion geografica</label>
                  <input type=\"text\" class=\"form-control\" value=\"$LONGITUD\" id=\"comuna\" name=\"txtLongitud\" placeholder=\"Comuna de ubicacion\" onkeyup=\"this.value = this.value.toUpperCase();\">
                  </div>

                  <div class=\"form-group\">
                  <label for=\"barrio\">Longitud de su ubicacion geofrafica</label>
                  <input type=\"text\" class=\"form-control\" value=\"$LATITUD\" id=\"barrio\" name=\"txtLatitud\" placeholder=\"Barrio de ubicacion\" onkeyup=\"this.value = this.value.toUpperCase();\">
                  </div>

                  <div class=\"form-group\">
                  <label for=\"comuna\">Latitud de su ubicacion geografica</label>
                  <input type=\"text\" class=\"form-control\" value=\"$LONGITUD\" id=\"comuna\" name=\"txtLongitud\" placeholder=\"Longitud de  ubicacion\" onkeyup=\"this.value = this.value.toUpperCase();\">
                  </div>

                  <div class=\"form-group\">
                  <label for=\"barrio\">Longitud de su ubicacion geofrafica</label>
                  <input type=\"text\" class=\"form-control\" value=\"$LATITUD\" id=\"barrio\" name=\"txtLatitud\" placeholder=\"Latitud de ubicacion\" onkeyup=\"this.value = this.value.toUpperCase();\">
                  </div>

                  <br>

                  <table class=\"table table-hover  tableFixHead\" >
          
                  <tbody>
                    <tr>
                    <td><button type=\"submit\" class=\"btn btn-primary\" value=\"registrar\" id=\"registrar\" name=\"button\"style=\"$statusRegistrar\" >Registrar cliente</button>
                    <br></td>
                    <td>  <button type=\"submit\" class=\"btn btn-primary\" value=\"actualizar\" id=\"actualizar\"  name=\"button\" style=\"$statusActualizar\">Actualizar cliente</button>
                    <br> <td>
                    <button type=\"submit\" class=\"btn btn-primary\" value=\"inactivar\"  id=\"inactivar\"  name=\"button\" style=\"$statusInactivar\">Inactivar cliente</button>
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