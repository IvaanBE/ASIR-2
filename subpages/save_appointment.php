<?php
    session_start();
    $servername="127.0.0.1";
    $database="bdd_taller";
    $username="alu";
    $userpass="123";
    $conn=mysqli_connect($servername, $username, $userpass, $database);
    $hours=['8:30','10:00','11:30','13:00','14:30'];
    for ($i=0; $i<5; $i++) {
        if (isset($_POST[$hours[$i]])) {
            $email=$_SESSION['email'];
            $employeeid=$_SESSION['profeid'];
            $day=$_SESSION['day'];
            $reason=$_SESSION['reason'];
            $hour=$hours[$i];
            $seluserid="SELECT id FROM usuarios
                        WHERE email = '$email';";
            $result=$conn->query($seluserid);
            while ($row=$result->fetch_assoc()){
                $userid=$row['id'];
            }
            $inssertappo="INSERT INTO citas (id_cliente,id_empleado,fecha,hora,motivo) 
                            VALUES ('$userid','$employeeid','$day','$hour','$reason');";
            $conn->query($inssertappo);
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
</head>
<body>
    <h1>Su cita ha sido reservada correctamentae <a href="user_page.php">Volver al inicio</a></h1>
</body>
</html>