<?php
    session_start();
    if (isset($_SESSION['name'])) { 
        $name=$_SESSION['name'];
    } 
    else {
        $name='';
    }
    if (isset($_SESSION['lastname'])) {
        $lastname=$_SESSION['lastname'];
    }
    else {
        $lastname='';
    }
    if (isset($_SESSION['email'])) {
        $email=$_SESSION['email'];
    }
    else {
        $email='';
    }
    if ($name =='' or $lastname =='' or $email =='' ) {
        if (isset($_SESSION['error'])) {
        echo $_SESSION['error'];
        }
        session_destroy();
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"  href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/form.css">
    <title>Resgistro</title>
</head>
<body>
    <article>
        <div class="caja">
            <form action="save_user.php" method="post" class="px-4 py-3">
                <label for="name">Nombre: </label>
                <input type="text" id="name" name="name" value="<?php echo $name; ?>" class="form-control">
                <label for="lastname">Apellidos: </label>
                <input type="text" id="lastname" name="lastname" value="<?php echo $lastname ?>" class="form-control">
                <label for="email">Email: </label>
                <input type="email" id="email" name="email" value= "<?php echo $email; ?>" class="form-control">
                <label for="pass">Contraseña: </label>
                <input type="password" id="pass" name="pass" value='' class="form-control" ><br>
                <input type="submit" value="registrar usuario" class="btn btn-primary">
            </form>
            <div class="divider">
                <p>Ya tienes una cuenta? <a href="../index.php">Inicia sesion aqui</a></p>
            </div>
        </div>
    </article>
</body>
</html>