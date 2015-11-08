<?php
session_start();
require_once '../modelo/utilidades/Session.php';
$pagActual = 'produccionProyecto.php';
$session = new Session($pagActual);
$session->Session($pagActual);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Estudio de Costos</title>
        <meta charset="utf-8">
        <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="../css/reset.css">
        <link rel="stylesheet" type="text/css" href="../css/main_responsive.css">                
        <script type="text/javascript" src="../js/jquery.js"></script>
        <link href="../js/toastr.css" rel="stylesheet"/>
        <script src="../js/toastr.js"></script>
        <script src="../js/validaciones.js"></script>
        <link rel="stylesheet" type="text/css" href="fonts/fonts.css">
        <link rel="stylesheet" href="../css/colorbox.css">
        <script src="../js/modalJS.min.js"></script>
        <script src="../js/jquery.colorbox.js"></script>
        <script  src="../js/scriptModales.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/tablaInModal.css">
    </head>    
    <body>  
        <?php
        if (isset($_GET['mensaje'])) {
            echo '<script> 
                Command: toastr["success"]("'.$_GET['mensaje'].'", "Enhorabuena")
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
            function cierra(){
            window.close();
            }
            setTimeout("cierra()",3000)
            </script>';
        };
        ?> 
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
        <div class="wrapper">   
            <?php if (isset($_GET['projectNum'])){?>
            <h2 class="h330"><br>Producción de Proyecto <?php echo $_GET['projectNum'] . "-" . $_GET['nameProject']; ?>:</h2><br>                
            <p class="obligatorios">Los campos marcados con asterisco ( </p><p class="obligatoriosD"> ) son obligatorios.</p><br><br>
            <form class="formRegistro" method="post" action="../controlador/ControladorProyectos.php">             
                <hr>
                <div class="modelo">
                    <label class="tag" id="labelProyecto" for="id"><span id="lab_valCountry" class="h331">Código Proyecto:</span></label>
                    <input class="input" name="idProyecto" type="text" maxlength="64" value="<?php echo $_GET['projectNum']; ?>" id="id" style="text-align: center" class="field1" autofocus readonly required>
                    <label class="tag" id="labelProyecto" for="name"><span id="lab_valCountry" class="h331">Nombre Proyecto:</span></label>
                    <input class="input" name="nombreProyecto" type="text" maxlength="64" value="<?php echo $_GET['nameProject']; ?>" id="name" style="text-align: center" class="field1" autofocus readonly required>
                </div>                   
                <br>            
                <div >
                    <div id='inline_content' style='padding:10px; background:#fff;'>
                        <br><hr>
                        <strong><h2 class="h330">Productos:</h2></strong><br>                                
                        <p class="obligatoriosD">Selecione los productos segun requerimientos y su respectiva cantidad.</p><br>
                        <p class="obligatoriosD">Los campos "Cantidad" son obligatorios por cada Producto Seleccionado.<br></p>                                                               
                        <br><table class="tableSection">
                            <thead>
                                <tr>
                                    <th class="th1"><span class="text">Código</span>
                                    </th>
                                    <th class="th2"><span class="text">Nombre</span>
                                    </th>
                                    <th class="th3"><span class="text">Ganancia</span>
                                    </th>
                                    <th class="th4"><span class="text">Seleccionar</span>
                                    </th>                                
                                    <th class="th5"><span class="text">Cantidad</span>
                                    </th>
                                </tr>
                            </thead>                 
                            <tbody>                            
                                <?php
                                require_once '../facades/FacadeProductos.php';
                                require_once '../modelo/dao/ProductosDAO.php';
                                require_once '../modelo/utilidades/Conexion.php';
                                $facadeProductos = new FacadeProductos;
                                $products = $facadeProductos->listarProductosActivos();
                                foreach ($products as $productos) {
                                    ?>
                                    <tr>
                                        <td class="td1">0<?php echo $productos['idProductos']; ?></td>
                                        <td class="td2"><?php echo $productos['nombreProducto']; ?></td>
                                        <td class="td3"><?php echo $productos['ganancia']; ?>%</td>
                                        <td class="td4"><input type="checkbox" name="producto<?php echo $productos['idProductos']; ?>" value="<?php echo $productos['idProductos']; ?>" ></td>
                                        <td class="td5"><input name="cantidad<?php echo $productos['idProductos']; ?>" type="number" maxlength="64" id="cantidadProducto"></td>
                                    </tr>                       
                                <?php }
                                ?>                               
                            </tbody>
                        </table>                               
                        <p style="text-align: right;margin-right: 5%;">
                            <label class="tag2" id="labelProyecto" for="id"><span id="lab_valCountry" class="h331">Productos Seleccionados:</span></label>
                            <input id="checkcount1" name="cantidadTipo" type="text" maxlength="64" style="text-align: center" required readonly>
                        </p>                              
                        <script>
                            var contador = function () {
                                var n = $("input:checked").length;
                                total = (n + (n === 1 ? " " : ""));
                                document.getElementById('checkcount1').value = total;
                            };
                            contador();
                            $("input[type=checkbox]").on("click", contador)</script>
                    </div>                
                </div>                
                      <?php  foreach ($products as $imagenes) {?>
                <a style="display: none" class="group1" href="../productos/<?php echo $imagenes['fotoProducto'];?>" title="Código 0<?php echo $imagenes['idProductos']; ?>"></a>
                      <?php  } ?>
                <hr><br><br><br><br><br>
                <div id="process"><p><a class='group1' href="../img/logo.png" title="Click En Siguiente"><img src="../img/products.png"></a></p>
                    <p class="obligatoriosD">Click Para Visualizar Los Productos</p>
                </div>
                <button type="submit" class="guardarDerecho" name="elementosProyecto">Guardar</button>
            </form>
            <div style="display: none">
                <div id='inline_content2' style='padding:10px; background:#fff;'>
                    <p><strong><h2 class="h330">Materia Prima</h2></strong></p>
                    <p class="obligatoriosD"><br>Selecione la materia prima segun los requerimientos de Cliente.<br></p>
                    <br><table class="tableSection">
                        <thead>
                            <tr>
                                <th class="th1"><span class="text">Código</span>
                                </th>
                                <th class="th2"><span class="text">Nombre</span>
                                </th>
                                <th class="th3"><span class="text">Consultar</span>
                                </th>
                                <th class="th4"><span class="text">Seleccionar</span>
                                </th>                                
                                <th class="th5"><span class="text">Cantidad</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>                            
                            <?php
                            require_once '../facades/FacadeInsumos.php';
                            require_once '../modelo/dao/InsumosDAO.php';
                            $facadeMateria = new FacadeInsumos();
                            $materias = $facadeMateria->listarInsumos();                           
                            ?>
                        <label class="tag" id="labelProyecto" for="listaProyecto"><span id="lab_valCountry" class="h331">Seleccione Materia Prima:</span></label>
                        <select class="input" id="listaProyecto" name="idProyecto" id="listaProyecto" autofocus class="list_menu" >                                                                                                                                                               
                            <?php
                            foreach ($materias as $materiaP) {
                                echo '<option value="' . $materiaP['numero'] . '">' . $materiaP['numero'] . '-' . $materiaP['nombre'];
                            }
                            ?></option>
                        </select>
        <?php foreach ($products as $productos) { ?>
                            <tr>
                                <td class="td1">0<?php echo $productos['idProductos']; ?></td>
                                <td class="td2"><?php echo $productos['nombreProducto']; ?></td>
                                <td class="td3"><?php echo $productos['ganancia']; ?>%</td>
                                <td class="td4"><?php echo $productos['ganancia']; ?>%</td>
                                <td class="td5"><?php echo $productos['ganancia']; ?>%</td>
                            </tr> 
                        <?php }
                        ?>                               
                        </tbody>
                    </table>                    
                </div>
            </div>              
            <?php }?>
        </div>        
    </body>
</html>
