<?php
if (isset($_POST["prestar"])) {
    $dni_alumno=$_POST["alumno"]; 
    $id_libro=$_POST["libro"]; 
    $fecha_prestamo=$_POST["fecha"];
    mysqli_query($conexion,"INSERT INTO prestamos (id_libro,dni_alumno,fecha_prestamo) VALUES ('$id_libro','$dni_alumno','$fecha_prestamo')");
}

if (isset($_GET["devolver"])) {
    $id=$_GET["devolver"]; 
    $hoy=date("Y-m-d");
    mysqli_query($conexion,"UPDATE prestamos SET fin_fecha_prestamo='$hoy' WHERE id=$id");
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
            <h1>Prestamos</h1>
            <form method="post">
                <select required name="alumno">
                    <option value="">Alumno</option>
                        <?php $r=mysqli_query($conexion,"SELECT * FROM alumnos ORDER BY apellido");while($a=mysqli_fetch_assoc($r)){ ?>
                    <option value="<?php echo $a['dni']; ?>"><?php echo $a['apellido'].' '.$a['nombre'].' ('.$a['dni'].')'; ?></option>
            <?php } ?>  
                </select>
                <select required name="libro">
                    <option value="">Libro</option>
                        <?php $r=mysqli_query($conexion,"SELECT * FROM libros");
                        while($l=mysqli_fetch_assoc($r)){ ?>
                    <option value="<?php echo $l['id']; ?>"><?php echo $l['titulo']; ?></option>
                        <?php } ?>
                </select>
                <input required type="date" name="fecha" value="<?php echo date('Y-m-d'); ?>">
                <input type="submit" name="prestar" value="Prestar">
            </form>

            <?php $r=mysqli_query($conexion,"SELECT p.*,a.nombre,a.apellido,l.titulo FROM prestamos p INNER JOIN alumnos a ON p.dni_alumno=a.dni INNER JOIN libros l ON p.id_libro=l.id ORDER BY p.id DESC"); ?>
            <table border="1">
                <tr><th>Alumno</th><th>Libro</th><th>Préstamo</th><th>Devolución</th><th>Acción</th></tr>
            <?php while($p=mysqli_fetch_assoc($r)){ ?>
                <tr>
                    <td><?php echo $p['apellido'].' '.$p['nombre']; ?></td>
                    <td><?php echo $p['titulo']; ?></td>
                    <td><?php echo $p['fecha_prestamo']; ?></td>
                    <td><?php echo $p['fin_fecha_prestamo']?$p['fin_fecha_prestamo']:'Pendiente'; ?></td>
                    <td><?php if(!$p['fin_fecha_prestamo']){ ?><a href="?seccion=prestamos&devolver=<?php echo $p['id']; ?>">Devolver</a><?php } ?></td>
                </tr>
            <?php } ?>
        </table>
</body>
</html>