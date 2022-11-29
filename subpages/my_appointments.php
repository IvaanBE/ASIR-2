<?php
    session_start();
    $email=$_SESSION['email'];
    $servername="127.0.0.1";
    $database="bdd_taller";
    $username="alu";
    $userpass="123";
    //Conexion con la bdd
    $conn=mysqli_connect($servername, $username, $userpass, $database);
    //creacion del array con las citas
    $citas=array();
    $selectcita="SELECT id_cita,fecha,hora,motivo,id_empleado from citas
                    where id_cliente in (select id from usuarios 
                                        where email = '$email')
                    order by fecha,hora asc;";
    $result=$conn->query($selectcita);
    while ($row=$result->fetch_assoc()){
        $employeeid=$row['id_empleado'];
        $selecemployee="SELECT concat_ws (' ',nombre,apellidos) as 'professional' FROM empleados 
                        where id_empleado  = '$employeeid';";
        $result2=$conn->query($selecemployee);
        while ($row2=$result2->fetch_assoc()){
            $professional=$row2['professional'];
        }
        if ($citas=="") {
            $citas=[$row['fecha'],$row['hora'],$row['motivo'],$professional,$row['id_cita']];

        }
        else {
            array_push($citas,$row['fecha'],$row['hora'],$row['motivo'],$professional,$row['id_cita']);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis citas</title>
    <link rel="stylesheet" href="../styles/my_appointments.css">
    <link rel="stylesheet"  href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <header>
        <nav class="navbar navbar-dark bg-dark">
            <div class="navdiv">
                <a href="user_page.php" class="navlink">Inicio</a>
                <a href="my_appointments.php" class="navlink">Mis citas</a>                   
                <a href="appointment.php" class="navlink">Reserva una cita</a>                
                <a href="user_profile.php" class="navlink">Mi perfil</a>                 
                <a href="close_session.php" class="navlink">Cerrar sesion</a>
            </div>
        </nav> <br>
    </header>
    <article>
        <table class="table">
            <tr class="thead-dark">
                <th scope="col">Cita</th>
                <th scope="col">Dia</th>
                <th scope="col">Hora</th>
                <th scope="col">Motivo</th>
                <th scope="col">Profesional</th>
                <th scope="col">Estado</th>
                <th scope="col">Opciones</th>
            </tr>
            <?php
                if ($citas !="") {
                    $key1=0; 
                    $key2=1;
                    $key3=2;
                    $key4=3;
                    $key5=4;
                    $numcita=1;
                    $count=count($citas)/5;
                    for ($i=1; $i<=$count; $i++){
                        if ($citas[$key1] < $_SESSION['today']) {
                            echo"<tr class='table-active'>
                                    <td scope='col'>Cita $numcita</td>
                                    <td scope='col'>$citas[$key1]</td>
                                    <td scope='col'>$citas[$key2]</td>
                                    <td scope='col'>$citas[$key3]</td>
                                    <td scope='col'>$citas[$key4]</td>
                                    <td scope='col'>Caducada</td>
                                    <td>
                                        <a href='remove_appo.php ?id=".$citas[$key5]."'>Cancelar cita</a>          
                                    </td> 
                                </tr>";
                        }
                        else {
                            echo"<tr>
                                    <td scope='col'>Cita $numcita</td>
                                    <td scope='col'>$citas[$key1]</td>
                                    <td scope='col'>$citas[$key2]</td>
                                    <td scope='col'>$citas[$key3]</td>
                                    <td scope='col'>$citas[$key4]</td>
                                    <td scope='col'>En vigor</td>
                                    <td>
                                        <a href='remove_appo.php ?id=".$citas[$key5]."'>Cancelar cita</a>          
                                    </td> 
                                </tr>";
                        }
                        $key1+=5;
                        $key2+=5;
                        $key3+=5;
                        $key4+=5;
                        $key5+=5;
                        $numcita+=1;
                    }
                }
                else {
                    echo "<text>No tienes citas proximamente </text><a href='appointment.php'>Reserva una aqui</a>";
                }
            ?>
        </table>
    </article>
</body>
</html>