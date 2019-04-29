<!-- solo en caso de necesitar modificar se llama desde la funcion y se modifica la tabla actualizarTablaLabRechazadosHigueras -->

<?php 
if(isset($_POST['id']) && isset($_POST['id']) != ""){
	
	include ("../config.php");

	$paciente_id = $_POST['id'];


	mysqli_autocommit($link, false);

            $query = "UPDATE trazabilidad SET estado_trazabilidad = 'RECIBIDO HIGUERAS' WHERE muestras_id_muestra = '$paciente_id'";

			mysqli_query($link, $query);

            mysqli_commit($link);

	if(!$result = mysqli_query($link, $query)){
		mysqli_rollback($con);
		exit(mysqli_error($link));
	}
	echo("Se ha actualizado correctamente la trazabilidad.");
}
 ?>