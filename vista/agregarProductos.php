<?php
session_start();
require_once '../modelo/utilidades/Session.php';
$pagActual = 'agregarProductos.php';
$session = new Session($pagActual);
$session->Session($pagActual);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Agregar Productos</title>
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
    <link rel="stylesheet" href="../css/cargaPaginas.css">
    </head>
    <body>
     <div id='cssmenu'>
        <form id="frmPicture" name="frmChangePicture" action="../controlador/ControladorUsuarios.php" method="post" enctype="multipart/form-data">
          <input type="hidden" name="Change" value="1">  
          <input type="file" id="filein" class="file" name="cambiaImagen" onchange="submit();" style="display:none">  
      </form>
        <ul>
            <!--   <li><a href='reportes.php'><span><i class="fa fa-file-text fa-lg"></i> Reportes</span></a></li> -->
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
           <?php if (isset($_GET['errorPermiso'])) { ?>
            <script language="JavaScript" type="text/javascript">
                window.onload = function () {
                    Command: toastr["error"]("<?php echo $_GET['errorPermiso']; ?>")

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
            <nav class="migas"><br>
                <span itemscope >
                    <a href="../index.php" title="Ir a la página de inicio" itemprop="url"><span itemprop="title">Inicio</span></a>  > 
                    <span itemprop="child" itemscope>  
                        <a href="agregarProducto.php" title="Ir a Usuarios" itemprop="url">
                            <span itemprop="title">Productos</span>              
                        </a>  > 
                        <strong>Agregar Producto</strong>
                    </span> 
                </span>         
            </nav>
            <div id="panelDer">
                  <div id="panelModificaPass">   
                    <br><br><br>                     
                        <?php
                    require_once '../facades/FacadeProductos.php';
                    require_once '../modelo/dao/ProductosDAO.php';
                    require_once '../modelo/dto/ProductosDTO.php';
                    $pDTO = new ProductosDTO();
                    $facadeProductos = new FacadeProductos();
                    $todos=$facadeProductos->listarProductos();
                  if ($todos==Array()) {
                      echo "<h2 class='h330'>No Existen Productos</h2>";
                    ?> 
                        <div class="container">
                          <div class="gearbox">
                          <div class="overlay"></div>
                            <div class="gear one">
                              <div class="gear-inner">
                                <div class="bar"></div>
                                <div class="bar"></div>
                                <div class="bar"></div>
                              </div>
                            </div>
                            <div class="gear two">
                              <div class="gear-inner">
                                <div class="bar"></div>
                                <div class="bar"></div>
                                <div class="bar"></div>
                              </div>
                            </div>
                            <div class="gear three">
                              <div class="gear-inner">
                                <div class="bar"></div>
                                <div class="bar"></div>
                                <div class="bar"></div>
                              </div>
                            </div>
                            <div class="gear four large">
                              <div class="gear-inner">
                                <div class="bar"></div>
                                <div class="bar"></div>
                                <div class="bar"></div>
                                <div class="bar"></div>
                                <div class="bar"></div>
                                <div class="bar"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                    <?php 
                  }else{   ?>              
                     <table id="muestraDatos" class="tableProducts" style="margin-top:50px">
                
                    <tr>
                       <th >Código</th>
                      <th>Producto</th>
                     <th >Estado</th>
                       <th  >Acciones</th>
                    </tr>
                
                <?php 
                  foreach ($todos as $unit) {
                            ?> 
                        
                            <tr>
                                <td style="width:90px">0<?php echo $unit['idProductos']; ?></td>
                                <td style="width:150px"> <?php echo $unit['nombreProducto']; ?></td>
                                <td style="width:80px"> <?php echo $unit['estadoProducto']; ?></td>
                                <td style="text-align:left"> <a name="visualizarProducto" title="Ver Producto" class="me"  href="../controlador/ControladorProductos.php?idVisualizar=<?php echo $unit['idProductos']; ?>" onclick=" return confirmacion()" ><img class="iconos" src="../img/ojo.png"></a>
                                <a name="InsumosProducto" title="Asociar Materia Prima del Producto" class="me"  href="../controlador/ControladorProductos.php?$idIParaInsumos=<?php echo $unit['idProductos']; ?>" onclick=" return confirmacion()" ><img class="iconos" src="../img/insumoProducto.png"></a>
                                
                                <?php
                                    if ($unit['estadoProducto'] == 'Sin Procesos' ){
                                 ?>   
                                <a name="AsociarProceso" title=" Asociar Proceso " class="me"  href="../vista/agregarProcesos.php?idProducto=<?php echo $unit['idProductos']; ?>&nombreProducto=<?php echo $unit['nombreProducto']; ?>" onclick=" return confirmacion()" ><img class="iconos" src="../img/work.png"></a>
                               <?php }
                                 ?> 
                               </td>       

                            </tr>
                        
                            <?php
                        }
                    }
                        ?>    
                    </table>
                    
                    <?php
                         
                $consecutivo=$facadeProductos->consecutivoProducto();
                $estado = $pDTO->getEstado();
               
                ?>
            </div>
            </div>
            <div id="panelIzq">
            <div style="text-align:right;font-weight:bold;padding-right:10px">
                <form method="post" action="../controlador/ControladorProductos.php" enctype="multipart/form-data">
                    <label  class="obligatoriosD">Cargue un archivo con sus Productos : </label>
                    <a id="loadArchivo" href="javascript:function()"><img src="../img/subirDatos.png" alt=""></a>
                    <input type="hidden" name="Change" value="1">  
          <input type="file" id="ArchivoProductos" class="file" name="archivo" onchange="submit();" style="display:none">                 
            </form></div><hr>            
            <script type="text/javascript">
            //bind click
            $('#loadArchivo').click(function(event) {
              $('#ArchivoProductos').click();
            });
        </script>               
               <h2 class="h330">Agregar Productos:</h2><hr>
                <p class="obligatorios">Los campos marcados con asterisco ( </p><p class="obligatoriosD"> ) son obligatorios.</p><br><br>
                <form class="formRegistro" method="post" action="../controlador/ControladorProductos.php" enctype="multipart/form-data"> 
               
                    
                <br>  
                    <label class="tag" id="IdRol" for="IdProducto"><span id="NameRol" class="h331" style="display: inline-block">Producto Número: </span></label>
                    <input class="input" style="text-align: center" name="IdProducto" type="text" id="IdArea" required readonly value="0<?php echo $consecutivo?>" style="display: inline-block"><br> 
                    <label class="tag" for="txtName"><span id="lab_valName" class="h331" style="display: inline-block">Nuevo Producto: </span></label>
                    <input class="input" name="Producto" type="text" id="txtName"  placeholder="Silla"   style="display: inline-block" required><br>
                    <label class="tag" for="txtName"><span id="lab_valName" class="h331" style="display: inline-block">Imagen: </span></label>
                    <input class="input" name="Imagen" type="file"  id="imagen"  style="display:inline-block" required><br>
                    <label class="tag" for="txtName"><span id="lab_valName" class="h331" style="display: inline-block">% Ganancia: </span></label>
                    <input class="input" name="ganancia"  id="txtName"  type="number" style="display: inline-block" min="1" required=""><br>
                    <label class="tag" for="txtName"><span id="lab_valName" class="h331" style="display: inline-block">Descripción: </span></label>
                    <textarea class="input4" name="descripcion"  id="txtName"  style="display: inline-block" required></textarea><br>
                    
                    
                    <button type="submit" value="Enviar" name="AgregarProducto" id="Areas" class="boton-verde">Agregar Producto</button>
                    
                 
                    <hr>
                </form><br>
                
                <div id="ModalImagen" class="modalDialog" title="ModalImagen">
                    <div>
                        <a href="#close" title="Close" class="close">X</a><br>					
                        <h2 class="h330"><?php echo $_SESSION['VisualizarProducto']['nombreProducto']; ?> :</h2><br>
                        <div >
                            <img src="../productos/<?php echo $_SESSION['VisualizarProducto']['fotoProducto']; ?>" onLoad="nomeImagem()" style=" width: 190 px; height: 110px" >
                            <div style="width:250px;height:180px;;float:right;margin-right:5%">
                                <table id="muestraDatos">
                                <tr>
                                    <td>Código</td>
                                    <td>0<?php  echo $_SESSION['VisualizarProducto']['idProductos']; ?></td>
                                </tr> <tr>
                                    <td>Estado</td>
                                    <td><?php  echo $_SESSION['VisualizarProducto']['estadoProducto']; ?></td>
                                </tr> <tr>
                                    <td>Descripción</td>
                                    <td ><?php  echo $_SESSION['VisualizarProducto']['descripcionProducto']; ?></td>
                                </tr>
                    
                              </table>
                            </div>
                        </div>
                    </div>
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

<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

