<?php
    if (isset($_POST["nuevo_alumno"])) {
        $dni=trim($_POST["dni"]); 
        $nombre=trim($_POST["nombre"]); 
        $apellido=trim($_POST["apellido"]); 
        $anio=trim($_POST["anio"]);
        $division=trim($_POST["division"]);
    
    if($dni > 0 && strlen($dni) == 8 
       && preg_match("/^[A-Za-zÁÉÍÓÚáéíóúÑñ ]+$/u", $nombre) 
       && preg_match("/^[A-Za-zÁÉÍÓÚáéíóúÑñ ]+$/u", $apellido)
       && preg_match("/^[1-7]+$/u", $anio)
       && preg_match("/^[1-6]+$/u", $division)){

        mysqli_query($conexion,"INSERT INTO alumnos (dni,nombre,apellido,anio,division) VALUES ('$dni','$nombre','$apellido','$anio','$division')");
    } else {
        echo "<script>alert('Error: Revisa DNI (8 digitos), Nombre/Apellido (solo letras) y Año/División (ej: 6/1)');</script>";
    }
}

    if (isset($_POST["modificar_alumno"])) {
        $dni_original=$_POST["dni_original"]; 
        $dni=trim($_POST["dni"]); 
        $nombre=trim($_POST["nombre"]); 
        $apellido=trim($_POST["apellido"]); 
        $anio=trim($_POST["anio"]);
        $division=trim($_POST["division"]);
        
        if($dni > 0 && strlen($dni) == 8 
        && preg_match("/^[A-Za-zÁÉÍÓÚáéíóúÑñ ]+$/u", $nombre) 
        && preg_match("/^[A-Za-zÁÉÍÓÚáéíóúÑñ ]+$/u", $apellido)
        && preg_match("/^[1-7]+$/u", $anio)
        && preg_match("/^[1-6]+$/u", $division)){

            mysqli_query($conexion,"UPDATE alumnos SET dni='$dni', nombre='$nombre', apellido='$apellido', anio='$anio', division='$division' WHERE dni=$dni_original");
            header("Location: ?seccion=alumnos");
            exit;
        } else {
            echo "<script>alert('Error: Revisa DNI (8 digitos), Nombre/Apellido (solo letras) y Año/División (ej: 6/1)');</script>";
        }
    }

    if (isset($_GET["eliminar_alumno"])) mysqli_query($conexion,"DELETE FROM alumnos WHERE dni=".$_GET["eliminar_alumno"]);

    $buscar = trim($_GET['buscar'] ?? '');

if ($buscar !== '') {
    // Tu consulta de búsqueda actual
} else {
    $resultado = mysqli_query(
        $conexion,
        "SELECT * FROM alumnos ORDER BY apellido"
    );
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php if($seccion=="alumnos"){ ?>
            <h1>Alumnos</h1>
            <?php if(isset($_GET["editar_alumno"])){ 
                $dni = intval($_GET["editar_alumno"]); 
                $q = mysqli_query($conexion,"SELECT * FROM alumnos WHERE dni=$dni");
                $editar = mysqli_fetch_assoc($q);
                if($editar){
            ?>
            <h4>Modificar alumno</h4>
            <form method="post">
                <input type="hidden" name="dni_original" value="<?php echo $editar['dni']; ?>">
                <input required name="dni" placeholder="DNI" type="text" min="10000000" max="99999999" maxlength="8" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                <input required name="nombre" value="<?php echo $editar['nombre']; ?>" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ ]+" title="Solo letras" oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ ]/g, '')">
                <input required name="apellido" value="<?php echo $editar['apellido']; ?>" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ ]+" title="Solo letras" oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ ]/g, '')">

                <select required name="anio" placeholder="Año">
                    <option value="<?php echo $editar['anio'];?>"><?php echo $editar['anio'];?></option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                </select>

                <select required name="division" placeholder="División">
                    <option value="<?php echo $editar['division'];?>" ><?php echo $editar['division'];?></option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                </select>

                <input type="submit" name="modificar_alumno" value="Modificar">
            </form>
            <?php } } ?>

            <h4>Agregar alumno</h4>
            <form method="post">
                <input required name="dni" placeholder="DNI" type="text" min="10000000" max="99999999" maxlength="8"
                oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                <input required name="nombre" placeholder="Nombre" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ ]+" title="Solo letras" oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ ]/g, '')">
                <input required name="apellido" placeholder="Apellido" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ ]+" title="Solo letras" oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ ]/g, '')">
                <select required name="anio" placeholder="Año">
                    <option value="">- Año -</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                </select>

                <select required name="division" placeholder="División">
                    <option value="">- División -</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                </select>
                <input type="submit" name="nuevo_alumno" value="Guardar">
            </form>

            <form method="GET" action="">
                <input type="hidden" name="seccion" value="alumnos">
                <input type="text" name="buscar" placeholder="Buscar por ID o Nombre" autocomplete="off">
                <button type="submit">Buscar</button>
            </form>

            <?php 
                $buscar=isset($_GET['buscar'])?$_GET['buscar']:'';
                $resultado=mysqli_query($conexion,"SELECT * FROM alumnos WHERE id_alumno LIKE '%$buscar%' OR nombre LIKE '%$buscar%'"); 
            ?>
            
            <table border="1">
                <tr>
                    <th>ID</th>
                    <th>DNI</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Año</th>
                    <th>División</th>
                    <th>Acciones</th>
                </tr>
                <?php while($fila=mysqli_fetch_assoc($resultado)){ ?>
                <tr>
                    <td><?php echo $fila['id_alumno']; ?></td>
                    <td><?php echo $fila['dni']; ?></td>
                    <td><?php echo $fila['nombre']; ?></td>
                    <td><?php echo $fila['apellido']; ?></td>
                    <td><?php echo $fila['anio']; ?></td>
                    <td><?php echo $fila['division']; ?></td>
                    <td>
                        <a href="?seccion=alumnos&editar_alumno=<?php echo $fila['dni']; ?>">Editar</a> 
                        <a href="?seccion=alumnos&eliminar_alumno=<?php echo $fila['dni']; ?>">Eliminar</a>
                    </td>
                </tr>
                <?php } ?>
            </table>
        <?php } ?>

    <script>
    if (window.location.search.includes('buscar=')) {
        window.history.replaceState({}, '', '?seccion=alumnos');
    }
    </script>
</body>
</html>