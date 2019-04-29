
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
    $cirujano = mysqli_real_escape_string($link, $_POST["cirujano"]); 
 
    /*comprobado que se puede agregar trazabilidad y cambiar el estado*/
    
    //$query = "UPDATE pacientes, muestras SET nombres = '$nombres', apellidos = '$apellidos', rut = '$rut', tipo_muestra = '$tipo_muestra', establecimiento_origen = 'HPL' , areas_id_area = '$unidad_origen', num_frasco = '$num_frasco' WHERE id_paciente = '$id' AND pacientes_id_paciente = '$id'";

    /*$query = "UPDATE pacientes, muestras SET tipo_muestra = '$tipo_muestra', establecimiento_origen = 'HPL' , areas_id_area = '$unidad_origen', num_frasco = '$num_frasco' WHERE id_muestra = '$id'";*/

    $query = "UPDATE  muestras SET tipo_muestra = '$tipo_muestra', num_frasco = '$num_frasco', cirujano = '$cirujano' WHERE id_muestra = '$id'";

    if (!$result = mysqli_query($link, $query)) {
        exit(mysqli_error($link));
    }
    echo "Muestra actualizada correctamente.";

}