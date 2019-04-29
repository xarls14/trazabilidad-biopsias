<?php 
// include Database connection file

include ("../config.php");

 
//para actualizar al paciente antes debemos obtener los datos de el
if(isset($_POST['id']) && isset($_POST['id']) != "")
{
    // obtenemos id del paciente
    $paciente_id = $_POST['id'];
 
    // con este select podemos leer los datos del paciente y poder imprimir las muestras

    $query = "SELECT *
                from pacientes p
                inner join muestras m on p.id_paciente = m.pacientes_id_paciente
                inner join trazabilidad t on m.id_muestra = t.muestras_id_muestra
                where m.id_muestra = '$paciente_id'
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