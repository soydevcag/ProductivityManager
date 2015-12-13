<?php
session_start();
require_once '../modelo/utilidades/Session.php';
$pagActual = 'insumosPorProducto.php';
$session = new Session($pagActual);
$session->Session($pagActual);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Insumos por producto</title>
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
        <link rel="stylesheet" type="text/css" href="../css/stylesNavTop.css">
        <link rel="stylesheet" href="../css/font-awesome.min.css">
        <script type="text/javascript" src="../js/script.js"></script>
        <script type="text/javascript" src="../js/script2.js"></script>
        <link href="../js/toastr.css" rel="stylesheet"/>
        <script src="../js/toastr.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/component.css" />
    <script src="../js/modernizr.custom.js"></script>
    </head>
    <body>
     <div id='cssmenu'>
        <form id="frmPicture" name="frmChangePicture" action="../controlador/ControladorUsuarios.php" method="post" enctype="multipart/form-data">
          <input type="hidden" name="Change" value="1">  
          <input type="file" id="filein" class="file" name="cambiaImagen" onchange="submit();" style="display:none">  
      </form>
        <ul>
           <li><a href='reportes.php'><span><i class="fa fa-file-text fa-lg"></i> Reportes</span></a></li>
           <li class='active has-sub'><a id="priOpc"><span><i class="fa fa-cog fa-lg fa-spin"></i> Opciones</span></a>
              <ul>
                 <li><a href='modificarContrasena.php'><span><i class="fa fa-key fa-lg"></i> Cambiar Contraseña</span></a>       
                 </li>
                 <li><a id="loadImg" href="javascript:function()"><span><i class="fa fa-picture-o fa-lg"></i> Actualizar Foto</span></a>              
                 </li>
              </ul>
           </li>  
           <li><a href='../controlador/ControladorLogin.php?idCerrar=HastaLuego'><span><i class="fa fa-power-off fa-lg"></i> Cerrar Sesión</span></a></li>     
        </ul>
          <script type="text/javascript">
            //bind click
            $('#loadImg').click(function(event) {
              $('#filein').click();
            });
        </script>
    </div>    
        <header>                
            <div class="wrapper">
            <?php if (isset($_GET['mensaje'])) { ?>
            <script language="JavaScript" type="text/javascript">
                window.onload = function () {
                    Command: toastr["success"]("<?php echo $_GET['mensaje']; ?>")

                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-full-width",
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
                }
        <?php } ?>
        </script>
                <a href="../index.php"><img src="../img/logo.png" class="logo" id="lg" onLoad="nomeImagem()" width="190px" height="110px"></a>
                <a href="#" class="menu_icon" id="menu_icon"></a>
                <nav>
                            <?php
                            require_once '../modelo/utilidades/Menu.php';
                            $menu = new Menu;
                            $menu->permisosMenu();
                            ?>               
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

            </div>
        </header>        
        <div class="wrapper">
           
            <nav class="migas"><br>
                <span itemscope >
                    <a href="../index.php" title="Ir a la página de inicio" itemprop="url"><span itemprop="title">Inicio</span></a>  > 
                    <span itemprop="child" itemscope>  
                        <a href="CrearRol.php" title="Ir a Usuarios" itemprop="url">
                            <span itemprop="title">Insumos por producto</span>              
                        </a>  > 

                    </span> 
                </span>         
            </nav>

            <div id="panelUnico">
                <br>
                <br><h2 class="h330">Insumos Utilizados para <?php echo $_SESSION['Producto']['nombreProducto']?>:</h2><hr>
                <p class="obligatorios">Los campos marcados con asterisco ( </p><p class="obligatoriosD"> ) son obligatorios.</p><br><br>
                <form class="formRegistro" method="post" action="../controlador/ControladorProductos.php"> 
                    <?php
                    require_once '../modelo/dao/InsumosDAO.php';
                    require_once '../facades/FacadeInsumos.php';
                    require_once '../modelo/dao/ProductosDAO.php';
                    require_once '../facades/FacadeProductos.php';
                    // listar insumos
                    $facadeInsumos = new FacadeInsumos();
                    $fProductos = new FacadeProductos();
                    $insumos = $facadeInsumos->listarInsumos();
                    $idProducto= $_SESSION['Producto']['idProductos'];
                    //Obtener insumos por producto
                    $IxP= $facadeInsumos->obtenerInsumos($idProducto);
                    
                    
                    ?>
                    <input type="hidden" name="idProducto" value="<?php echo $idProducto;?>">
                    
                  
                    <label class="tag" id="Permisos" for="Permisos"><span id="permisos" class="h331">Insumos: </span></label>
                    <table style="margin-left:30%">
                        <?php
                        $_SESSION['cantInsumos']=0;
                        foreach ($insumos as $insumo) {
                            $_SESSION['cantInsumos']++;
                            $cantidadInsumos = $fProductos->cantidadPorInsumo($insumo['numero'], $idProducto);
                            ?>     
                            <tr>
                               
                                <td><input name="insumo" size="7" value ="<?php echo $insumo['nombre']; ?>" readonly></td>
                                <td><input style="width: 50px; text-align: center" name="cant<?php echo $insumo['numero']; ?>" id="cant<?php echo $insumo['numero']; ?>" type="text" value ="<?php echo $cantidadInsumos; ?>"></td>
                                <td><input style="width: 100px; text-align: center" name="medida" size="1" value ="<?php echo $insumo['unidad']; ?>" readonly ></td>
                                <td><input type="checkbox" id="insumo<?php echo $insumo['numero']; ?>" name="<?php echo $insumo['numero']; ?>" value="<?php echo $insumo['numero']; ?>"<?php 
                                foreach ( $IxP as $IxProducto){
                                        if (($insumo['numero']==$IxProducto["insumos"])) {                           
                                            echo 'checked="checked"';
                                }  } ?> />   </td>         
                               
                            </tr>
                                 <script>
                                        $(document).ready(function(){

                                            $("#insumo<?php echo $insumo['numero']; ?>").click(function() {
                                                if($("#insumo<?php echo $insumo['numero'];  ?>").is(':checked')) {
                                                    $("#cant<?php echo $insumo['numero']; ?>").attr("required", true);
                                                } else {
                                                    $("#cant<?php echo $insumo['numero']; ?>").attr("required", false);
                                                }
                                            });

                                        });
                                    </script>
                            <?php
                        }
                        if (isset($_GET['mensaje3'])) {
                            echo "<script>alert('" . $_GET['mensaje3'] . "')</script>";
                        }
                        ?>    
                    </table>
                    <button type="submit" value="Enviar" name="AsociarInsumos" id="crearRol" class="boton-verde" >Asignar Insumos</button>
                    
                    </form><hr>
                
                
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

<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

