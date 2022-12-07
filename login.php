<?php

include("database.php");

$Correo = $_POST['Correo'];
$Clave = $_POST['Clave'];

$Usuario = mysqli_query($BDMSSA,"SELECT IDUSUARIO, NOMCOMPLETO FROM USUARIOS WHERE CORREO = '$Correo' AND CLAVE = '$Clave' AND TIPO_USUARIO = 1");

$RUsuario = mysqli_fetch_array($Usuario);

if($RUsuario['IDUSUARIO'] != ''){

session_start();

$_SESSION['IDUSUARIO'] = $RUsuario['IDUSUARIO'];
$_SESSION['NOMCOMPLETO'] = $RUsuario['NOMCOMPLETO'];

}

header('Location: ../admin.php');
exit;

 ?>
