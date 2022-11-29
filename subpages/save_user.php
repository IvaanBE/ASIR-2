<?php
    if ($_POST['name'] !='' and $_POST['lastname']!='' and $_POST['email'] !='' and $_POST['pass'] !='') {
        $name=$_POST['name'];
        $lastname=$_POST['lastname'];
        $email=$_POST['email'];
        $pass=$_POST['pass'];
        if (filter_var($email, FILTER_VALIDATE_EMAIL))  {
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
                $sqlinsert="INSERT INTO usuarios (id, nombre, apellidos, email, contraseña) VALUES ('$id','$name','$lastname','$email','$pass');";
                if (mysqli_query($conn, $sqlinsert)) {
                    echo '<t>Su usuario ha sido registrado correctamente </t><a href="../index.php">Inicia sesion aqui</a>';
                } 
                else {
                    echo "<p>Se ha producido un error con el registro. Vuelva a intentarlo en unos minutos.</p>";
                }
                mysqli_close($conn);
           }
        }
        else {
            header("Location:new_user.php");
        }
    }
    else {
        session_start();
        $error="<div><p>Debes rellenar todos los campos</p></div>";
        $_SESSION['name']=$_POST['name'];
        $_SESSION['lastname']=$_POST['lastname'];
        $_SESSION['email']=$_POST['email'];
        $_SESSION['pass']=$_POST['pass'];
        $_SESSION['error']=$error;
        header("Location:new_user.php");
    }
?>