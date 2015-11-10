<?php
session_start();
require_once '../modelo/utilidades/Session.php';
$pagActual = 'informacionProyecto.php';
$session = new Session($pagActual);
$session->Session($pagActual);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Información de Proyecto</title>
        <meta charset="utf-8">
        <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="../css/reset.css">
        <link rel="stylesheet" type="text/css" href="../css/main_responsive.css">                
        <script type="text/javascript" src="../js/jquery.js"></script>
        <link href="../js/toastr.css" rel="stylesheet"/>
        <script src="../js/toastr.js"></script>
        <script src="../js/validaciones.js"></script>
        <link rel="stylesheet" type="text/css" href="../fonts/fonts.css">
        <link rel="stylesheet" href="../css/colorbox.css">
        <script src="../js/modalJS.min.js"></script>
        <script src="../js/jquery.colorbox.js"></script>
        <script  src="../js/scriptModales.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/infoProject.css">
    </head>    
    <body>         
        <div class="wrapper">              
            <?php if (isset($_GET['projectNum'])) { ?>
                <h2 class="h330"><br>Proyecto <?php echo $_GET['projectNum'] . "-" . $_GET['nameProject']; ?>:</h2><br>                
                <p class="obligatorios">Los campos marcados con asterisco ( </p><p class="obligatoriosD"> ) son obligatorios.</p><br><br>
                <form class="formRegistro" method="post" action="../controlador/ControladorProyectos.php">             
                    <hr>
                    <div class="modelo">
                        <label class="tag" id="labelProyecto" for="id"><span id="lab_valCountry" class="h331">Código Proyecto:</span></label>
                        <input class="input" name="idProyecto" type="text" maxlength="64" value="0<?php echo $_GET['projectNum']; ?>" id="id" style="text-align: center" class="field1" autofocus readonly required>
                        <label class="tag" id="labelProyecto" for="name"><span id="lab_valCountry" class="h331">Nombre Proyecto:</span></label>
                        <input class="input" name="nombreProyecto" type="text" maxlength="64" value="<?php echo $_GET['nameProject']; ?>" id="name" style="text-align: center" class="field1" autofocus readonly required>
                    </div>                   
                    <br>        
                    <div>
                <?php
                require_once '../modelo/dao/ProyectosDAO.php';
                require_once '../facades/FacadeProyectos.php';
                //  Consultar Proyecto
                if (isset($_GET['projectNum'])) {
                    $facadeProyecto = new FacadeProyectos;
                    $proyectos = $facadeProyecto->consultarProyecto($_GET['projectNum']);                                
                    echo '<div id="infoPro">';
                    echo '<table id="muestraDatos"><tr><th colspan="2">Información de Proyecto</th></tr>';
                    echo '<tr><td class="enunciado">Código:</td><td>0' . $proyectos['idProyecto'] . '</td></tr>';
                    echo '<tr><td class="enunciado">Nombre:</td><td>' . $proyectos['nombreProyecto'] . '</td></tr>';
                    echo '<tr><td class="enunciado">Fecha Inicio:</td><td>' . $proyectos['fechaInicio'] . '</td></tr>';
                    echo '<tr><td class="enunciado">Fecha Fin:</td><td> ' . $proyectos['fechaFin'] . '</td></tr>';
                    echo '<tr><td class="enunciado">Estado:</td><td>' . $proyectos['estadoProyecto'] . '</td></tr>';
                    echo '<tr><td class="enunciado">Ejecutado:</td><td>' . $proyectos['ejecutado'] . '%</td></tr>';
                    echo '<tr><td class="enunciado">Observaciones:</td><td>' . $proyectos['observaciones'] . '</td></tr>';
                    echo '<tr><td class="enunciado">Opciones:</td><td><a class="me" title="Modificar Proyecto" href="modificarProyecto.php?idProject=' . $proyectos['idProyecto'] . '"><img class="iconos" src="../img/modify.png"></a>';
                    $comi = "'";
                    if ($proyectos['estadoProyecto'] == 'Sin Estudio Costos') {
                        echo '<a class="me" title="Generar Estudio de Costos" href="javascript:estudioCostos(' . $comi . 'estudioDeCostos.php?projectNum=' . $proyectos['idProyecto'] . '&nameProject=' . $proyectos['nombreProyecto'] . $comi . ');"><img class="iconos" src="../img/costos.png"></a>';
                    }elseif ($proyectos['estadoProyecto'] == 'Sin Produccion') {
                        echo '<a class="me" title="Incluir Producción" href="javascript:produccionProyecto('. $comi .'produccionProyecto.php?projectNum='. $proyectos['idProyecto'].'&nameProject='.$proyectos['nombreProyecto'] . $comi . ');"><img class="iconos" src="../img/products.png"></a>';
                        
                    }
                    require_once '../facades/FacadeProyectos.php';
                    require_once '../modelo/dao/ProyectosDAO.php';
                    require_once '../modelo/utilidades/Conexion.php';
                    $facadeProyecto = new FacadeProyectos;
                    $clie = $facadeProyecto->clienteAsignado($proyectos['idProyecto']);
                    echo '<tr><td>Logo Compañia:</td><td><img src="../fotos/' . $clie['foto'] . '" class="logoEmpresarial"></td></tr>';
                    echo '</table>';
                    echo '</div><div id="infoClient">';
                    echo '<table id="muestraDatos"><tr><th colspan="2">Datos de Cliente</th></tr>';
                    echo '<tr><td class="enunciado">Código:</td><td>' . $clie['idCliente'] . '</td></tr>';
                    echo '<tr><td class="enunciado">Empresa:</td><td>' . $clie['nombreCompania'] . '</td></tr>';
                    echo '<tr><td class="enunciado">NIT:</td><td>' . $clie['nit'] . '</td></tr>';
                    echo '<tr><td class="enunciado">Sector Empresarial:</td><td>' . $clie['sectorEmpresarial'] . '</td></tr>';
                    echo '<tr><td class="enunciado">Sector Económico:</td><td>' . $clie['sectorEconomico'] . '</td></tr>';
                    echo '<tr><td class="enunciado">PBX:</td><td>' . $clie['telefonoFijo'] . '</td></tr>';
                    echo '<tr><td colspan="2" style="text-align:center">Representante Legal</td></tr>';
                    echo '<tr><td class="enunciado">Identificación:</td><td> ' . $clie['identificacion'] . '</td></tr>';
                    echo '<tr><td class="enunciado">Nombre:</td><td>' . $clie['nombre'] . '</td></tr>';
                    echo '<tr><td class="enunciado">Dirección:</td><td>' . $clie['direccion'] . '</td></tr>';
                    echo '<tr><td class="enunciado">Teléfono:</td><td>' . $clie['telefono'] . '</td></tr>';
                    echo '<tr><td class="enunciado">Correo Electronico:</td><td>' . $clie['email'] . '</td></tr>';
                    echo '</table>';
                    echo '</div><div id="infoGere">';
                    $pro = $facadeProyecto->gerenteDeProyecto($proyectos['idProyecto']);
                    echo '<table id="muestraDatos"><tr><th colspan="2">Gerente Encargado</th></tr>';
                    echo '<tr><td class="enunciado">Código Gerente:</td><td>' . $pro['idUsuario'] . '</td></tr>';
                    echo '<tr><td class="enunciado">Nombre:</td><td>' . $pro['nombre'] . '</td></tr>';
                    echo '<tr><td class="enunciado">Fecha Inicio:</td><td>' . $pro['direccion'] . '</td></tr>';
                    echo '<tr><td class="enunciado">Fecha Fin:</td><td> ' . $pro['telefono'] . '</td></tr>';
                    echo '<tr><td class="enunciado">Estado:</td><td>' . $pro['email'] . '</td></tr>';
                    echo '<tr><td class="enunciado">Ejecutado:</td><td>' . $pro['nombreArea'] . '</td></tr>';
                    echo '</table>';
                    echo '</div>';                
                    }
                    ?>                                
                </div>
                    <?php foreach ($products as $imagenes) { ?>
                        <a style="display: none" class="group1" href="../productos/<?php echo $imagenes['fotoProducto']; ?>" title="Código 0<?php echo $imagenes['idProductos']; ?>"></a>
                    <?php } ?>
                    <br><br><br><br><br>
                    <div id="process"><p><a class='group1' href="../img/logo.png" title="Click En Siguiente"><img src="../img/products.png"></a></p>
                        <p class="obligatoriosD">Click Para Visualizar Los Productos</p>
                    </div>
                </div>              
            <?php } ?>
        </div>
    </body>
</html>
