<?php
    if ($_POST['email'] !='' and $_POST['pass'] !='') {
        $email=$_POST['email'];
        $pass=$_POST['pass'];
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            //Objetos con los datos para la conexion con la bdd
            $servername="127.0.0.1";
            $database="bdd_taller";
            $username="alu";
            $userpass="123";
            // Objeto con la conexion a la bdd
            $conn=mysqli_connect($servername, $username, $userpass, $database);
            if (!$conn) {
                die("<p>ERROR</p>");
            }
            else {
                // Buscamos el email en la bbdd
                $selemail="SELECT email FROM usuarios WHERE email = '$email';";
                $queryemail=mysqli_query($conn,$selemail);
                $rowemail=mysqli_fetch_array($queryemail);
                $resemail=$rowemail[0];
                // Buscamos el rol y la contraseña en la bdd
                if ($resemail !='') {
                    $selpassrol="SELECT contraseña,rol FROM usuarios WHERE email = '$email'";
                    $result=$conn->query($selpassrol);
                    while ($row=$result->fetch_assoc()){
                        $respass=$row['contraseña'];
                        $resrol=$row['rol'];
                    }
                    //si la contraseña es correcta redirigimos a la pagina en funcion del rol.
                    if ($pass == $respass) {
                        session_start();
                        $_SESSION['email']=$resemail;
                        if ($resrol=="usuario") {
                            header("Location:user_page.php");
                        }
                        elseif ($resrol=="admin") {
                            header("Location:admin_page.php");
                        }
                    }
                    else {
                        session_start();
                        $mensaje="<div class='mensaje'<p>Inicio de sesion incorrecto</p></div>";
                        $_SESSION['email']='';
                        $_SESSION['mensaje']=$mensaje;
                        header("Location:../index.php");
                    }
                }
                else {
                    session_start();
                    $mensaje="<div class='mensaje'<p>Inicio de sesion incorrecto</p></div>";
                    $_SESSION['email']=$rowemail[0];
                    $_SESSION['mensaje']=$mensaje;
                    header("Location:../index.php");
                }
            }
        }
        else {
            session_start();
            $mensaje="<div class='mensaje'><p>Por favor introduce una direccion de correo</p></div>";
            $_SESSION['email']=$_POST['email'];
            $_SESSION['mensaje']=$mensaje;
            header("Location:../index.php");
        }
    }
    else {
        session_start();
        $mensaje="<div class='mensaje'<p>Debes completar todos los campos.</p></div>";
        $_SESSION['email']=$_POST['email'];
        $_SESSION['mensaje']=$mensaje;
        header("Location:../index.php");
    }   
?>