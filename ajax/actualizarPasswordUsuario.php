<!--php para actualizar password de los usuarios-->
<?php
include ("../config.php");
session_start(); 
 
// check request

    //resumen funcion de cambiar contraseña para usuarios. siempre esta marcando que la antigua contraseña no coincide

    $id_usuario = $_SESSION['id_usuario'];
    $query = "SELECT * FROM usuarios WHERE id_usuario = '$id_usuario'";

    $q = mysqli_query($link, $query);

    while($row = mysqli_fetch_array($q)){
        $antiguaPasswordDb = password_hash($row['password'], PASSWORD_DEFAULT);
    }

    if ($id_usuario) {
        //usuario logeado
        //if(isset($_POST['submit'])){
            //verificamos campos
            
            $antigua_password = password_hash($_POST['antigua_password'], PASSWORD_DEFAULT);
            $nueva_password = password_hash($_POST['nueva_password'], PASSWORD_DEFAULT);
            $conf_nueva_password = password_hash($_POST['conf_nueva_password'], PASSWORD_DEFAULT);
            if ($antigua_password == $antiguaPasswordDb) {
                if ($nueva_password == $conf_nueva_password) {
                    //aprobado
                    //cambiamos la password en la db
                    $querychange = mysqli_query("UPDATE usuarios SET password = '$nueva_password' WHERE id_usuario = '$id_usuario'");
                    session_destroy();
                    echo "La password ha sido cambiada exitosamente.";
                    header("location: login.php");
                }else{
                    echo "Las nuevas contraseñas no coinciden.";
                }
            }else{
                echo "Las antiguas contraseñas no coinciden.";
            }
        //}//termina usuario logeado
    }
