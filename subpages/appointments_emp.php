<?php
    session_start();
    if (isset($_SESSION['id_emp'])) {
        $id_emp=$_SESSION['id_emp'];
    }
    else {
        $id_emp=$_REQUEST['id'];
        $_SESSION['id_emp']=$id_emp;
    }
    $servername="127.0.0.1";
    $database="bdd_taller";
    $username="alu";
    $userpass="123";
    //Conexion con la bdd
    $conn=mysqli_connect($servername, $username, $userpass, $database);
    $selcitas="SELECT * FROM citas
                WHERE id_empleado = $id_emp;";
    $result=$conn->query($selcitas);
    $citas=array();
    while ($row=$result->fetch_assoc()) {
        if ($citas=="") {
            $citas=[$row['id_cita'],$row['id_cliente'],$row['id_empleado'],$row['fecha'],$row['hora'],$row['motivo']];

        }
        else {
            array_push($citas,$row['id_cita'],$row['id_cliente'],$row['id_empleado'],$row['fecha'],$row['hora'],$row['motivo']);
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
    <link rel="stylesheet" href="../styles/admin_page.css">
    <title>removig your appointment</title>
</head>
<body>
    <header>
        <nav class="navbar navbar-dark bg-dark">
                <a href="admin_page.php" class="navlink">Inicio</a>                               
                <a href="#" class="navlink">Mi perfil</a>                 
                <a href="close_session.php" class="navlink">Cerrar sesion</a>
        </nav><br>
    </header>
    <article>
        <div>
            <h2>Citas:</h2>
            <table class="table">
                    <tr class="thead-dark">
                        <th scope="col">ID_Cita</th>
                        <th scope="col">ID_Cliente</th>
                        <th scope="col">ID_Empleado</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Hora</th>
                        <th scope="col">Motivo</th>
                        <th scope="col">Opciones</th>
                    </tr>
                    <?php
                        $key1=0; 
                        $key2=1;
                        $key3=2;
                        $key4=3;
                        $key5=4;
                        $key6=5;
                        $count=count($citas)/6;
                        for ($i=1; $i<=$count; $i++){
                            echo"<tr class='table-active'>
                                    <td scope='col'>$citas[$key1]</td>
                                    <td scope='col'>$citas[$key2]</td>
                                    <td scope='col'>$citas[$key3]</td>
                                    <td scope='col'>$citas[$key4]</td>
                                    <td scope='col'>$citas[$key5]</td>
                                    <td scope='col'>$citas[$key6]</td>
                                    <td>
                                        <a href='remove_appo2.php ?id=".$citas[$key1]."'>Eliminar cita</a><br>       
                                    </td> 
                                </tr>";
                            $key1+=6;
                            $key2+=6;
                            $key3+=6;
                            $key4+=6;
                            $key5+=6;
                            $key6+=6;
                        }
                    ?>
                </table>
        </div>
    </article>
</body>
</html>