<?php
    if ($_POST['name'] !='' and $_POST['lastname']!='' and $_POST['especialidad'] !='') {
        $name=$_POST['name'];
        $lastname=$_POST['lastname'];
        $especialidad=$_POST['especialidad'];
        //Datos para la conexion de la bdd
        $servername="127.0.0.1";
        $database="bdd_taller";
        $username="alu";
        $userpass="123";
        //Conexion con la bdd
        $conn=mysqli_connect($servername, $username, $userpass, $database);
        //check de la conexion
        if (!$conn) {
            die("<p>Error con el registro, espere unos minutoss e intentelo de nuevo</p>". mysqli_connect_error());
        }
        else {
            // inserccion del dato y check sin errores
            $sqlinsert="INSERT INTO empleados (nombre, apellidos, especialidad) VALUES ('$name','$lastname','$especialidad');";
            if (mysqli_query($conn, $sqlinsert)) {
                header("Location:admin_page.php");
            } 
            else {
                echo "<p>Se ha producido un error con el registro. Vuelva a intentarlo en unos minutos.</p>";
            }
            mysqli_close($conn);
        }
    }
?>