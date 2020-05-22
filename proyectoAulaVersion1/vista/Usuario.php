<?php 
            error_reporting(E_ALL ^ E_NOTICE);
            session_start();

            if(!isset($_SESSION['usuario']) && !isset($_SESSION['clave']))
            header('Location:Index.php');


            include("../controlador/configBd.php");
            include("../modelo/Usuario.php");
            include("../controlador/ControlUsuario.php");
            include("../controlador/ControlConexion.php");


            $id=$_POST['txtId']; 
            $usu=$_POST['txtUsuario'];
            $clave=$_POST['txtClave'];
            $nivel=$_POST['txtNivel'];
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
            $objetoSesion = $_SESSION["usuario"];
            $objetoSesion = unserialize($objetoSesion); 
            $button=$_POST['button'];

           
            if(!empty($objetoSesion)){
              $ID=$objetoSesion->getId();
              $USUARIO=$objetoSesion->getUsuario();
              $CLAVE=$objetoSesion->getClave();
              $NIVEL=$objetoSesion->getNivel();
              $statusActualizar="display:block";
              $statusInactivar="display:block";
              $statusRegistrar="display:none";
              $statusLectura="readonly='true'";
            }



            switch($button){

              case "registrar":

              $objUsuario= new Usuario("",$usu,"","");
              $objControlUsuario= new ControlUsuario($objUsuario);
              $objUsuario1=$objControlUsuario->consultar();
              
             
              if(empty($objUsuario1->getId())){

                $objUsuario= new Usuario("",$usu,$clave,$nivel);
                $objControlUsuario= new ControlUsuario($objUsuario);
                $objControlUsuario->guardar();
                $statusRegistrarM="display:block";
                actualizarValor();
              }else
              $statusExistencia="display:block";
              
            break; 

              case "actualizar":  

                $objUsuario = new Usuario($ID,"","","","");
                $objControlUsuario = new ControlUsuario($objUsuario);
                $objUsuario=$objControlUsuario->consultar();
                if($objUsuario->getEstado()==1){
                $statusConfInactivar="display:block";
                }else{
                  $objUsuario= new Usuario($objUsuario->getId(),$usu,$clave,$nivel,"");
                  $objControlUsuario= new ControlUsuario($objUsuario);
                  $objControlUsuario->modificar();
                  $statusActualizarM="display:block";
               
                  // actualizarValor();
                }
              
           

            
                
          
              break; 
            
              
              case "inactivar":

                $objUsuario = new Usuario($ID);
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
              unset($_SESSION["usuario"]);
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
                <title>Usuario</title>

                <script type=\"text/javascript\">

                function validarCampos(){
                
                        
                        var usuario =document.getElementById(\"usuario\").value;
                        var clave =document.getElementById(\"clave\").value;
                        var nivel =number.getElementById(\"nivel\").value;
                

                        if(isNaN(usuario)){
                          alert('Formato Invalido');
                          return false;
                         }
      
                     
                         if(!isNaN(clave)){
                          alert('Clave Invalida');
                          return false;
                         }
 
                         if(isNaN(nivel)){
                          alert('Formato de nivel invalido');
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
      
        </form>
                    <div class=\"container\">
                    <div class=\"row\">
                    <div class=\"col-sm-12\">
              <form method=\"POST\" enctype=\"multipart/form-data\" onsubmit=\"return validarCampos();\"> <br><br>

      <div class=\"alert alert-success\" role=\"alert\" id=\"txtActualizado\" style=\"$statusActualizarM\">
      <strong>Bien Hecho!</strong> El Usuario ha sido actualizado con exito.
      </div>
      <div class=\"alert alert-success\" role=\"alert\"  id=\"txtInactivado\" style=\"$statusRegistrarM\">
      <strong>Bien Hecho!</strong> El Usuario ha sido registrado con exito.
      </div>
      <div class=\"alert alert-success\" role=\"alert\"  id=\"txtInactivado\" style=\"$statusInactivarM\">
      <strong>Bien Hecho!</strong> El Usuario ha sido inactivado con exito.
      </div>
      <div class=\"alert alert-warning\" role=\"alert\"  id=\"txtInactivado\" style=\"$statusConfInactivar\">
      <strong>Ups!</strong> El Usuario se encuentra en estado inactivado.
      </div>
      <div class=\"alert alert-warning\" role=\"alert\"  id=\"txtInactivado\" style=\"$statusExistencia\">
      <strong>Ups!</strong> El Usuario .$usu. ya existe en la base de datos xxxxx
      </div>

      <div class=\"alert alert-warning\" role=\"alert\"  id=\"txtInactivado\" style=\"$statusActivado\">
      <strong>Ups!</strong> Al actualizar el Usuario esta activando su acceso en caso que este inactivado
      </div>

          
          
                <div class=\"form-group\">
                <label for=\"usuario\">Usuario</label>
                <input type=\"text\" class=\"form-control\" value=\"$USUARIO\" id=\"usuario\" name=\"txtUsuario\" placeholder=\"Nombre de Usuario\" required >
                </div>

                <div class=\"form-group\">
                <label for=\"clave\">Clave</label>
                <input type=\"password\" class=\"form-control\" value=\"$CLAVE\" id=\"clave\" name=\"txtClave\" placeholder=\"Clave de usuario\" required >
                </div>
          
               
                <div class=\"form-group\">
                <label for=\"nivel\">Nivel de acceso</label>
                  <select class=\"form-control\" id=\"nivel\" value=\"$NIVEL\" name=\"txtNivel\">
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                  </select>
                </div>
          
                <br>
                <table class=\"table table-hover  tableFixHead\" >
        
                <tbody>
                  <tr>
                  <td><button type=\"submit\" class=\"btn btn-primary\" value=\"registrar\" id=\"registrar\" name=\"button\"style=\"$statusRegistrar\" >Registrar Usuario</button>
                  <br></td>
                  <td>  <button type=\"submit\" class=\"btn btn-primary\" value=\"actualizar\" id=\"actualizar\"  name=\"button\" style=\"$statusActualizar\">Actualizar Usuario</button>
                  <br> <td>
                  <button type=\"submit\" class=\"btn btn-primary\" value=\"inactivar\"  id=\"inactivar\"  name=\"button\" style=\"$statusInactivar\">Inactivar Usuario</button>
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