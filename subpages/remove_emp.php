<?php
    $id_emp=$_REQUEST['id'];
    $servername="127.0.0.1";
    $database="bdd_taller";
    $username="alu";
    $userpass="123";
    //Conexion con la bdd
    $conn=mysqli_connect($servername, $username, $userpass, $database);
    $remove="DELETE FROM empleados
             WHERE id_empleado = $id_emp;";
    $conn->query($remove);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>removig your appointment</title>
</head>
<body>
    <h1>El empleado ha sido eliminada correctamente <a href="admin_page.php">volver al inicio</a></h1>
</body>
</html>