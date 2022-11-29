<?php
    session_start();
    if(isset($_SESSION['mensaje'])) { 
        $mensaje=$_SESSION['mensaje'];
        $email=$_SESSION['email'];
        session_destroy();
    }
    else  {
        $email='';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"  href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/form.css">
    <title>Loggin</title>
</head>
<body>
    <article>
        <div class="caja" >
            <?php if (isset($mensaje)) {echo $mensaje;} ?>
            <form action="subpages/validador.php" method="post" class="px-4 py-3">
                    <label for="email">Email: </label>
                    <input type="text" id="email" name="email" value= "<?php echo $email ?>" class="form-control" >
                    <label for="pass">Contraseña: </label>
                    <input type="password" id="pass" name="pass" class="form-control"><br>
                    <input type="submit" value="Iniciar sesion" class="btn btn-primary">
            </form>
            <div class="divider">
                    <a class="dropdown-item" href="subpages/new_user.php">Soy un usuario nuevo</a>
                    <a class="dropdown-item" href="subpages/recuperar.html">He olvidado tu contraseña?</a>
            </div>
        </div>
    </article>
</body>
</html>