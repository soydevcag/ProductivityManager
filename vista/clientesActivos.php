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
    $pagActual = 'clientesActivos.php';
    $total =count($paginas);
    foreach ($paginas as $todas) {
        if ($pagActual != $todas['url']) {
            $total--;
        }
    }
   if($total==0){
       header("location: ../index.php?error=No posee permisos para acceder a este directorio.");       
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Clientes Activos</title>
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
    <link href="../js/toastr.css" rel="stylesheet"/>
        <script src="../js/toastr.js"></script>
        <script src="../js/validaciones.js"></script>
        <link rel="stylesheet" type="text/css" href="fonts/fonts.css">
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
          <a href="listarUsuarios.html" title="Ir a Usuarios" itemprop="url">
           <span itemprop="title">Usuarios</span>              
                </a>  > 
            <strong>Lista de Clientes Activos</strong> 
                </span> 
            </span>         
        </nav>
    <br><br>
    <h2 class="h330">Clientes con Proyectos Activos:</h2>
     <?php
        if (isset($_GET['mensaje'])) {
            echo '<script> 
             Command: toastr["success"]("Con el Consecutivo: '.$_GET['consecutivo'].'", "'.$_GET['mensaje'].'")
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
        if (isset($_GET['modificaCliente'])) {
            echo '<script> 
             Command: toastr["success"]("'.$_GET['modificaCliente'].'")
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
        if (isset($_GET['mensajeFiltro'])) {
                echo '<script> 
                Command: toastr["info"]("' . $_GET['mensajeFiltro'] . '")
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
    <form name="filtro" class="formRegistro" action="../controlador/ControladorFiltros.php" method="POST">
        <div id="exports" style="float:right;padding-bottom:10px;">
                    <img src="../img/imprimir.png">
                    <img src="../img/email.png">
                    <img src="../img/pdf.png">
                    <a href='../ExportarClienteActivo.php'"><img src="../img/excel.png" title="Exportar a Exccel"></a></div>
	   <table id="tabla" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Código</th>                
                <th>NIT</th>
                <th>Compañia</th> 
                <th>Teléfono</th>
                <th>Sector Económico</th>                
                <th>Sector Empresarial</th> 
                <th>Acciones</th>
            </tr>
        </thead>
        <thead>
            <tr>                    
                <th><input tabindex="1" type="text" class="input11" name="idClient" value=""></th>                
                <th><input tabindex="2" type="text" class="input11" name="nit" value=""></th>
                <th><input tabindex="3" type="text" class="input11" name="names" value=""></th>
                <th><input tabindex="4" type="text" class="input11" name="phone" value=""><br></th> 
                <th><input tabindex="5" type="text" class="input11" name="secEco" value=""></th> 
                <th><input tabindex="6" type="text" class="input11" name="secEmp" value=""></th>                
                <th><button tabindex="6" type="submit" value="buscarActivos" name="buscarActivos" id="buscar" class="boton-verde">Buscar</button></th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Código</th>                
                <th>NIT</th>
                <th>Compañia</th> 
                <th>Teléfono</th>                                           
                <th>Sector Económico</th>                
                <th>Sector Empresarial</th> 
                <th>Acciones</th>
            </tr>
        </tfoot>
 
        <tbody>
           <script>
                    function confirmacion() {
                        if (confirm('Seguro que desea desactivar este Cliente')) {
                            return true;
                        } else {
                            return false;
                        }
                    }
                </script>
                <?php
                    if (isset($_GET['busquedaActivos'])) {
                        if (empty($_SESSION['filtroActivos'])) {
                            $_SESSION['filtroActivos'] = '';
                        } else {
                            $_SESSION['consultaActivos']=$_SESSION['filtroActivos'];
                            foreach ($_SESSION['filtroActivos'] as $user) {
                                ?>
                <tr><td><?php echo $user['idUsuario']; ?> </td>
                        <td><?php echo $user['nit']; ?> </td>
                        <td> <?php echo $user['nombreCompania']; ?> </td>
                        <td><?php echo $user['telefonoFijo']; ?></td>                      
                        <td><?php echo $user['sectorEconomico']; ?></td>  
                        <td><?php echo $user['sectorEmpresarial']; ?></td>
                        <td>
                            <a class="me" title="Consultar / Asignar a Proyecto" href="../controlador/ControladorClientes.php?idConsultarCliente=<?php echo $user['idUsuario']; ?>"><img class="iconos" src="../img/verBino.png"></a>                
                            <a class="me" title="Actualizar Cliente" href="modificarCliente.php?idCliente=<?php echo $user['idUsuario']; ?>"><img class="iconos" src="../img/crearUsuario.png"></a>
                            <a title="Desactivar Cliente" class="me"  href="../controlador/ControladorClientes.php?idDesactivarCliente=<?php echo $user['idUsuario']; ?>" onclick=" return confirmacion()"><img class="iconos" src="../img/desactivarUsuario.png"></a></td>                   
                    </tr>                         
                    <?php
                    }
                   }
                  }else{
                require_once '../modelo/dto/UsuarioDTO.php';
                require_once '../modelo/dao/UsuarioDAO.php';
                require_once '../modelo/dto/ClienteDTO.php';
                require_once '../modelo/dao/ClienteDAO.php';
                require_once '../facades/FacadeUsuarios.php';
                require_once '../facades/FacadeCliente.php';
                require_once '../modelo/utilidades/Conexion.php';               
                 $FacadeCliente = new FacadeCliente;
                $todos = $FacadeCliente->listadoClientesActivos();
                $_SESSION['consultaActivos']=$todos;
                foreach ($todos as $user) {
                    ?>
                    <tr><td><?php echo $user['idUsuario']; ?> </td>
                        <td><?php echo $user['nit']; ?> </td>
                        <td> <?php echo $user['nombreCompania']; ?> </td>
                        <td><?php echo $user['telefonoFijo']; ?></td>                      
                        <td><?php echo $user['sectorEconomico']; ?></td>  
                        <td><?php echo $user['sectorEmpresarial']; ?></td>
                        <td>
                            <a class="me" title="Consultar / Asignar a Proyecto" href="../controlador/ControladorClientes.php?idConsultarCliente=<?php echo $user['idUsuario']; ?>"><img class="iconos" src="../img/verBino.png"></a>                
                            <a class="me" title="Actualizar Cliente" href="modificarCliente.php?idCliente=<?php echo $user['idUsuario']; ?>"><img class="iconos" src="../img/crearUsuario.png"></a>
                            <a title="Desactivar Cliente" class="me"  href="../controlador/ControladorClientes.php?idDesactivarCliente=<?php echo $user['idUsuario']; ?>" onclick=" return confirmacion()"><img class="iconos" src="../img/desactivarUsuario.png"></a></td>                   
                    </tr>                         
                    <?php
                  }                  
                }               
                ?>                      
                </tbody>
            </table>   
        </form>
            <div id="verUsuario" class="modalDialog" title="Ver Usuario">
                <div><a href="#close" title="Cerrar" class="close">X</a><br>
                    <?php
                    echo '<table id="muestraDatos"><tr><th colspan="2">Datos de Cliente</th></tr>';
                    echo '<tr><td>Código:</td><td>' . $_GET['usuario'] . '</td></tr>';
                    echo '<tr><td>Empresa:</td><td>' . $_GET['empresa'] . '</td></tr>';
                    echo '<tr><td>NIT:</td><td>' . $_GET['nit'] . '</td></tr>';
                    echo '<tr><td>Sector Empresarial:</td><td>' . $_GET['secEmp'] . '</td></tr>';
                    echo '<tr><td>Sector Económico:</td><td>' . $_GET['secEco'] . '</td></tr>';
                    echo '<tr><td>PBX:</td><td>' . $_GET['pbx'] . '</td></tr>';                   
                    echo '<tr><td colspan="2" style="text-align:center">Representante Legal</td></tr>'; 
                    echo '<tr><td>Identificación:</td><td> ' . $_GET['identificacion'] . '</td></tr>';
                    echo '<tr><td>Nombres:</td><td>' . $_GET['nombre'] . '</td></tr>';
                    echo '<tr><td>Apellidos:</td><td>' . $_GET['apellido'] . '</td></tr>';
                    echo '<tr><td>Dirección:</td><td>' . $_GET['direccion'] . '</td></tr>';
                    echo '<tr><td>Teléfono:</td><td>' . $_GET['telefono'] . '</td></tr>';
                    echo '<tr><td>Correo Electronico:</td><td>' . $_GET['email'] . '</td></tr>';
                    echo '<tr><td>Estado:</td><td>' . $_GET['estado'] . '</td></tr>';
                    echo '<tr><td>Logo Compañia:</td><td><img src="../fotos/'.$_GET['foto'].'" class="logoEmpresarial"></td></tr>';
                    echo '<tr><td colspan="2" style="border:none"><button class="boton-verde">';
                    echo '<a style="text-decoration:none;padding:10px 20px 10px 20px;" href="crearProyecto.php?codCliente='.$_GET['usuario'].'&empresa='.$_GET['empresa'].'">Crear Nuevo Proyecto</a></button></td></tr>';
                    echo '</table>';
                    ?>                                
                </div>                    
            </div>
    <button class="boton-verde"  onclick="location.href='clientesActivos.php'" >Actualizar Lista</button>    
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
