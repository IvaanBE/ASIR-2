<?php
    session_start();
    $servername="127.0.0.1";
    $database="bdd_taller";
    $username="alu";
    $userpass="123";
    $conn=mysqli_connect($servername, $username, $userpass, $database);
    if (!$conn) {
        die("<p>Se ha producido un error, espere unos minutoss e intentelo de nuevo</p>");
    }
    else {
        $selemple="SELECT * FROM empleados;";
        $result=$conn->query($selemple);
        $emple=array();
        while ($row=$result->fetch_assoc()) {
            if ($emple=="") {
                $emple=[$row['id_empleado'],$row['nombre'],$row['apellidos'],$row['especialidad']];
    
            }
            else {
                array_push($emple,$row['id_empleado'],$row['nombre'],$row['apellidos'],$row['especialidad']);
            }
        }
        $selusu="SELECT * FROM usuarios;";
        $result=$conn->query($selusu);
        $usu=array();
        while ($row=$result->fetch_assoc()) {
            if ($usu=="") {
                $usu=[$row['id'],$row['nombre'],$row['apellidos'],$row['email'], $row['contraseña'], $row['rol']];
    
            }
            else {
                array_push($usu,$row['id'],$row['nombre'],$row['apellidos'],$row['email'], $row['contraseña'], $row['rol']);
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
    <link rel="stylesheet" href="../styles/admin_page.css">
    <title><?php echo "Pagina de ".$username ?></title>
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
            <table class="table">
                <h2>Trabajadores:</h2>
                    <tr class="thead-dark">
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellidos</th>
                        <th scope="col">Especialidad</th>
                        <th scope="col">Opciones</th>
                    </tr>
                    <tr class='table-active'>
                        <form action="adm_save_emp.php" method="post">
                                <td scope='col'>Auto</td>
                                <td scope='col'>
                                    <label for="name"></label>
                                    <input type="text" id="name" name="name">
                                </td>
                                <td scope='col'>
                                    <label for="lastname"></label>
                                    <input type="text" id="lastname" name="lastname">
                                </td>
                                <td scope='col'>
                                    <label for="especialidad"></label>
                                    <input type="text" id="especialidad" name="especialidad">
                                </td>
                                <td scope='col'>
                                    <input type="submit" value="Registrar empleado">        
                                </td>
                        </form>
                    </tr>
                    <?php
                        $key1=0; 
                        $key2=1;
                        $key3=2;
                        $key4=3;
                        $count=count($emple)/4;
                        for ($i=1; $i<=$count; $i++){
                            echo"<tr class='table-active'>
                                    <td scope='col'>$emple[$key1]</td>
                                    <td scope='col'>$emple[$key2]</td>
                                    <td scope='col'>$emple[$key3]</td>
                                    <td scope='col'>$emple[$key4]</td>
                                    <td>
                                        <a href='remove_emp.php ?id=".$emple[$key1]."'>Eliminar empleado</a><br>
                                        <a href='appointments_emp.php ?id=".$emple[$key1]."'>Ver citas</a>         
                                    </td> 
                                </tr>";
                            $key1+=4;
                            $key2+=4;
                            $key3+=4;
                            $key4+=4;
                        }
                    ?>
            </table>
        </div>
        <div>
            <h2>Usuarios:</h2>
            <table class="table">
                    <tr class="thead-dark">
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellidos</th>
                        <th scope="col">Email</th>
                        <th scope="col">Contraseña</th>
                        <th scope="col">Rol</th>
                        <th scope="col">Opciones</th>
                    </tr>
                    <tr class='table-active'>
                        <form action="adm_save_user.php" method="post">
                                <td scope='col'>Auto</td>
                                <td scope='col'>
                                    <label for="name"></label>
                                    <input type="text" id="name" name="name">
                                </td>
                                <td scope='col'>
                                    <label for="lastname"></label>
                                    <input type="text" id="lastname" name="lastname">
                                </td>
                                <td scope='col'>
                                    <label for="email"></label>
                                    <input type="text" id="email" name="email">
                                </td>
                                <td scope='col'>
                                    <label for="pass"></label>
                                    <input type="text" id="pass" name="pass">
                                </td>
                                <td scope='col'>
                                    <label for="rol"></label>
                                    <input type="text" id="rol" name="rol">
                                </td>
                                <td scope='col'>
                                    <input type="submit" value="Registrar usuario">        
                                </td>
                        </form>
                    </tr>
                    <?php
                        $key1=0; 
                        $key2=1;
                        $key3=2;
                        $key4=3;
                        $key5=4;
                        $key6=5;
                        $count=count($usu)/6;
                        for ($i=1; $i<=$count; $i++){
                            echo"<tr class='table-active'>
                                    <td scope='col'>$usu[$key1]</td>
                                    <td scope='col'>$usu[$key2]</td>
                                    <td scope='col'>$usu[$key3]</td>
                                    <td scope='col'>$usu[$key4]</td>
                                    <td scope='col'>$usu[$key5]</td>
                                    <td scope='col'>$usu[$key6]</td>
                                    <td  scope='col'>
                                        <a href='remove_usu.php ?id=".$usu[$key1]."'>Eliminar usuario</a><br>
                                        <a href='appointments_usu.php ?id=".$usu[$key1]."'>Ver citas</a>         
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