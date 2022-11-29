<?php
    if ($_POST['name'] !='' and $_POST['lastname']!='' and $_POST['email'] !='' and $_POST['pass'] !='' and $_POST['rol']!='') {
        $name=$_POST['name'];
        $lastname=$_POST['lastname'];
        $email=$_POST['email'];
        $pass=$_POST['pass'];
        $rol=$_POST['rol'];
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
            //recogemos el id mas elevado de la bdd y le sumamos uno
            $sqlid="SELECT max(id) + 1 FROM usuarios;";
            $result=mysqli_query($conn, $sqlid);
            $row=mysqli_fetch_array($result);
            $id=$row[0];
            // inserccion del dato y check sin errores
            $sqlinsert="INSERT INTO usuarios (id, nombre, apellidos, email, contraseña, rol) VALUES ('$id','$name','$lastname','$email','$pass','$rol');";
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