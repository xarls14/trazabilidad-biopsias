<?php
    session_start();
    if(isset($_POST['nombres']) && isset($_POST['apellidos']) && isset($_POST['rut']) && isset($_POST['tipo_muestra']) && isset($_POST['unidad_origen']) && isset($_POST['num_frasco']) && isset($_POST['cirujano']))
    {
        include ("../config.php");

        
        $nombres = mysqli_real_escape_string($link, $_POST["nombres"]);  
        $apellidos = mysqli_real_escape_string($link, $_POST["apellidos"]); 
        $rut = mysqli_real_escape_string($link, $_POST["rut"]);  
        $unidad_origen = mysqli_real_escape_string($link, $_POST["unidad_origen"]); 
        $cirujano = mysqli_real_escape_string($link, $_POST["cirujano"]); 
        //$tipo_muestra = mysqli_real_escape_string($link, $_POST["tipo_muestra"]); 
        //$num_frasco = mysqli_real_escape_string($link, $_POST["num_frasco"]); 

        //array combine para obtener tipo de muestra y num frasco
        foreach (array_combine($_POST["tipo_muestra"], $_POST["num_frasco"]) as $f =>$n) {
            echo "tipo_muestra: ".$f."<br>"."num_frasco :".$n;
            echo "<br>";
        }


        //cuando el usuario es admin, ingresamos la unidad del paciente con el select si es otro tipo de usuario la unidad de setea de manera automatica dependiendo del usuario y area del usuario
            
            if($_SESSION['tipo_usuario'] == "Administrador"){

                mysqli_autocommit($link, false);
                $flag = true;

                $query1 = "INSERT INTO pacientes(nombres, apellidos, rut, fecha_ingreso, establecimiento_origen, areas_id_area) VALUES('$nombres','$apellidos','$rut', now(), 'HPL', '$unidad_origen')";

                $result = mysqli_query($link, $query1);

                $idPaciente = mysqli_insert_id($link);
                echo $idPaciente;
                echo "<br>";
                
                if(!$result){
                    $flag = false;
                    echo "Detalles de error: ".mysqli_error($link).".";
                }
                
                foreach (array_combine($_POST["tipo_muestra"], $_POST["num_frasco"]) as $tipo_muestra =>$num_frasco) {    

                    echo "tipo_muestra: ".$tipo_muestra."<br>"."num_frasco :".$num_frasco;
                    echo "<br>";

                    $query2 = "INSERT INTO muestras(tipo_muestra, num_frasco, pacientes_id_paciente, cirujano) 
                    VALUES('$tipo_muestra', '$num_frasco', '$idPaciente', '$cirujano')";

                    $result = mysqli_query($link, $query2);
                    $idMuestra = mysqli_insert_id($link);
                    echo ($idMuestra);
                    echo "<br>";

                    if(!$result){
                        $flag = false;
                        echo "Detalles de error: ".mysqli_error($link).".";
                    }

                    $query3 = "INSERT INTO trazabilidad(estado_trazabilidad, fecha_estado, muestras_id_muestra)
                    VALUES('SIN ESTADO', now(), '$idMuestra')"; 

                    $result = mysqli_query($link, $query3);
                    $idTrazabilidad = mysqli_insert_id($link);
                    echo ($idTrazabilidad);
                    echo "<br>";
                    
                    if(!$result){
                        $flag = false;
                        echo "Detalles de error: ".mysqli_error($link).".";
                    }

                    if($flag){
                        mysqli_commit($link);
                        echo "Paciente ingresado correctamente";
                    }else{
                        mysqli_rollback($link);
                        echo "All queries were rolled back";
                    }           
                }   

        }else{
            //sino dependiendo del area del usuario se setea automatica la unidad del paciente
            switch ($_SESSION['areas_id_area']){
            
            case '1':// Pabellon
    
                mysqli_autocommit($link, false);
                $flag = true;

                $query1 = "INSERT INTO pacientes(nombres, apellidos, rut, fecha_ingreso, establecimiento_origen, areas_id_area) VALUES('$nombres','$apellidos','$rut', now(), 'HPL', '1')";

                $result = mysqli_query($link, $query1);

                $idPaciente = mysqli_insert_id($link);
                echo $idPaciente;
                echo "<br>";
                
                if(!$result){
                    $flag = false;
                    echo "Detalles de error: ".mysqli_error($link).".";
                }
                
                foreach (array_combine($_POST["tipo_muestra"], $_POST["num_frasco"]) as $tipo_muestra =>$num_frasco){    

                    echo "tipo_muestra: ".$tipo_muestra."<br>"."num_frasco :".$num_frasco;
                    echo "<br>";

                    $query2 = "INSERT INTO muestras(tipo_muestra, num_frasco, pacientes_id_paciente, cirujano) 
                    VALUES('$tipo_muestra', '$num_frasco', '$idPaciente', '$cirujano')";

                    $result = mysqli_query($link, $query2);
                    $idMuestra = mysqli_insert_id($link);
                    echo ($idMuestra);
                    echo "<br>";

                    if(!$result){
                        $flag = false;
                        echo "Detalles de error: ".mysqli_error($link).".";
                    }

                    $query3 = "INSERT INTO trazabilidad(estado_trazabilidad, fecha_estado, muestras_id_muestra)
                    VALUES('SIN ESTADO', now(), '$idMuestra')"; 

                    $result = mysqli_query($link, $query3);
                    $idTrazabilidad = mysqli_insert_id($link);
                    echo ($idTrazabilidad);
                    echo "<br>";
                    
                    if(!$result){
                        $flag = false;
                        echo "Detalles de error: ".mysqli_error($link).".";
                    }

                    if($flag){
                        mysqli_commit($link);
                        echo "Paciente ingresado correctamente";
                    }else{
                        mysqli_rollback($link);
                        echo "All queries were rolled back";
                    }
                }
            break;

            case '2'://Endoscopia
                mysqli_autocommit($link, false);
                $flag = true;

                $query1 = "INSERT INTO pacientes(nombres, apellidos, rut, fecha_ingreso, establecimiento_origen, areas_id_area) VALUES('$nombres','$apellidos','$rut', now(), 'HPL', '2')";

                $result = mysqli_query($link, $query1);

                $idPaciente = mysqli_insert_id($link);
                echo $idPaciente;
                echo "<br>";
                
                if(!$result){
                    $flag = false;
                    echo "Detalles de error: ".mysqli_error($link).".";
                }
                
                foreach (array_combine($_POST["tipo_muestra"], $_POST["num_frasco"]) as $tipo_muestra =>$num_frasco){    

                    echo "tipo_muestra: ".$tipo_muestra."<br>"."num_frasco :".$num_frasco;
                    echo "<br>";

                    $query2 = "INSERT INTO muestras(tipo_muestra, num_frasco, pacientes_id_paciente, cirujano) 
                    VALUES('$tipo_muestra', '$num_frasco', '$idPaciente', '$cirujano')";

                    $result = mysqli_query($link, $query2);
                    $idMuestra = mysqli_insert_id($link);
                    echo ($idMuestra);
                    echo "<br>";

                    if(!$result){
                        $flag = false;
                        echo "Detalles de error: ".mysqli_error($link).".";
                    }

                    $query3 = "INSERT INTO trazabilidad(estado_trazabilidad, fecha_estado, muestras_id_muestra)
                    VALUES('SIN ESTADO', now(), '$idMuestra')"; 

                    $result = mysqli_query($link, $query3);
                    $idTrazabilidad = mysqli_insert_id($link);
                    echo ($idTrazabilidad);
                    echo "<br>";
                    
                    if(!$result){
                        $flag = false;
                        echo "Detalles de error: ".mysqli_error($link).".";
                    }

                    if($flag){
                        mysqli_commit($link);
                        echo "Paciente ingresado correctamente";
                    }else{
                        mysqli_rollback($link);
                        echo "All queries were rolled back";
                    }
                } 
            break;

            case "3"://Hospitalizados
                mysqli_autocommit($link, false);
                $flag = true;

                $query1 = "INSERT INTO pacientes(nombres, apellidos, rut, fecha_ingreso, establecimiento_origen, areas_id_area) VALUES('$nombres','$apellidos','$rut', now(), 'HPL', '3')";

                $result = mysqli_query($link, $query1);

                $idPaciente = mysqli_insert_id($link);
                echo $idPaciente;
                echo "<br>";
                
                if(!$result){
                    $flag = false;
                    echo "Detalles de error: ".mysqli_error($link).".";
                }
                
                foreach (array_combine($_POST["tipo_muestra"], $_POST["num_frasco"]) as $tipo_muestra =>$num_frasco){    

                    echo "tipo_muestra: ".$tipo_muestra."<br>"."num_frasco :".$num_frasco;
                    echo "<br>";

                    $query2 = "INSERT INTO muestras(tipo_muestra, num_frasco, pacientes_id_paciente, cirujano) 
                    VALUES('$tipo_muestra', '$num_frasco', '$idPaciente', '$cirujano')";

                    $result = mysqli_query($link, $query2);
                    $idMuestra = mysqli_insert_id($link);
                    echo ($idMuestra);
                    echo "<br>";

                    if(!$result){
                        $flag = false;
                        echo "Detalles de error: ".mysqli_error($link).".";
                    }

                    $query3 = "INSERT INTO trazabilidad(estado_trazabilidad, fecha_estado, muestras_id_muestra)
                    VALUES('SIN ESTADO', now(), '$idMuestra')"; 

                    $result = mysqli_query($link, $query3);
                    $idTrazabilidad = mysqli_insert_id($link);
                    echo ($idTrazabilidad);
                    echo "<br>";
                    
                    if(!$result){
                        $flag = false;
                        echo "Detalles de error: ".mysqli_error($link).".";
                    }

                    if($flag){
                        mysqli_commit($link);
                        echo "Paciente ingresado correctamente";
                    }else{
                        mysqli_rollback($link);
                        echo "All queries were rolled back";
                    }
                }  
            break;

            case "4"://Especialidades
                mysqli_autocommit($link, false);
                $flag = true;

                $query1 = "INSERT INTO pacientes(nombres, apellidos, rut, fecha_ingreso, establecimiento_origen, areas_id_area) VALUES('$nombres','$apellidos','$rut', now(), 'HPL', '4')";

                $result = mysqli_query($link, $query1);

                $idPaciente = mysqli_insert_id($link);
                echo $idPaciente;
                echo "<br>";
                
                if(!$result){
                    $flag = false;
                    echo "Detalles de error: ".mysqli_error($link).".";
                }
                
                foreach (array_combine($_POST["tipo_muestra"], $_POST["num_frasco"]) as $tipo_muestra =>$num_frasco){    

                    echo "tipo_muestra: ".$tipo_muestra."<br>"."num_frasco :".$num_frasco;
                    echo "<br>";

                    $query2 = "INSERT INTO muestras(tipo_muestra, num_frasco, pacientes_id_paciente, cirujano) 
                    VALUES('$tipo_muestra', '$num_frasco', '$idPaciente', '$cirujano')";

                    $result = mysqli_query($link, $query2);
                    $idMuestra = mysqli_insert_id($link);
                    echo ($idMuestra);
                    echo "<br>";

                    if(!$result){
                        $flag = false;
                        echo "Detalles de error: ".mysqli_error($link).".";
                    }

                    $query3 = "INSERT INTO trazabilidad(estado_trazabilidad, fecha_estado, muestras_id_muestra)
                    VALUES('SIN ESTADO', now(), '$idMuestra')"; 

                    $result = mysqli_query($link, $query3);
                    $idTrazabilidad = mysqli_insert_id($link);
                    echo ($idTrazabilidad);
                    echo "<br>";
                    
                    if(!$result){
                        $flag = false;
                        echo "Detalles de error: ".mysqli_error($link).".";
                    }

                    if($flag){
                        mysqli_commit($link);
                        echo "Paciente ingresado correctamente";
                    }else{
                        mysqli_rollback($link);
                        echo "All queries were rolled back";
                    }
                } 
            break;

            case "5"://Laboratorio
                mysqli_autocommit($link, false);
                $flag = true;

                $query1 = "INSERT INTO pacientes(nombres, apellidos, rut, fecha_ingreso, establecimiento_origen, areas_id_area) VALUES('$nombres','$apellidos','$rut', now(), 'HPL', '5')";

                $result = mysqli_query($link, $query1);

                $idPaciente = mysqli_insert_id($link);
                echo $idPaciente;
                echo "<br>";
                
                if(!$result){
                    $flag = false;
                    echo "Detalles de error: ".mysqli_error($link).".";
                }
                
                foreach (array_combine($_POST["tipo_muestra"], $_POST["num_frasco"]) as $tipo_muestra =>$num_frasco){    

                    echo "tipo_muestra: ".$tipo_muestra."<br>"."num_frasco :".$num_frasco;
                    echo "<br>";

                    $query2 = "INSERT INTO muestras(tipo_muestra, num_frasco, pacientes_id_paciente, cirujano) 
                    VALUES('$tipo_muestra', '$num_frasco', '$idPaciente', '$cirujano')";

                    $result = mysqli_query($link, $query2);
                    $idMuestra = mysqli_insert_id($link);
                    echo ($idMuestra);
                    echo "<br>";

                    if(!$result){
                        $flag = false;
                        echo "Detalles de error: ".mysqli_error($link).".";
                    }

                    $query3 = "INSERT INTO trazabilidad(estado_trazabilidad, fecha_estado, muestras_id_muestra)
                    VALUES('SIN ESTADO', now(), '$idMuestra')"; 

                    $result = mysqli_query($link, $query3);
                    $idTrazabilidad = mysqli_insert_id($link);
                    echo ($idTrazabilidad);
                    echo "<br>";
                    
                    if(!$result){
                        $flag = false;
                        echo "Detalles de error: ".mysqli_error($link).".";
                    }

                    if($flag){
                        mysqli_commit($link);
                        echo "Paciente ingresado correctamente";
                    }else{
                        mysqli_rollback($link);
                        echo "All queries were rolled back";
                    }
                }  
            break;

            case "6"://Urgencias
                mysqli_autocommit($link, false);
                $flag = true;

                $query1 = "INSERT INTO pacientes(nombres, apellidos, rut, fecha_ingreso, establecimiento_origen, areas_id_area) VALUES('$nombres','$apellidos','$rut', now(), 'HPL', '6')";

                $result = mysqli_query($link, $query1);

                $idPaciente = mysqli_insert_id($link);
                echo $idPaciente;
                echo "<br>";
                
                if(!$result){
                    $flag = false;
                    echo "Detalles de error: ".mysqli_error($link).".";
                }
                
                foreach (array_combine($_POST["tipo_muestra"], $_POST["num_frasco"]) as $tipo_muestra =>$num_frasco){    

                    echo "tipo_muestra: ".$tipo_muestra."<br>"."num_frasco :".$num_frasco;
                    echo "<br>";

                    $query2 = "INSERT INTO muestras(tipo_muestra, num_frasco, pacientes_id_paciente, cirujano) 
                    VALUES('$tipo_muestra', '$num_frasco', '$idPaciente', '$cirujano')";

                    $result = mysqli_query($link, $query2);
                    $idMuestra = mysqli_insert_id($link);
                    echo ($idMuestra);
                    echo "<br>";

                    if(!$result){
                        $flag = false;
                        echo "Detalles de error: ".mysqli_error($link).".";
                    }

                    $query3 = "INSERT INTO trazabilidad(estado_trazabilidad, fecha_estado, muestras_id_muestra)
                    VALUES('SIN ESTADO', now(), '$idMuestra')"; 

                    $result = mysqli_query($link, $query3);
                    $idTrazabilidad = mysqli_insert_id($link);
                    echo ($idTrazabilidad);
                    echo "<br>";
                    
                    if(!$result){
                        $flag = false;
                        echo "Detalles de error: ".mysqli_error($link).".";
                    }

                    if($flag){
                        mysqli_commit($link);
                        echo "Paciente ingresado correctamente";
                    }else{
                        mysqli_rollback($link);
                        echo "All queries were rolled back";
                    }
                }  
            break;
            }

        }
        /*if (!$result = mysqli_query($link, $query)) {
            exit(mysqli_error($link));
        }*/        
    }
?>


