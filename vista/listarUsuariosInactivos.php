<?php
session_start();
if (empty($_SESSION['rol']) && empty($_SESSION['id'])) {
    header("location: ../index.php?error=Debe Iniciar Sesión");
} else {
    require_once '../modelo/dao/LoginDAO.php';
    require_once '../facades/FacadeLogin.php';
    require_once '../modelo/utilidades/Conexion.php';
    $facadeLogueado = new FacadeLogin;
    $paginas = $facadeLogueado->seguridadPaginas($_SESSION['rol']);
    $pagActual = 'listarUsuariosInactivos.php';
    $total = count($paginas);
    foreach ($paginas as $todas) {
        if ($pagActual != $todas['url']) {
            $total--;
        }
    }
    if ($total == 0) {
        header("location: ../index.php?error=No posee permisos para acceder a este directorio.");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Usuarios Inactivos</title>
        <meta charset="utf-8">
        <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="../css/reset.css">
        <link rel="stylesheet" type="text/css" href="../css/main_responsive.css">
        <script type="text/javascript" src="../js/jquery.js"></script>
        <script type="text/javascript" src="../js/carouFredSel.js"></script>
        <script type="text/javascript" src="../js/main.js"></script>
        <link rel="stylesheet" href="../js/jquery.dataTables.css">
        <script type="text/javascript" src="../js/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="../js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="../js/table.js"></script>
        <link rel="stylesheet" type="text/css" href="../fonts/fonts.css">
        <link href="../js/toastr.css" rel="stylesheet"/>
        <script src="../js/toastr.js"></script>
        <script src="../js/validaciones.js"></script>        
    </head>
    <body>
       <header>
            <?php
            require_once '../modelo/dao/LoginDAO.php';
            require_once '../modelo/dao/PermisosDAO.php';
            require_once '../modelo/utilidades/Conexion.php';
            require_once '../facades/FacadeLogin.php';
            require_once '../facades/FacadePermisos.php';
            $facadePermmisos = new FacadePermisos;
            $menuGeneral = $facadePermmisos->menuGeneral($_SESSION['rol']);
            $proyecto = $facadePermmisos->permisoProyecto($_SESSION['rol']);
            $novedad = $facadePermmisos->permisoNovedad($_SESSION['rol']);
            $persona = $facadePermmisos->permisoPersonal($_SESSION['rol']);
            $audita = $facadePermmisos->permisoAuditoria($_SESSION['rol']);
            $clientes = $facadePermmisos->permisoCliente($_SESSION['rol']);
            $roles = $facadePermmisos->permisoRoles($_SESSION['rol']);
            ?>       
            <div class="wrapper">
                <a href="../index.php"><img src="../img/logo.png" class="logo" id="lg" onLoad="nomeImagem()" width="190px" height="110px"></a>
                <a href="#" class="menu_icon" id="menu_icon"></a>
                <nav>
                    <div id="menu">
                        <ul>
                            <?php
                            foreach ($menuGeneral as $general) {
                                echo '<li class="nivel1"><a href="" class="nivel1">' . $general['nombreRuta'] . '<img src="../img/derecha.png"></a>';
                                if ($general['nombreRuta'] == 'Proyectos') {
                                    echo '<ul class="uno">';
                                    foreach ($proyecto as $pagina) {
                                        echo'<li><a href="' . $pagina['URL'] . '">' . $pagina['nombreRuta'] . '</a></li>';
                                    } echo '</ul></li>';
                                }
                                if ($general['nombreRuta'] == 'Novedades') {
                                    echo '<ul class="dos">';
                                    foreach ($novedad as $pagina) {
                                        echo'<li><a href="' . $pagina['URL'] . '">' . $pagina['nombreRuta'] . '</a></li>';
                                    } echo '</ul></li>';
                                }
                                if ($general['nombreRuta'] == 'Personal') {
                                    echo '<ul class="tres">';
                                    foreach ($persona as $pagina) {
                                        echo'<li><a href="' . $pagina['URL'] . '">' . $pagina['nombreRuta'] . '</a></li>';
                                    } echo '</ul></li>';
                                }
                                if ($general['nombreRuta'] == 'Auditorias') {
                                    echo '<ul class="cuatro">';
                                    foreach ($audita as $pagina) {
                                        echo'<li><a href="' . $pagina['URL'] . '">' . $pagina['nombreRuta'] . '</a></li>';
                                    } echo '</ul></li>';
                                }
                                if ($general['nombreRuta'] == 'Clientes') {
                                    echo '<ul class="cinco">';
                                    foreach ($clientes as $pagina) {
                                        echo'<li><a href="' . $pagina['URL'] . '">' . $pagina['nombreRuta'] . '</a></li>';
                                    } echo '</ul></li>';
                                }
                                if ($general['nombreRuta'] == 'Roles') {
                                    echo '<ul class="seis">';
                                    foreach ($roles as $pagina) {
                                        echo'<li><a href="' . $pagina['URL'] . '">' . $pagina['nombreRuta'] . '</a></li>';
                                    } echo '</ul></li>';
                                }
                            }
                            ?>               
                        </ul>
                    </div>
                </nav>
                <ul class="social">
                    <li><a class="fb" href="https://www.facebook.com/productivitymanager"></a></li>
                    <li><a class="twitter" href="https://twitter.com/Productivity_Mg"></a></li>
                    <li><a class="gplus" href="mailto:productivitymanagersoftware@gmail.com"></a></li>
                </ul>
                <div class="logoFoto">
                    <div><img src="../fotos/<?php echo $_SESSION['foto'];?>"></div>
                    <p style="text-align:right; font-size:12px; font-family: sans-serif; font-weight:bold; color: white"><br><br><br><br><br>
                        <?php
                        echo 'Bienvenido(a) ' . $_SESSION['nombre'];
                        ?>
                    </p>
                </div>
        </header>        
        <div class="wrapper">
           <nav style="float: right">            
                <ul id="navUser">                    
                    <li><a id="priOpc" title="Opciones de Usuario"><img id="menuUsuario" src="../img/menuUsuario.png"> Opciones</a>
                        <ul>
                            <li id="secOpc"><a href="modificarContrasena.php">Modificar Contraseña</a>                            
                            <li><a href="../controlador/ControladorLogin.php?idCerrar=HastaLuego">Cerrar Sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <nav class="migas"><br>
                <span itemscope >
                    <a href="../index.php" title="Ir a la página de inicio" itemprop="url"><span itemprop="title">Inicio</span></a>  > 
                    <span itemprop="child" itemscope>            
                        <strong>Usuarios Inactivos</strong> 
                    </span> 
                </span>         
            </nav>
            <br><br>
            <h2 class="h330">Usuarios Inactivos:</h2>
            <?php
        if (isset($_GET['modificado'])) {
            echo '<script> 
                Command: toastr["success"]("'.$_GET['modificado'].'", "Enhorabuena")
            toastr.options = {
              "closeButton": false,
              "debug": false,
              "newestOnTop": false,
              "progressBar": false,
              "positionClass": "toast-top-right",
              "preventDuplicates": false,
              "onclick": null,
              "showDuration": "300",
              "hideDuration": "1000",
              "timeOut": "5000",
              "extendedTimeOut": "1000",
              "showEasing": "swing",
              "hideEasing": "linear",
              "showMethod": "fadeIn",
              "hideMethod": "fadeOut"
            }
            </script>';
        };
        ?>
            <br>  
            <table id="tabla" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Código<br></th>                
                        <th>Identificación</th>
                        <th>Nombre</th>
                        <th>Apellido</th> 
                        <th>E-Mail</th>                           
                        <th>Tipo de Rol</th>                
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tfoot>
                    <tr>
                        <th>Código</th>                
                        <th>Identificación</th>
                        <th>Nombre</th>
                        <th>Apellido</th>  
                        <th>E-Mail</th>                           
                        <th>Tipo de Rol</th>                
                        <th>Acciones</th>
                    </tr>
                </tfoot>

                <tbody>   
<!--                <script>
                 Command: toastr["warning"]("Desea Eliminar Este Usuario?<br /><br /><button type='button'style='display:inline' class='btn clear'>Si</button><button type='button' style='display:inline' class='btn clear'>No</button>")
                toastr.options = {
                  "closeButton": false,
                  "debug": false,
                  "newestOnTop": false,
                  "progressBar": false,
                  "positionClass": "toast-top-right",
                  "preventDuplicates": false,
                  "onclick": null,
                  "showDuration": "300",
                  "hideDuration": "1000",
                  "timeOut": "5000",
                  "extendedTimeOut": "1000",
                  "showEasing": "swing",
                  "hideEasing": "linear",
                  "showMethod": "fadeIn",
                  "hideMethod": "fadeOut"
                }  
                </script>-->
<script>
    function confirmacion() {
                        if (confirm('Seguro que desea activar este usuario')) {
                            return true;
                        } else {
                            return false;
                        }
                    }
                </script>
                <?php
                require_once '../modelo/dto/UsuarioDTO.php';
                require_once '../modelo/dao/UsuarioDAO.php';          
                require_once '../facades/FacadeUsuarios.php';   
                require_once '../modelo/utilidades/Conexion.php';
                $facadeUsuario = new FacadeUsuarios;                 
                $todos = $facadeUsuario->listarUsuariosInactivos();                    
                foreach ($todos as $user) {
                    ?>
                    <tr><td><?php echo $user['idUsuario']; ?> </td>
                        <td><?php echo $user['identificacion']; ?> </td>
                        <td> <?php echo $user['nombres']; ?> </td>
                        <td><?php echo $user['apellidos']; ?></td>                      
                        <td><?php echo $user['email']; ?></td>  
                        <td><?php echo $user['rol']; ?></td>
                        <td>             
                            <a name="activar" title="Activar Usuario" class="me"  href="../controlador/ControladorUsuarios.php?idActivar=<?php echo $user['idUsuario']; ?>" onclick=" return confirmacion()"><img class="iconos" src="../img/darAltaUsuario.png"></a>                           
                    </tr>                         
                    <?php
                }
                if (isset($_GET['mensaje3'])) {
                    echo "<script>alert('" . $_GET['mensaje3'] . "')</script>";
                }
                ?>                      
                </tbody>
            </table>   
            <div id="verUsuario" class="modalDialog" title="Ver Usuario">
                <div><a href="#close" title="Cerrar" class="close">X</a><br>
                    <?php
                    echo '<table id="muestraDatos"><tr><th colspan="2">Datos de Usuario</th></tr>';
                    echo '<tr><td>Cargo:</td><td>' . $_GET['rol'] . '</td></tr>';
                    echo '<tr><td>Área/Sector:</td><td>' . $_GET['areaSector'] . '</td></tr>';
                    echo '<tr><td>Código:</td><td>' . $_GET['usuario'] . '</td></tr>';
                    echo '<tr><td>Identificación:</td><td> ' . $_GET['identificacion'] . '</td></tr>';
                    echo '<tr><td>Nombres:</td><td>' . $_GET['nombre'] . '</td></tr>';
                    echo '<tr><td>Apellidos:</td><td>' . $_GET['apellido'] . '</td></tr>';
                    echo '<tr><td>Dirección:</td><td>' . $_GET['direccion'] . '</td></tr>';
                    echo '<tr><td>Teléfono:</td><td>' . $_GET['telefono'] . '</td></tr>';
                    echo '<tr><td>Fecha de Nacimiento:</td><td>' . $_GET['fecha'] . '</td></tr>';
                    echo '<tr><td>Correo Electronico:</td><td>' . $_GET['email'] . '</td></tr>';
                    echo '<tr><td colspan="2" style="border:none"><button class="boton-verde"><a href="#">Asignar a Proyecto</a></button></td></tr>';
                    echo '</table>';
                    ?>                                
                </div>                    
            </div>
        </div>
        <footer class="footer-distributed">
            <div class="footer-left">
                            <span><img src="../img/logoEscala.png" width="210" height="120"></span>
                <p class="footer-links">
                                    <a href="../index.php">Inicio</a>
                    ·
                                        <a href="../nuestrosClientes.html">Clientes</a>
                                        ·
                                        <a href="../index.php">¿Quienes Somos?</a>                   
                    ·
                                        <a href="../contactecnos.html">Contacto</a>
                </p>
                <p class="footer-company-name">Productivity Manager &copy; 2015</p>
            </div>
            <div class="footer-center">
                <div>
                    <i class="fa fa-map-marker"></i>
                    <p><span>Calle 65 No 13 - 21</span> Bogotá, Colombia</p>
                </div>
                <div>
                    <i class="fa fa-phone"></i>
                    <p>+57 301 5782659</p>
                </div>
                <div>
                    <i class="fa fa-envelope"></i>
                    <p><a href="mailto:productivitymanagersoftware@gmail.com">productivitymanagersoftware@gmail.com</a></p>
                </div>
            </div>
            <div class="footer-right">
                <p class="footer-company-about">
                    <span>Productivity Manager</span>
                    Para aumentar la Productividad es absolutamente necesario incorporar a los mejores trabajadores
                </p>
                <div class="footer-icons">
                                    <a href="https://www.facebook.com/productivitymanager"><img src="../img/facebookFoot.png"></a>
                                    <a href="https://twitter.com/Productivity_Mg"><img src="../img/twitterFoot.png"></a>                 
                                    <a href="mailto:productivitymanagersoftware@gmail.com"></i><img src="../img/gmailFoot.png"></a>
                </div>
            </div>
        </footer>   
    </body>
</html>
