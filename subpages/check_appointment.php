<?php
    if (isset($_POST['day']) and isset($_POST['reason'])) {
        if ($_POST['day'] !='' and $_POST['reason'] !='') {
            $day=$_POST['day'];
            $reason=$_POST['reason'];
            $today=$_SESSION['today'];
            if ($day > $today) {
                session_start();
                $_SESSION['day']=$day;
                $_SESSION['today']=$today;
                $_SESSION['reason']=$reason;
                header("Location:avaible_appointment.php");
            }
            else {
                session_start();
                $mensaje="<div><p>Debes introducir una fecha superior a la actual.</p></div>";
                $_SESSION['mensaje']=$mensaje;
                header("Location:appointment.php");  
            }
        }
        else {
            session_start();
            $mensaje="<div><p>Por favor seleccione una cita para eservar.</p></div>";
            $_SESSION['mensaje']=$mensaje;
            header('Location:appointment.php');  
        }
    }
    else {
        session_start();
        $mensaje="<div><p>Debes completar todos los campos.</p></div>";
        $_SESSION['mensaje']=$mensaje;
        header('Location:appointment.php');
    }
?>