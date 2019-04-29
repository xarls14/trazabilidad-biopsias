
<?php

include ("../config.php");
 
// check request
if(isset($_POST))
{
    //tomamos los datos que vienen de los script y se asignan a una nueva variable
    $id = mysqli_real_escape_string($link, $_POST["id"]);  
    $nombres = mysqli_real_escape_string($link, $_POST["nombres"]);  
    $apellidos = mysqli_real_escape_string($link, $_POST["apellidos"]); 
    $rut = mysqli_real_escape_string($link, $_POST["rut"]);  
    $tipo_muestra = mysqli_real_escape_string($link, $_POST["tipo_muestra"]); 
    $unidad_origen = mysqli_real_escape_string($link, $_POST["unidad_origen"]);  
    $num_frasco = mysqli_real_escape_string($link, $_POST["num_frasco"]); 
    
 
    //realizamos actualizacion de pacientes por medio de vista independiente en administrador
    $query = "UPDATE pacientes SET establecimiento_origen = 'HPL' , areas_id_area = '$unidad_origen', nombres = '$nombres', apellidos = '$apellidos', rut = '$rut' WHERE id_paciente = '$id'";


    if (!$result = mysqli_query($link, $query)) {
        exit(mysqli_error($link));
    }
    echo "Paciente actualizado correctamente.";

}