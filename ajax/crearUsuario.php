<?php
    if(isset($_POST['usuario_rut']) && isset($_POST['password']) && isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['email']) && isset($_POST['selectUnidad']) && isset($_POST['selectUsuario']))
    {
        include ("../config.php");

        //asignamos variables enviadas por la data de script.js

        $usuario_rut = mysqli_real_escape_string($link, $_POST["usuario_rut"]);  
        $password = mysqli_real_escape_string($link, $_POST["password"]); 

        //enscriptamos la password con funcion password_hash
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $nombre = mysqli_real_escape_string($link, $_POST["nombre"]);  
        $apellido = mysqli_real_escape_string($link, $_POST["apellido"]); 
        $email = mysqli_real_escape_string($link, $_POST["email"]);  
        $selectUnidad = mysqli_real_escape_string($link, $_POST["selectUnidad"]);
        $selectUsuario = mysqli_real_escape_string($link, $_POST["selectUsuario"]);


        //realizamos insert de usuario con los campos ingresados
        $query = "INSERT INTO usuarios(rut, password, nombre, apellido, email, fecha_creacion, tipo_usuario, areas_id_area) VALUES (
        '$usuario_rut', '$password_hash', '$nombre', '$apellido', '$email', now(), '$selectUsuario', '$selectUnidad')";

        if (!$result = mysqli_query($link, $query)){
            exit(mysqli_error($link));
        }
        echo "Usuario creado correctamente";
    }
?>