<?php 
// include Database connection file

include ("../config.php");

 
//para actualizar al paciente antes debemos obtener los datos de el
if(isset($_POST['id']) && isset($_POST['id']) != "")
{
    // obtenemos id del paciente
    $paciente_id = $_POST['id'];
 
    // select a pacientes donde la id del paciente sera la id del paciente seleccionado

    /*$query = "SELECT *
                from pacientes p
                inner join muestras m on p.id_paciente = m.pacientes_id_paciente
                inner join trazabilidad t on m.id_muestra = t.muestras_id_muestra
                where m.id_muestra = t.muestras_id_muestra and p.id_paciente = '$paciente_id'
                group by m.id_muestra ORDER BY p.id_paciente DESC";*/

    //select para modificar muestra pero trayendo informacion del paciente, muestras y trazabilidad
    $query = "SELECT *
                from pacientes p
                inner join muestras m on p.id_paciente = m.pacientes_id_paciente
                inner join trazabilidad t on m.id_muestra = t.muestras_id_muestra
                where $paciente_id = t.muestras_id_muestra
                group by m.id_muestra ORDER BY p.id_paciente DESC";            

    if (!$result = mysqli_query($link, $query)) {
        exit(mysqli_error($link));
    }
    $response = array();
    if(mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $response = $row;
        }
    }
    else
    {
        $response['status'] = 200;
        $response['message'] = "Data not found!";
    }
    // display JSON data
    echo json_encode($response);
}
else
{
    $response['status'] = 200;
    $response['message'] = "Invalid Request!";
}
?>