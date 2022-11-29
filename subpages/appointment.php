<?php
    $hoy=getdate();
    $today=$hoy['year'].'-'.$hoy['mon'].'-'.$hoy['mday'];
    session_start();
    if (isset($_SESSION['mensaje'])) {
        if ($_SESSION['mensaje'] !='') {
            $mensaje=$_SESSION['mensaje'];
            unset($_SESSION['mensaje']);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva tus citas</title>
</head>
<body>
    <header>
        <?php
            if (isset($mensaje)) {
                echo $mensaje;
            }
        ?>
        <nav class="navbar navbar-dark bg-dark">
            <div class="navdiv">
                <a href="user_page.php" class="navlink">Inicio</a>
                <a href="my_appointments.php" class="navlink">Mis citas</a>                   
                <a href="appointment.php" class="navlink">Reserva una cita</a>                
                <a href="user_profile.php" class="navlink">Mi perfil</a>                 
                <a href="close_session.php" class="navlink">Cerrar sesion</a>
            </div>
        </nav>
    </header>
    <article>
        <form action="check_appointment.php" method="post">
            <label for="day">Seleccione un dia para la cita: </label>
            <input type="date" id="day" name="day" min="<?php echo $today; ?>"><br><br>
            <label for="reason">Seleccione un motivo para la cita: </label>
            <select id="reason" name="reason" placeholder="Seleccione un motivo"> 
                <option value=""></option>
                <option value="Chapa y pintura">Chapa y pintura</option>
                <option value="Sistema electrico">Sistema electrico</option>
                <option value="Motor">Motor</option>
                <option value="Carroceria">Carroceria</option>
                <option value="Luces">Luces</option>
            </select>
            <input type="submit" value="Comprobar disponibilidad">
        </form>
    </article>
</body>
</html>