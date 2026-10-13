<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php if($seccion=="consultas"){ ?>
                <h1>Consultas</h1>
                <h4>Préstamos sin devolver</h4>
                    <?php $r=mysqli_query($conexion,"SELECT a.nombre,a.apellido,l.titulo FROM prestamos p INNER JOIN alumnos a ON p.dni_alumno=a.dni INNER JOIN libros l ON p.id_libro=l.id WHERE p.fin_fecha_prestamo IS NULL"); 
                    while($x=mysqli_fetch_assoc($r)){ 
                        echo $x['apellido'].' '.$x['nombre'].' - '.$x['titulo'].'<br>'; 
                        } ?>

                <h4>Veces prestado cada libro</h4>
                    <?php $r=mysqli_query($conexion,"SELECT l.titulo,COUNT(p.id) cantidad FROM libros l LEFT JOIN prestamos p ON l.id=p.id_libro GROUP BY l.id ORDER BY cantidad DESC");
                    while($x=mysqli_fetch_assoc($r)){
                        echo $x['titulo'].': '.$x['cantidad'].'<br>'; 
                    } ?>

                <h4>5 libros más prestados</h4>
                    <?php $r=mysqli_query($conexion,"SELECT l.titulo,COUNT(p.id) cantidad FROM libros l LEFT JOIN prestamos p ON l.id=p.id_libro GROUP BY l.id ORDER BY cantidad DESC LIMIT 5");
                    while($x=mysqli_fetch_assoc($r)){ 
                        echo $x['titulo'].': '.$x['cantidad'].'<br>'; 
                    } ?>

                <h4>Alumnos con 3 o más préstamos</h4>
                    <?php $r=mysqli_query($conexion,"SELECT a.nombre,a.apellido,COUNT(p.id) cantidad FROM alumnos a INNER JOIN prestamos p ON a.dni=p.dni_alumno GROUP BY a.dni HAVING COUNT(p.id)>=3");
                    while($x=mysqli_fetch_assoc($r)){ 
                        echo $x['apellido'].' '.$x['nombre'].': '.$x['cantidad'].'<br>'; 
                    } ?>
            <?php } ?>
</body>
</html>