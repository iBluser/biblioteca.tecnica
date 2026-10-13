<?php
if (isset($_POST["nuevo_libro"])) {
    $titulo=$_POST["titulo"]; 
    $asignatura=$_POST["asignatura"]; 
    $editorial=$_POST["editorial"];
    $autor=$_POST[]
    mysqli_query($conexion,"INSERT INTO libros (titulo,asignatura,editorial,fecha_lanzamiento) VALUES ('$titulo','$asignatura','$editorial','$fecha')");
}

if (isset($_POST["modificar_libro"])) {
    $id=$_POST["id"]; 
    $titulo=$_POST["titulo"]; 
    $asignatura=$_POST["asignatura"]; 
    $editorial=$_POST["editorial"]; 
    mysqli_query($conexion,"UPDATE libros SET titulo='$titulo', asignatura='$asignatura', editorial='$editorial', fecha_lanzamiento='$fecha' WHERE id=$id");
}

if (isset($_GET["eliminar_libro"])) mysqli_query($conexion,"DELETE FROM libros WHERE id=".$_GET["eliminar_libro"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Libros</h1>
            <?php 
                if(isset($_GET["editar_libro"])){ 
                    $id=$_GET["editar_libro"]; 
                    $editar=mysqli_fetch_assoc(mysqli_query($conexion,"SELECT * FROM libros WHERE id=$id")); 
            ?>

            <h4>Modificar libro</h4>
            <form method="post">
                <input type="hidden" name="id" value="<?php echo $editar['id']; ?>">
                <input required name="titulo" value="<?php echo $editar['titulo']; ?>">
                <select required name="asignatura" placeholder="asignatura">
                    <option value="">-- Asignatura --</option>
                    <option value="Lectura">Lectura</option>
                    <option value="Literatura">Literatura</option>
                    <option value="Matemáticas">Matemáticas</option>
                    <option value="Historia">Historia</option>
                    <option value="Geografía">Geografía</option>
                    <option value="Filosofía">Filosofía</option>
                    <option value="Física">Física</option>
                    <option value="Química">Química</option>
                    <option value="Inglés">Inglés</option>
                    <option value="Informática">Informática</option>
                    <option value="Electrónica">Electrónica</option>
                </select>
                <input required name="editorial" value="<?php echo $editar['editorial']; ?>">
                <input type="submit" name="modificar_libro" value="Modificar">
            </form>
            <?php } ?>

            <h4>Agregar libro</h4>
            <form method="post">
                <input required name="titulo" placeholder="Título">
                <select required name="asignatura" placeholder="asignatura">
                    <option value="">-- Asignatura --</option>
                    <option value="Lectura">Lectura</option>
                    <option value="Literatura">Literatura</option>
                    <option value="Matemáticas">Matemáticas</option>
                    <option value="Historia">Historia</option>
                    <option value="Geografía">Geografía</option>
                    <option value="Filosofía">Filosofía</option>
                    <option value="Física">Física</option>
                    <option value="Química">Química</option>
                    <option value="Inglés">Inglés</option>
                    <option value="Informática">Informática</option>
                    <option value="Electrónica">Electrónica</option>
                </select>
                <input required name="editorial" placeholder="Editorial">
                <input type="submit" name="nuevo_libro" value="Guardar">
            </form>

            <form>
                <input type="hidden" name="seccion" value="libros">
                <input name="buscar" placeholder="Buscar por título o editorial">
                <button>Buscar</button>
            </form>

            <?php 
                $buscar=isset($_GET['buscar'])?$_GET['buscar']:'';
                $resultado=mysqli_query($conexion,"SELECT * FROM libros WHERE titulo LIKE '%$buscar%' OR editorial LIKE '%$buscar%'"); 
            ?>

            <table border="1">
                <tr>
                    <th>ID</th>
                    <th>Categoría</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Editorial</th>
                    <th>Cantidad</th>
                    <th>Acciones</th>
                </tr>
                <?php 
                    while($fila=mysqli_fetch_assoc($resultado)){ ?>
                    <tr>
                        <td><?php echo $fila['id']; ?></td>
                        <td><?php echo $fila['asignatura']; ?></td>
                        <td><?php echo $fila['titulo']; ?></td>
                        <td><?php echo $fila['autor']; ?></td>
                        <td><?php echo $fila['editorial']; ?></td>
                        <td><?php echo $fila['cantidad']; ?></td>
                        <td>
                            <a href="?seccion=libros&editar_libro=<?php echo $fila['id']; ?>">Editar</a>
                            <a href="?seccion=libros&eliminar_libro=<?php echo $fila['id']; ?>">Eliminar</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>

        <script>
            if (window.location.search.includes('buscar=')) {
                window.history.replaceState({}, '', '?seccion=libros');
            }
        </script>
</body>
</html>
