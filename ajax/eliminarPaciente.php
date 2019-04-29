<?php 
if(isset($_POST['id']) && isset($_POST['id']) != ""){
	
	include ("../config.php");

	$paciente_id = $_POST['id'];

	//para realizar el eliminado de un paciente ahora debemos eliminar primero la trazabilidad -> muestra -> paciente

	/*$query = "DELETE FROM pacientes, muestras, trazabilidad WHERE id_paciente = '$paciente_id'";*/

	mysqli_autocommit($link, false);

            $query = "DELETE t
			FROM pacientes p
			INNER JOIN muestras m
			ON p.id_paciente = m.pacientes_id_paciente
			INNER JOIN trazabilidad t
			ON m.id_muestra = t.muestras_id_muestra
			where m.id_muestra = '$paciente_id'";

			mysqli_query($link, $query);

			$query = "DELETE FROM muestras WHERE id_muestra = '$paciente_id'";

            mysqli_query($link, $query);

            mysqli_commit($link);

	if(!$result = mysqli_query($link, $query)){
		mysqli_rollback($con);
		exit(mysqli_error($link));
	}
	echo("Se ha eliminado el paciente correctamente.");
}
 ?>