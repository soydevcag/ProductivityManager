<?php
require_once '../modelo/dao/UsuarioDAO.php';
require_once '../facades/FacadeUsuarios.php';
require_once '../modelo/dao/NovedadesDAO.php';
require_once '../modelo/dto/NovedadesDTO.php';
require_once '../facades/FacadeNovedades.php';
require_once '../modelo/utilidades/Conexion.php';
require_once '../modelo/dto/ImagenesDTO.php';
require_once '../modelo/utilidades/GestionImagenes.php';
require_once '../modelo/dto/CorreosDTO.php';
require_once '../facades/FacadeCorreos.php';
require_once '../modelo/utilidades/EnvioCorreos.php';
require_once '../PHPMailer/PHPMailerAutoload.php';

if(isset($_POST['crearNovedad'])){
    session_start();
    $facadeUsuario = new FacadeUsuarios;
    $facadeNovedad = new FacadeNovedades();
    $idUsuario=$facadeUsuario->usuarioEnSesion($_SESSION['id']);
    $nombreUsuario = $_SESSION['nombre'];
    $idProyecto=$_POST['idProyecto'];
    $categoria=$_POST['categoria'];
    $descripcion=$_POST['descripcion'];
    $archivo=$_FILES['uploadedfile']['name'];
    $objetoDTO = new NovedadesDTO($idUsuario, $idProyecto, $categoria, $descripcion, $archivo);

    //Insertar Evidencia Novedades
    if ($_FILES['uploadedfile']['name'] == '') {
        $foto ='novedad.png';
    } else {
        $foto = $_FILES['uploadedfile']['name'];
    }
    $carpeta = "evidencias";
    $nombreImagen = $_FILES['uploadedfile']['name'];
    $tamano = $_FILES['uploadedfile']['size'];
    $tipo = $_FILES['uploadedfile']['type'];
    $nombreTemporal = $_FILES['uploadedfile']['tmp_name'];
    $dtoImagen = new ImagenesDTO($tamano, $tipo, $nombreImagen, $nombreTemporal, $carpeta);
    $cargaFoto = new GestionImagenes();
    $msg =$cargaFoto->subirImagen($dtoImagen);
    if($msg!='True'){
         header("location: ../vista/agregarNovedad.php?errorPermiso=Archivo No Valido");
    }else{
        $datos  = $facadeNovedad->consultarGerenteParaEnvarNovedadPorCorreo($idProyecto);
        $usuario = $facadeNovedad->consultarAreaUsuarioEnSesion($idUsuario);
        $email = $datos['email'];
        $nombreGerente = $datos['nombre'];
        $area = $usuario['nombreArea'];
        $correoDTO = new CorreosDTO();    
    $correoDTO->setRemitente("productivitymanagersoftware@gmail.com");
    $correoDTO->setNombreRemitente("Productivity Manager");
    $correoDTO->setAsunto("Novedad de ".$categoria." creada por ". $nombreUsuario);
    $correoDTO->setContrasena("adsi2015");
    $correoDTO->setDestinatario($email);
    $correoDTO->setContenido("Estimado señor: ".$nombreGerente.",<br> Desde el area de ".$area." se generó una novedad de ".$categoria." con las siguientes observaciones: "
            . $descripcion.'<br>'
            ."Adjunto encontrara un archivo con la evidencia.".'<br>'
        .'<font style="color: #83AF44; font-size: 11px; font-weight:bold; font-family: Sans-Serif;font-style:italic; " >Prductivity Manager Software'
                    . '© Todos los derechos reservados 2015.'
                    . '<br>'.'Bogotá, Colombia'
                    . '<br>'.'Teléfono: +57 3015782659'
                    . '<br>'.'https://www.facebook.com/productivitymanager'
                    . '<br>'.'https://twitter.com/Productivity_Mg'
    . '</font>');
    $correoDTO->setArchivos($archivo);
    $facadeCorreo = new FacadeCorreos();
    $confirmacion=$facadeCorreo->EnvioCorreo($correoDTO);
    if ($confirmacion!='True') {
       $mensajeCorreo=$confirmacion;  
       $mensaje2="Error no se pudo generar la novedad";
       $consecutivos = 0;
       header("Location: ../vista/listarUsuarios.php?modificado=" . $mensaje2);
    } else {        
    //insertar imagen
         $message= $facadeNovedad->insertarNovedad($objetoDTO);
    header("location: ../vista/agregarNovedad.php?novedad=".$message."&evidencia=".$msg);
    }
   
    }
}else if (isset($_GET['idNovedad'])) {
    $facadeNovedad = new FacadeNovedades();
    session_start();
    $_SESSION['datoNovedad'] = $facadeNovedad->consultarNovedad($_GET['idNovedad']);

    header("Location: ../vista/listarNovedades.php?&#verUsuario");
}