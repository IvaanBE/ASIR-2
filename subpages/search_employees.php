<?php
    if (isset($_REQUEST) and $_REQUEST !="") {
        if (isset($_REQUEST['id_empleado'])) {
            $id_empleado=$_REQUEST['id_empleado'];
        }
    }
    $servername="127.0.0.1";
    $database="bdd_taller";
    $username="alu";
    $userpass="123";
    //Conexion con la bdd
    $conn=mysqli_connect($servername, $username, $userpass, $database);
    //Los trabajadores que coincidan con los criterios de busqueda introducidos
    $selemple="SELECT * FROM empleados 
                    WHERE id_empleado = 
                    AND nombre = 'adrian'
                    AND apellidos = 'Gomez Navarro';";
    $result=$conn->query($selemple);
?>