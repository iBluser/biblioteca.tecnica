<?php
include "conexion.php";
$seccion = isset($_GET["seccion"]) ? $_GET["seccion"] : "inicio";

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
        <title>biblioteca</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h2>Sistema de Gestión de Biblioteca</h2>
        <button class="menu-btn" id="menuBtn" aria-label="Abrir menú" aria-expanded="false" aria-controls="sidebar">☰</button>

        <div class="overlay" id="overlay"></div>

        <aside class="barra-lateral" id="sidebar">
            <h2>Biblioteca</h2>
            <nav>
                <a href="index.php">Inicio</a>
                <a href="?seccion=alumnos">Alumnos</a>
                <a href="?seccion=libros">Libros</a>
                <a href="?seccion=prestamos">Préstamos</a>
                <a href="?seccion=consultas">Consultas</a>
            </nav>
        </aside>

        <br>

        <div>
            <?php if($seccion=="inicio"){ ?>
                <h3>Bienvenidos a la biblioteca.</h3>
                <p>Elegí una opción del menú.</p>
            <?php } ?>

            <?php if($seccion=="alumnos"){ 
                include "alumnos.php";
            }
            ?>

            <?php if($seccion=="libros"){ 
                include "libros.php";
            }
            ?>

            <?php if($seccion=="prestamos"){ 
                include "prestamos.php";
            }
            ?>

            <?php if($seccion=="consultas"){ 
                include "consultas.php";
            }
            ?>
        </div>

        <script>
            const menuBtn = document.getElementById("menuBtn");
            const sidebar = document.getElementById("sidebar");
            const overlay = document.getElementById("overlay");

            function alternarMenu() {
                const abierto = sidebar.classList.toggle("abierta");

                overlay.classList.toggle("visible", abierto);
                menuBtn.setAttribute("aria-expanded", abierto);
                menuBtn.setAttribute(
                    "aria-label",
                    abierto ? "Cerrar menú" : "Abrir menú"
                );
                menuBtn.textContent = abierto ? "✕" : "☰";
            }

            menuBtn.addEventListener("click", alternarMenu);
            overlay.addEventListener("click", alternarMenu);
        </script>
    </body>
</html>