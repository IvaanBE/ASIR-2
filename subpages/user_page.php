<?php
    session_start();
    $hoy=getdate();
    $today=$hoy['year']."-".$hoy['mon']."-".$hoy['mday'];
    $_SESSION['today']=$today;
    $email=$_SESSION['email'];
    $servername="127.0.0.1";
    $database="bdd_taller";
    $username="alu";
    $userpass="123";
    //Conexion con la bdd
    $conn=mysqli_connect($servername, $username, $userpass, $database);
    //check de la conexion
    if (!$conn) {
        die("<p>Se ha producido un error, espere unos minutoss e intentelo de nuevo</p>");
    }
    else {
        //Recogemos el nombre y apellidos del usuario.
        $selectbienve="SELECT CONCAT_ws(' ',nombre,apellidos) from usuarios
        where email ='$email';";
        $result=mysqli_query($conn, $selectbienve);
        $row=mysqli_fetch_array($result);
        $username=$row[0];
        $bienvenida="Bienvenido $username";
        //recogemos las citas del usuario
        $citas=array();
        $selectcita="SELECT fecha,hora from citas
                        where id_cliente in (select id from usuarios 
                                            where email = '$email')
                        order by fecha,hora desc;";
        $result=$conn->query($selectcita);
        while ($row=$result->fetch_assoc()){
            if ($citas=="") {
                $citas=[$row['fecha'],$row['hora']];
            }
            else {
                array_push($citas,$row['fecha'],$row['hora']);
            }
        }
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"  href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/user_page.css">
    <title><?php echo "Pagina de ".$username ?></title>
</head>
<body>
    <header>
        <h1><?php echo $bienvenida; ?></h1>
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
        <div>
            <h3>Citas proximas:</h3>
            <?php
            if (!empty($citas)) {
                $key1=0;
                $key2=1;
                $count=count($citas)/2;
                for ($i=1; $i<=$count and $i < 6; $i++){
                    echo "<p>Tienes una cita el dia $citas[$key1] a las $citas[$key2] <a href='my_appointments.php'>Gestionar cita</a><br></p>";
                    $key1+=2;
                    $key2+=2;
                }
            }
            else {
                echo "<text>No tienes citas proximamente </text><a href='appointment.php'>Reserva una aqui</a>";
            }
            ?>
        </div>
        <div>
            <h3>Quienes somos:</h3>
            <p>
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Pariatur quo consequatur veniam doloribus, officiis reprehenderit tempora natus
                ea quos laborum animi atque iusto esse dolores. Doloribus enim dolor praesentium labore. Lorem ipsum dolor sit amet consectetur adipisicing
                elit. Suscipit, debitis iusto. Molestias ab, molestiae necessitatibus error enim et at deleniti repellendus ipsum voluptates assumenda porro
                blanditiis autem! Pariatur, est alias? Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cupiditate voluptas dicta rem natus asperiores illo, 
                deleniti rerum maxime nemo adipisci quod, harum eveniet voluptatem quam sint necessitatibus id iste nisi! Lorem ipsum, dolor sit amet consectetur adipisicing 
                elit. Sed optio nihil dolorem soluta possimus numquam facilis minus atque nesciunt? Officia nulla labore totam nihil minus iure incidunt laborum nostrum nisi!
            </p>
        </div>
    </article>
</body>
</html>