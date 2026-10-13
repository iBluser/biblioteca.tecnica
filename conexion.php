<?php
$conexion = mysqli_connect("localhost", "root", "", "biblioteca-tecnica");
if (!$conexion) {
    die("Error de conexión");
}
mysqli_set_charset($conexion, "utf8");
?>
