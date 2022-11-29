<?php
    $hours=['8:30','10:00','11:30','13:00','14:30'];
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
        session_start();
        $reason=$_SESSION['reason'];
        $day=$_SESSION['day'];
        $today=$_SESSION['today'];
        $selecthour="SELECT hora,id_empleado from citas
                    where fecha='$day'
                    and id_empleado in (select id_empleado from empleados
                                        where especialidad like '$reason');";
        $citas=array();
        $result=$conn->query($selecthour);
        while ($row=$result->fetch_assoc()){
            if ($citas == "") {
                $citas=[$row['hora']];
            }
            else {
                array_push($citas,$row['hora']);
            }
        }
        if ($citas != "" ){
            for ($i=0; $i<count($citas); $i++){
                for ($j=0; $j<count($hours); $j++) {
                    if (isset($hours[$j])) {    
                        if ($citas[$i] == $hours[$j]) {
                                unset ($hours[$j]);
                        }
                    }
                }
            }
        }
    $selecemployee="SELECT concat_ws (' ',nombre,apellidos) as 'professional',id_empleado FROM empleados 
                    where especialidad = '$reason';";
    $result=$conn->query($selecemployee);
    while ($row=$result->fetch_assoc()){
      $professional=$row['professional'];
      $_SESSION['profeid']=$row['id_empleado'];
    }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva tus cita</title>
    <link rel="stylesheet"  href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <header>
        <h1>Citas disponibles para <?php echo $reason; ?> el dia <?php echo $day; ?></h1>
    </header>
    <article>
        <form action='save_appointment.php' method='post'>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Cita</th>
                        <th scope="col">Dia</th>
                        <th scope="col">Hora</th>
                        <th scope="col">Motivo</th>
                        <th scope="col">Profesional</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $end=end($hours);
                        $exit="";
                        $count=0;
                        $numcita=1;
                        while ($end != $exit) {
                            if (isset($hours[$count])){
                                $cita="cita$numcita";
                                echo "<tr>
                                        <td scope='col'>Cita $numcita</td>
                                        <td scope='col'>$day</td>
                                        <td scope='col'>$hours[$count]</td>
                                        <td scope='col'>$reason</td>
                                        <td scope='col'>$professional</td>
                                        <td scope='col'>
                                                <label for=$cita>Reservar cita</label>
                                                <input type='checkbox' id=$cita name=$hours[$count]> 
                                        </td>
                                    </tr>";
                                if (isset($citasdisp)) {
                                    array_push($citasdisp,$hours[$count]);
                                }
                                else {
                                    $citasdisp=[$hours[$count]];
                                }   
                                $numcita+=1;
                            }
                            if (isset($hours[$count])){
                                $exit=$hours[$count];
                            }
                            $count+=1;
                        }
                    ?>
                </tbody>
            </table>
            <input type='submit' value='Reservar'>                           
        </form>
    </article>
</body>
</html>