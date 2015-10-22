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
    $pagActual = 'registrarUsuario.php';
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
        <title>Registrar Usuario</title>
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
           <script>
            $(document).ready(function () {
                $("#selectrol").on("change", function () {
                    $.ajax({
                        url: "../peticiones_ajax/ajax_listar_areas.php",
                        method: "POST",
                        data: {
                            idRolSelected: $(this).val(),
                            accion: "listarAreas"
                        },
                        success: function (data) {
                            $("#selectArea").html(data);
                        },
                        error: function (error) {
                            alert(error);
                        }
                    });
                    //alert($(this).val());
                });
            });
        </script>
    </head>
    <body>
        <header>          
            <div class="wrapper">
                <a href="../index.php"><img src="../img/logo.png" class="logo" id="lg" onLoad="nomeImagem()" width="190px" height="110px"></a>
                <a href="#" class="menu_icon" id="menu_icon"></a>
                 <nav>
                    <div id="menu">
                        <ul>
                            <?php
                            require_once './Menu.php';
                            $menu = new Menu;
                            $menu->permisosMenu();
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
                    <div><img src="../fotos/<?php echo $_SESSION['foto']; ?>"></div>
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
                        <strong>Crear Nuevo Usuario</strong> 
                    </span> 
                </span>         
            </nav>
            <div id="panelIzq">
                <script>
                    // Run the code when the DOM is ready
                    $(pieChart);
                    function pieChart() {

                        // Config settings
                        var chartSizePercent = 55;                        // The chart radius relative to the canvas width/height (in percent)
                        var sliceBorderWidth = 1;                         // Width (in pixels) of the border around each slice
                        var sliceBorderStyle = "#fff";                    // Colour of the border around each slice
                        var sliceGradientColour = "#ddd";                 // Colour to use for one end of the chart gradient
                        var maxPullOutDistance = 25;                      // How far, in pixels, to pull slices out when clicked
                        var pullOutFrameStep = 4;                         // How many pixels to move a slice with each animation frame
                        var pullOutFrameInterval = 40;                    // How long (in ms) between each animation frame
                        var pullOutLabelPadding = 65;                     // Padding between pulled-out slice and its label  
                        var pullOutLabelFont = "bold 16px 'Trebuchet MS', Verdana, sans-serif";  // Pull-out slice label font
                        var pullOutValueFont = "bold 12px 'Trebuchet MS', Verdana, sans-serif";  // Pull-out slice value font
                        var pullOutValuePrefix = "";                     // Pull-out slice value prefix
                        var pullOutShadowColour = "rgba( 0, 0, 0, .5 )";  // Colour to use for the pull-out slice shadow
                        var pullOutShadowOffsetX = 5;                     // X-offset (in pixels) of the pull-out slice shadow
                        var pullOutShadowOffsetY = 5;                     // Y-offset (in pixels) of the pull-out slice shadow
                        var pullOutShadowBlur = 5;                        // How much to blur the pull-out slice shadow
                        var pullOutBorderWidth = 2;                       // Width (in pixels) of the pull-out slice border
                        var pullOutBorderStyle = "#333";                  // Colour of the pull-out slice border
                        var chartStartAngle = -.5 * Math.PI;              // Start the chart at 12 o'clock instead of 3 o'clock

                        // Declare some variables for the chart
                        var canvas;                       // The canvas element in the page
                        var currentPullOutSlice = -1;     // The slice currently pulled out (-1 = no slice)
                        var currentPullOutDistance = 0;   // How many pixels the pulled-out slice is currently pulled out in the animation
                        var animationId = 0;              // Tracks the interval ID for the animation created by setInterval()
                        var chartData = [];               // Chart data (labels, values, and angles)
                        var chartColours = [];            // Chart colours (pulled from the HTML table)
                        var totalValue = 0;               // Total of all the values in the chart
                        var canvasWidth;                  // Width of the canvas, in pixels
                        var canvasHeight;                 // Height of the canvas, in pixels
                        var centreX;                      // X-coordinate of centre of the canvas/chart
                        var centreY;                      // Y-coordinate of centre of the canvas/chart
                        var chartRadius;                  // Radius of the pie chart, in pixels

                        // Set things up and draw the chart
                        init();

                        /**
                         * Set up the chart data and colours, as well as the chart and table click handlers,
                         * and draw the initial pie chart
                         */

                        function init() {

                            // Get the canvas element in the page
                            canvas = document.getElementById('chart');

                            // Exit if the browser isn't canvas-capable
                            if (typeof canvas.getContext === 'undefined')
                                return;

                            // Initialise some properties of the canvas and chart
                            canvasWidth = canvas.width;
                            canvasHeight = canvas.height;
                            centreX = canvasWidth / 2;
                            centreY = canvasHeight / 2;
                            chartRadius = Math.min(canvasWidth, canvasHeight) / 2 * (chartSizePercent / 100);

                            // Grab the data from the table,
                            // and assign click handlers to the table data cells

                            var currentRow = -1;
                            var currentCell = 0;

                            $('#chartData td').each(function () {
                                currentCell++;
                                if (currentCell % 2 != 0) {
                                    currentRow++;
                                    chartData[currentRow] = [];
                                    chartData[currentRow]['label'] = $(this).text();
                                } else {
                                    var value = parseFloat($(this).text());
                                    totalValue += value;
                                    value = value.toFixed(2);
                                    chartData[currentRow]['value'] = value;
                                }

                                // Store the slice index in this cell, and attach a click handler to it
                                $(this).data('slice', currentRow);
                                $(this).click(handleTableClick);

                                // Extract and store the cell colour
                                if (rgb = $(this).css('color').match(/rgb\((\d+), (\d+), (\d+)/)) {
                                    chartColours[currentRow] = [rgb[1], rgb[2], rgb[3]];
                                } else if (hex = $(this).css('color').match(/#([a-fA-F0-9]{2})([a-fA-F0-9]{2})([a-fA-F0-9]{2})/)) {
                                    chartColours[currentRow] = [parseInt(hex[1], 16), parseInt(hex[2], 16), parseInt(hex[3], 16)];
                                } else {
                                    alert("Error: Colour could not be determined! Please specify table colours using the format '#xxxxxx'");
                                    return;
                                }

                            });

                            // Now compute and store the start and end angles of each slice in the chart data

                            var currentPos = 0; // The current position of the slice in the pie (from 0 to 1)

                            for (var slice in chartData) {
                                chartData[slice]['startAngle'] = 2 * Math.PI * currentPos;
                                chartData[slice]['endAngle'] = 2 * Math.PI * (currentPos + (chartData[slice]['value'] / totalValue));
                                currentPos += chartData[slice]['value'] / totalValue;
                            }

                            // All ready! Now draw the pie chart, and add the click handler to it
                            drawChart();
                            $('#chart').click(handleChartClick);
                        }

                        /**
                         * Process mouse clicks in the chart area.
                         *
                         * If a slice was clicked, toggle it in or out.
                         * If the user clicked outside the pie, push any slices back in.
                         *
                         * @param Event The click event
                         */

                        function handleChartClick(clickEvent) {

                            // Get the mouse cursor position at the time of the click, relative to the canvas
                            var mouseX = clickEvent.pageX - this.offsetLeft;
                            var mouseY = clickEvent.pageY - this.offsetTop;

                            // Was the click inside the pie chart?
                            var xFromCentre = mouseX - centreX;
                            var yFromCentre = mouseY - centreY;
                            var distanceFromCentre = Math.sqrt(Math.pow(Math.abs(xFromCentre), 2) + Math.pow(Math.abs(yFromCentre), 2));

                            if (distanceFromCentre <= chartRadius) {

                                // Yes, the click was inside the chart.
                                // Find the slice that was clicked by comparing angles relative to the chart centre.

                                var clickAngle = Math.atan2(yFromCentre, xFromCentre) - chartStartAngle;
                                if (clickAngle < 0)
                                    clickAngle = 2 * Math.PI + clickAngle;

                                for (var slice in chartData) {
                                    if (clickAngle >= chartData[slice]['startAngle'] && clickAngle <= chartData[slice]['endAngle']) {

                                        // Slice found. Pull it out or push it in, as required.
                                        toggleSlice(slice);
                                        return;
                                    }
                                }
                            }

                            // User must have clicked outside the pie. Push any pulled-out slice back in.
                            pushIn();
                        }


                        function handleTableClick(clickEvent) {
                            var slice = $(this).data('slice');
                            toggleSlice(slice);
                        }


                        function toggleSlice(slice) {
                            if (slice == currentPullOutSlice) {
                                pushIn();
                            } else {
                                startPullOut(slice);
                            }
                        }


                        function startPullOut(slice) {

                            // Exit if we're already pulling out this slice
                            if (currentPullOutSlice == slice)
                                return;

                            // Record the slice that we're pulling out, clear any previous animation, then start the animation
                            currentPullOutSlice = slice;
                            currentPullOutDistance = 0;
                            clearInterval(animationId);
                            animationId = setInterval(function () {
                                animatePullOut(slice);
                            }, pullOutFrameInterval);

                            // Highlight the corresponding row in the key table
                            $('#chartData td').removeClass('highlight');
                            var labelCell = $('#chartData td:eq(' + (slice * 2) + ')');
                            var valueCell = $('#chartData td:eq(' + (slice * 2 + 1) + ')');
                            labelCell.addClass('highlight');
                            valueCell.addClass('highlight');
                        }



                        function animatePullOut(slice) {

                            // Pull the slice out some more
                            currentPullOutDistance += pullOutFrameStep;

                            // If we've pulled it right out, stop animating
                            if (currentPullOutDistance >= maxPullOutDistance) {
                                clearInterval(animationId);
                                return;
                            }

                            // Draw the frame
                            drawChart();
                        }




                        function pushIn() {
                            currentPullOutSlice = -1;
                            currentPullOutDistance = 0;
                            clearInterval(animationId);
                            drawChart();
                            $('#chartData td').removeClass('highlight');
                        }


                        function drawChart() {

                            // Get a drawing context
                            var context = canvas.getContext('2d');

                            // Clear the canvas, ready for the new frame
                            context.clearRect(0, 0, canvasWidth, canvasHeight);

                            // Draw each slice of the chart, skipping the pull-out slice (if any)
                            for (var slice in chartData) {
                                if (slice != currentPullOutSlice)
                                    drawSlice(context, slice);
                            }

                            // If there's a pull-out slice in effect, draw it.
                            // (We draw the pull-out slice last so its drop shadow doesn't get painted over.)
                            if (currentPullOutSlice != -1)
                                drawSlice(context, currentPullOutSlice);
                        }


                        function drawSlice(context, slice) {

                            // Compute the adjusted start and end angles for the slice
                            var startAngle = chartData[slice]['startAngle'] + chartStartAngle;
                            var endAngle = chartData[slice]['endAngle'] + chartStartAngle;

                            if (slice == currentPullOutSlice) {

                                // We're pulling (or have pulled) this slice out.
                                // Offset it from the pie centre, draw the text label,
                                // and add a drop shadow.

                                var midAngle = (startAngle + endAngle) / 2;
                                var actualPullOutDistance = currentPullOutDistance * easeOut(currentPullOutDistance / maxPullOutDistance, .8);
                                startX = centreX + Math.cos(midAngle) * actualPullOutDistance;
                                startY = centreY + Math.sin(midAngle) * actualPullOutDistance;
                                context.fillStyle = 'rgb(' + chartColours[slice].join(',') + ')';
                                context.textAlign = "center";
                                context.font = pullOutLabelFont;
                                context.fillText(chartData[slice]['label'], centreX + Math.cos(midAngle) * (chartRadius + maxPullOutDistance + pullOutLabelPadding), centreY + Math.sin(midAngle) * (chartRadius + maxPullOutDistance + pullOutLabelPadding));
                                context.font = pullOutValueFont;
                                context.fillText(pullOutValuePrefix + chartData[slice]['value'] + " (" + (parseInt(chartData[slice]['value'] / totalValue * 100 + .5)) + "%)", centreX + Math.cos(midAngle) * (chartRadius + maxPullOutDistance + pullOutLabelPadding), centreY + Math.sin(midAngle) * (chartRadius + maxPullOutDistance + pullOutLabelPadding) + 20);
                                context.shadowOffsetX = pullOutShadowOffsetX;
                                context.shadowOffsetY = pullOutShadowOffsetY;
                                context.shadowBlur = pullOutShadowBlur;

                            } else {

                                // This slice isn't pulled out, so draw it from the pie centre
                                startX = centreX;
                                startY = centreY;
                            }

                            // Set up the gradient fill for the slice
                            var sliceGradient = context.createLinearGradient(0, 0, canvasWidth * .75, canvasHeight * .75);
                            sliceGradient.addColorStop(0, sliceGradientColour);
                            sliceGradient.addColorStop(1, 'rgb(' + chartColours[slice].join(',') + ')');

                            // Draw the slice
                            context.beginPath();
                            context.moveTo(startX, startY);
                            context.arc(startX, startY, chartRadius, startAngle, endAngle, false);
                            context.lineTo(startX, startY);
                            context.closePath();
                            context.fillStyle = sliceGradient;
                            context.shadowColor = (slice == currentPullOutSlice) ? pullOutShadowColour : "rgba( 0, 0, 0, 0 )";
                            context.fill();
                            context.shadowColor = "rgba( 0, 0, 0, 0 )";

                            // Style the slice border appropriately
                            if (slice == currentPullOutSlice) {
                                context.lineWidth = pullOutBorderWidth;
                                context.strokeStyle = pullOutBorderStyle;
                            } else {
                                context.lineWidth = sliceBorderWidth;
                                context.strokeStyle = sliceBorderStyle;
                            }

                            // Draw the slice border
                            context.stroke();
                        }


                        function easeOut(ratio, power) {
                            return (Math.pow(1 - ratio, power) + 1);
                        }

                    }
                    ;

                </script>              

                <table id="chartData">

                    <tr>
                        <th>Usuario</th><th>Cantidad</th>
                    </tr>

                    <tr style="color: #0DA068">
                        <td>Clientes</td><td>
                            <?php                           
                            require_once '../modelo/dto/ClienteDTO.php';
                            require_once '../modelo/dao/ClienteDAO.php';                           
                            require_once '../facades/FacadeCliente.php';
                            require_once '../facades/FacadeCreateRol.php';
                            require_once '../modelo/dao/CrearRolDAO.php';
                            require_once '../facades/FacadeUsuarios.php';
                            require_once '../modelo/dao/UsuarioDAO.php';
                            require_once '../modelo/utilidades/Conexion.php';
                            $facadeUsuario = new FacadeUsuarios;                                      
                            $FacadeCliente = new FacadeCliente;
                            $facadeRol = new FacadeCreateRol;
                            echo $FacadeCliente->totalClientes();
                            ?></td>
                    </tr>

                    <tr style="color: #194E9C">
                        <td>Administración</td>
                        <td><?php echo $facadeUsuario->cantidadUsuariosPorRol("Administrador"); ?></td>
                    </tr>

                    <tr style="color: #ED9C13">
                        <td>Gerentes</td><td><?php echo $facadeUsuario->cantidadUsuariosPorRol("Gerente"); ?></td>
                    </tr>

                    <tr style="color: #ED5713">
                        <td>Empleados</td><td><?php echo $facadeUsuario->cantidadUsuariosPorRol("Empleado"); ?></td>
                    </tr>                    
                </table>
                <canvas id="chart" width="600" height="500"></canvas>
            </div>
            <div id="panelDer">
                <br>
                <br><h2 class="h330">Registrar Nuevo Usuario:</h2><hr>
                <p class="obligatorios">Los campos marcados con asterisco ( </p><p class="obligatoriosD"> ) son obligatorios.</p><br><br>
                <form class="formRegistro" method="post" action="../controlador/ControladorUsuarios.php" enctype="multipart/form-data"> 
                    <label class="tag" id="labelTipoUsuario" for="tipoUsuario"><span id="lab_valCountry" class="h331">Tipo de Usuario:</span></label>
                    <select id="selectrol" name="selectRol" class="input"> 
                     <?php
                        $roles = $facadeRol->ListarRoles();
                        echo '<option disabled selected>' . "Seleccione un Rol" . '</option>';
                        foreach ($roles as $rol) {
                            $rolCreado = $rol['rol'];
                            echo '<option value="' . $rol['idRoles'] . '">' . $rolCreado . '</option>';                            
                        }
                        ?>
                    </select><br> 
                     <?php
                    $areas = $facadeUsuario->listarAreas();//                  
                    ?>
                    <label class="tag" id="labelTipoUsuario" for="tipoUsuario"><span id="lab_valCountry" class="h331">Área o Dependencia:</span></label>
                    <select id="selectArea" name="selectArea" class="input"> 
                          <?php
                         echo '<option disabled selected>' . "Seleccione un Área" . '</option>';
                        foreach ($areas as $area) {

                            echo '<option value="' . $area['idAreas'] . '">' . $area['nombreArea'] . '</option>';
                        }
                        ?>
                    </select>
                    <br> 
                    <label class="tag" id="labelDocumento" for="documento"><span id="documento" class="h331">Documento: </span></label>
                    <input class="input" name="identificacion" required type="text" pattern="[0-9]{6,15}" placeholder="1033405321" title="Solo números" maxlength="128" id="documento" class="field1">
                    <span id="valCompany" style="color:Red;visibility:hidden;"></span>
                    <br>               
                    <label class="tag" for="txtName"><span id="lab_valName" class="h331">Nombres: </span></label>
                    <input class="input" name="nombre" type="text" id="txtName" class="field1" placeholder="Pedro"  required>
                    <span id="valName" style="color:Red;visibility:hidden;"></span>
                    <br>
                    <label class="tag" for="txtSurname"><span id="lab_valSurname" class="h331">Apellidos: </span></label>
                    <input class="input" name="apellido" type="text" id="txtSurname" class="field1" placeholder="Perez" required >
                    <span id="valSurname" style="color:Red;visibility:hidden;"></span>
                    <br>
                    <label class="tag" for="txtCompany1"><span id="lab_valCompany" class="h331">Teléfono: </span></label>
                    <input class="input" name="telefono" required type="text" pattern="[0-9]{7,10}" placeholder="310300310" title="Solo números" maxlength="128" id="txtEmail" class="field1">
                    <span id="valCompany" style="color:Red;visibility:hidden;"></span>
                    <br>
                    <label for="txtSurname1"><span id="lab_valSurname" class="h331">Dirección: </span></label>
                    <input class="input" name="direccion" type="text" id="txtSurname" placeholder="Cll 93 No 15 - 99" class="field1">
                    <span id="valSurname" style="color:Red;visibility:hidden;"></span>
                    <br>

                    <label class="tag" for="txtEmail"><span id="lab_valEmail" class="h331">Email </span></label>
                    <input class="input" name="email" required type="text" maxlength="128" id="txtEmail" class="field1" placeholder="empleado@muebleslaoficina.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
                    <span id="valEmail" style="color:Red;visibility:hidden;"></span>
                    <br>
                    <label class="tag" for="txtCompany2"><span id="lab_valCompany" class="h331">Fecha de Nacimiento:</span></label>
                    <input class="input" name="fechaNacimiento" required type="date" id="txtCompany2" class="field1">
                    <span id="valCompany" style="color:Red;visibility:hidden;"></span>
                    <br>
                    <label class="tag1" for="image"><span id="lab_valCompany" class="h331">Foto:</span></label>
                    <input class="input"  name="uploadedfile" id="image"  type="file" multiple=true class="file"  title="Solo Foto">
                    <span id="valCompany" style="color:Red;visibility:hidden;"></span>
                    <div id="cargueFoto">
                        <output id="list"></output>
                    </div>
                    <br>
                    <label class="tag" for="passw"><span id="lab_valCompany" class="h331">Contraseña:</span></label>
                    <input class="input" name="password" required type="password" maxlength="45" id="pass1" class="field1" placeholder="Formato de 5 a 10 números" pattern= "[A-Za-z0-9]{5,10}" >
                    <span id="valCompany" style="color:Red;visibility:hidden;"></span>
                    <br>
                    <label class="tag" for="pass"><span id="lab_valCompany" class="h331">Confirmar Contraseña:</span></label>
                    <input class="input" name="password2" onchange="validarPass()" required type="password" maxlength="64" id="pass2" class="field1" placeholder="Repita la contraseña anterior" pattern= "[A-Za-z0-9]{5,10}" >
                    <span id="valCompany" style="color:Red;visibility:hidden;"></span>                                                
                    <script>
                        function archivo(evt) {
                            var files = evt.target.files; // FileList object

                            // Obtenemos la imagen del campo "file".
                            for (var i = 0, f; f = files[i]; i++) {
                                //Solo admitimos imágenes.
                                if (!f.type.match('image.*')) {
                                    continue;
                                }

                                var reader = new FileReader();

                                reader.onload = (function (theFile) {
                                    return function (e) {
                                        // Insertamos la imagen
                                        document.getElementById("list").innerHTML = ['<img class="thumb" src="', e.target.result, '" title="', escape(theFile.name), '" style="height:50px;width: 50px;border-radius: 50%;"/>'].join('');
                                    };
                                })(f);

                                reader.readAsDataURL(f);
                            }
                        }

                        document.getElementById('image').addEventListener('change', archivo, false);
                    </script>
                    <button type="submit" value="Enviar" name="crearUsuario" id="crearUsuario" class="boton-verde">Crear Usuario</button><br>                                 
                </form>
                <script>
                    function validarPass() {
                        pass1 = document.getElementById('pass1');
                        pass2 = document.getElementById('pass2');
                        if (pass1 != pass2) {
                            alert('Las contraseñas no coinciden');
                        }
                    }
                </script>

                <?php
                if (isset($_GET['mensaje'])) {
                    if($_GET['consecutivo']!=0){
                    echo '<script>
            Command: toastr["success"]("Su Nuevo Consecutivo es: ' . $_GET['consecutivo'] . '", "' . $_GET['mensaje'] . '")

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
                }                
                }
                 if (isset($_GET['mensaje'])) {
                    if($_GET['consecutivo']==0){
                    echo '<script>
            Command: toastr["error"]("'. $_GET['mensaje'] .'")

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
                }                
                }
                ?>
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
