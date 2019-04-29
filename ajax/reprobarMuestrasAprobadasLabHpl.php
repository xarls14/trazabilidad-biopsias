<?php 
if(isset($_POST['id']) && isset($_POST['id']) != ""){
	
	include ("../config.php");

	$paciente_id = $_POST['id'];

	/*Modificadion de muestra de aprobada a rechazada*/

	mysqli_autocommit($link, false);
			//query para realizar insert de una trazabilidad tomando la id de la muestra (id_muestra) con esto se rechaza una muestra ya aprobada por hpl

            $query = "INSERT INTO trazabilidad(estado_trazabilidad, fecha_estado, muestras_id_muestra) VALUES('RECHAZADO HPL', now(), '$paciente_id')";

			mysqli_query($link, $query);

            mysqli_commit($link);

	if(!$result = mysqli_query($link, $query)){
		mysqli_rollback($con);
		exit(mysqli_error($link));
	}
	echo("Se ha ingresado correctamente la trazabilidad.");
}
 ?>