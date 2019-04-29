<?php
   session_start(); 
   
   include ("../config.php");
   
   //cuando entramos a las vistas donde necesitamos realizar check (laboratorio y en especialidades adminisrativas) debemos agregar al thead las opciones de laboratorio para validar recepcion de las muestras desde las distintas unidades clinicas y tambien cuando estas llegan desde el hospital higueras
   
   
   //esta variable contendra codigo html y php de la tabla que se muestra en actualizarTabla()
   switch ($_SESSION['areas_id_area']) { //preguntamos por el area
       case '5'://Laboratorio
               $data = '<table class="display" id="muestra" style="width:100%">
               <thead id="thead-pacientes">
                 <tr>
                   <!--<th>Id</th>
                   <th>Nombres</th>
                   <th>Apellidos</th>-->
                   <th>Paciente</th>
                   <th>Rut</th>
                   <th>Tipo de muestra</th>               
                   <th>N° Frasco</th>
                   <th>Cirujano</th>
                   <th>Unidad</th>
                   <th>Fecha</th>
                   <th>Estado muestra</th>
                   <th>Imprimir</th>
                   
                 </tr>
               </thead>
           ';
           break;
   
       case '4'://Especialidades
   
               $data = '<table class="display" id="muestra" style="width:100%">
               <thead id="thead-pacientes">
                 <tr>
                   <!--<th>Id</th>
                   <th>Nombres</th>
                   <th>Apellidos</th>-->
                   <th>Paciente</th>
                   <th>Rut</th>
                   <th>Tipo de muestra</th>               
                   <th>N° Frasco</th>
                   <th>Cirujano</th>
                   <th>Unidad</th>
                   <th>Fecha</th>
                   <th>Estado muestra</th>
                   <th>Imprimir</th>                  
                 </tr>
               </thead>
           ';
           break;    
       
       default: //si no es ninguno de los casos anteriores mostramos este default
           $data = '<table class="display" id="muestra" style="width:100%">
               <thead id="thead-pacientes">
                 <tr>
                   <!--<th>Id</th>
                   <th>Nombres</th>
                   <th>Apellidos</th>-->
                   <th>Paciente</th>
                   <th>Rut</th>
                   <th>Tipo de muestra</th>               
                   <th>N° Frasco</th>
                   <th>Cirujano</th>
                   <th>Unidad</th>
                   <th>Fecha</th>
                   <th>Estado muestra</th>
                   <th>Opciones</th>
                 </tr>
               </thead>
           ';
           break;
   }
   
   
   
   
   /*id_area_usuarios
   USUARIOS
   1- PABELLON
   2- ENDOSCOPIA
   3- HOSPITALIZADOS
   4- ESPECIALIDADES
   5- LABORATORIO
   6- URGENCIAS
   */
   
   //dependiendo del usuario que loguea se muestran los pacientes que le corresponde a cada tipo de usuario
   if($_SESSION['tipo_usuario'] == "Administrador"){
   
       //como es vista administrador deberia poder ver trazabilidad de una muestra al igual que lab 
       $query = 
               "SELECT * 
               FROM pacientes p
               INNER JOIN muestras m ON p.id_paciente = m.pacientes_id_paciente
               INNER JOIN trazabilidad t ON m.id_muestra = t.muestras_id_muestra
               WHERE fecha_estado = (SELECT MAX(fecha_estado) FROM trazabilidad WHERE m.id_muestra = muestras_id_muestra)

               group by m.id_muestra ORDER BY p.fecha_ingreso DESC";
   
   
   }elseif($_SESSION['tipo_usuario'] == "Administrativo"){
      $query = "SELECT * 
               FROM pacientes p
               INNER JOIN muestras m ON p.id_paciente = m.pacientes_id_paciente
               INNER JOIN trazabilidad t ON m.id_muestra = t.muestras_id_muestra
               WHERE fecha_estado = (SELECT MAX(fecha_estado) FROM trazabilidad WHERE m.id_muestra = muestras_id_muestra 
               )
               group by m.id_muestra ORDER BY p.fecha_ingreso DESC";
   }else{
       //luego de saber si es administrador filtramos la consulta dependiendo del area a la que pertenece
       switch ($_SESSION['areas_id_area']) {//preguntamos por el area 
       case '1'://Pabellon -> mostramos solo pacientes de pabellon
           /*$query = "SELECT *
                     FROM pacientes p
                     INNER JOIN muestras m ON p.id_paciente = m.pacientes_id_paciente
                     INNER JOIN trazabilidad t ON m.id_muestra = t.muestras_id_muestra
                     WHERE m.id_muestra = t.muestras_id_muestra AND p.areas_id_area = 1
                     GROUP BY m.id_muestra ORDER BY p.id_paciente DESC";
           break;*/

           $query = "SELECT *
                     FROM pacientes p
                     INNER JOIN muestras m ON p.id_paciente = m.pacientes_id_paciente
                     INNER JOIN trazabilidad t ON m.id_muestra = t.muestras_id_muestra
                     WHERE fecha_estado = (SELECT MAX(fecha_estado) FROM trazabilidad WHERE m.id_muestra = muestras_id_muestra) AND p.areas_id_area = 1
               group by m.id_muestra ORDER BY p.fecha_ingreso DESC";
           break;
       
       case '2'://Endoscopia -> mostramos solo pacientes de Endoscopia
           $query = "SELECT *
                     FROM pacientes p
                     INNER JOIN muestras m ON p.id_paciente = m.pacientes_id_paciente
                     INNER JOIN trazabilidad t ON m.id_muestra = t.muestras_id_muestra
                     WHERE fecha_estado = (SELECT MAX(fecha_estado) FROM trazabilidad WHERE m.id_muestra = muestras_id_muestra) AND p.areas_id_area = 2
               group by m.id_muestra ORDER BY p.fecha_ingreso DESC";
           break;
       
       case '3'://Hospitalizados -> mostramos solo pacientes de hospitalizados
           $query = "SELECT *
                     FROM pacientes p
                     INNER JOIN muestras m ON p.id_paciente = m.pacientes_id_paciente
                     INNER JOIN trazabilidad t ON m.id_muestra = t.muestras_id_muestra
                     WHERE fecha_estado = (SELECT MAX(fecha_estado) FROM trazabilidad WHERE m.id_muestra = muestras_id_muestra) AND p.areas_id_area = 3
               group by m.id_muestra ORDER BY p.fecha_ingreso DESC";
           break;
   
       case '4'://Especialidades -> mostramos solo pacientes de Especialidades
           $query = "SELECT *
                     FROM pacientes p
                     INNER JOIN muestras m ON p.id_paciente = m.pacientes_id_paciente
                     INNER JOIN trazabilidad t ON m.id_muestra = t.muestras_id_muestra
                     WHERE m.id_muestra = t.muestras_id_muestra AND p.areas_id_area = 4
                     GROUP BY m.id_muestra ORDER BY p.fecha_ingreso DESC";
           break;
   
       case '5'://laboratorio -> mostramos solo pacientes de laboratorio
           $query = "SELECT * 
               FROM pacientes p
               INNER JOIN muestras m ON p.id_paciente = m.pacientes_id_paciente
               INNER JOIN trazabilidad t ON m.id_muestra = t.muestras_id_muestra
               WHERE fecha_estado = (SELECT MAX(fecha_estado) FROM trazabilidad WHERE m.id_muestra = muestras_id_muestra)
               group by m.id_muestra ORDER BY p.fecha_ingreso DESC";
           break; 
   
       case '6'://Urgencias -> mostramos solo pacientes de Urgencias
           $query = "SELECT *
                     FROM pacientes p
                     INNER JOIN muestras m ON p.id_paciente = m.pacientes_id_paciente
                     INNER JOIN trazabilidad t ON m.id_muestra = t.muestras_id_muestra
                     WHERE fecha_estado = (SELECT MAX(fecha_estado) FROM trazabilidad WHERE m.id_muestra = muestras_id_muestra) AND p.areas_id_area = 6
               group by m.id_muestra ORDER BY p.fecha_ingreso DESC";
           break;    
       }
   }
   
   
   if (!$result = mysqli_query($link, $query)) {
    exit(mysqli_error($link));
   }  
   
   if(mysqli_num_rows($result) > 0)
       {
           $number = 1;
           

           while($row = mysqli_fetch_assoc($result))
           {
              //convertimos unidades de origen de numero a palabra
              switch ($row['areas_id_area']){
                case '1':
                $row['areas_id_area'] = 'Pabellon';
                break;
                
                case '2':
                $row['areas_id_area'] = 'Endoscopia y PCM ';
                break;

                case '3':
                $row['areas_id_area'] = 'Hospitalizados';
                break;

                case '4':
                $row['areas_id_area'] = 'Especialidades';
                break;

                case '5':
                $row['areas_id_area'] = 'Laboratorio';
                break;

                case '6':
                $row['areas_id_area'] = 'Urgencias';
                break;
              }

              //switch para cambiar nombre de algunos estados, solo para mostrar a usuarios, no se modificara codigo
              switch ($row['estado_trazabilidad']){
                case 'APROBADO HPL':
                $row['estado_trazabilidad'] = 'APROBADO LAB HPL';
                break;
                
                case 'RECHAZADO HPL':
                $row['estado_trazabilidad'] = 'RECHAZADO LAB HPL';
                break;

                case 'RECIBIDO ADMINISTRATIVO':
                $row['estado_trazabilidad'] = 'RECIBIDO ESPECIALIDADES';
                break;
              }

              //fecha 
               $fecha = $row['fecha_ingreso'];
               $fecha_parseada = explode(" ", $fecha);
               $fecha_chilena = date("d-m-y", strtotime($fecha_parseada[0]));

               /*$rut = $row['rut'];
               $rut_formateado = number_format( substr ( $rut, 0 , -1 ) , 0, "", ".") . '-' . substr ( $rut, strlen($rut) -1 , 1 );*/

                  if ($row['estado_trazabilidad'] == 'APROBADO LAB HPL') {
                    
                    $estadoTrazabilidadBadge = '<span class="badge badge-success">'.$row['estado_trazabilidad'].'</span>';

                  }elseif ($row['estado_trazabilidad'] == 'RECHAZADO LAB HPL') {

                    $estadoTrazabilidadBadge = '<span class="badge badge-danger">'.$row['estado_trazabilidad'].'</span>';

                  }elseif ($row['estado_trazabilidad'] == 'RECIBIDO ESPECIALIDADES') {

                    $estadoTrazabilidadBadge = '<span class="badge badge-success">'.$row['estado_trazabilidad'].'</span>';

                  }elseif ($row['estado_trazabilidad'] == 'SIN ESTADO') {

                    $estadoTrazabilidadBadge = '<span class="badge badge-light">'.$row['estado_trazabilidad'].'</span>';

                  }elseif ($row['estado_trazabilidad'] == 'RECIBIDO HIGUERAS') {

                    $estadoTrazabilidadBadge = '<span class="badge badge-success">'.$row['estado_trazabilidad'].'</span>';

                  }elseif ($row['estado_trazabilidad'] == 'RECHAZADO HIGUERAS') {

                    $estadoTrazabilidadBadge = '<span class="badge badge-danger">'.$row['estado_trazabilidad'].'</span>';

                  }elseif ($row['estado_trazabilidad'] == 'TRANSITO HIGUERAS') {
                    $estadoTrazabilidadBadge = '<span class="badge badge-warning">'.$row['estado_trazabilidad'].'</span>';
                  }

               //preguntamos por el tipo de sesion que trae session y escribimos codigo html/php para cada tipo de usuario logueado (concatenado) 
               switch ($_SESSION['tipo_usuario']) {//tipo de usuario


   
                   case 'Administrador':
                     
                       $data .= '
                       
                       <tr>
                           <td>'.$row['nombres'].' '.$row['apellidos'].'</td>
                           <!--<td>'.$row['apellidos'].'</td>-->
                           <td>'.$row['rut'].'</td>
                           <td>'.$row['tipo_muestra'].'</td>            
                           <td>'.$row['num_frasco'].'</td>
                           <td>'.$row['cirujano'].'</td>
                           <td>'.$row['areas_id_area'].'</td>
                           <td>'.$fecha_chilena.'</td>
                           <td>'.$estadoTrazabilidadBadge.'</td>

                           
                           <td id="botonesTabla">
                               <div class="btn-group" role="group" aria-label="Basic example">
                                 <button onclick="obtenerDatosPacientes('.$row['id_muestra'].')" type="button" class="btn btn-info" data-toggle="modal" data-target="#myModalActualizarPacienteAdmin" data-backdrop="static" data-keyboard="false"><span><i class="fas fa-edit"></i></span></button>
                                 <button onclick="eliminarPaciente('.$row['id_muestra'].')" type="button" class="btn btn-danger"><span><i class="fas fa-trash-alt"></i></span></button>
                                 <button id="botonImprimir" onclick="printRow('.$row['id_muestra'].')" type="button" class="btn btn-success"><span><i class="fas fa-print"></i></span></button>
                               </div>
                           </td>
                       </tr>';
                       break;
                   
                   case 'Jefatura':
   
                   //cuando revisamos el tipo de usuario revisamos el area (laboratorio o especialidades) con el motivo de anexar a la tablas las opciones de recibido y aprobado en laborarorio y recibido en administrativo 
   
   
                       if($_SESSION['areas_id_area'] == "5"){//preguntamos por jefatura laboratorios
                           $data .= '
                       
                       <tr>
                           <td>'.$row['nombres'].' '.$row['apellidos'].'</td>
                           <!--<td>'.$row['apellidos'].'</td>-->
                           <td>'.$row['rut'].'</td>
                           <td>'.$row['tipo_muestra'].'</td>            
                           <td>'.$row['num_frasco'].'</td>
                           <td>'.$row['cirujano'].'</td>
                           <td>'.$row['areas_id_area'].'</td>
                           <td>'.$fecha_chilena.'</td>
                           <td>'.$estadoTrazabilidadBadge.'</td>
                           <td>
                           <button id="botonImprimir" onclick="printRow('.$row['id_muestra'].')" type="button" class="btn btn-success"><span><i class="fas fa-print"></i></span></button>
                           </td>
                       </tr>';
                       }else{
                           $data .= '
                       
                       <tr>
                           <td>'.$row['nombres'].' '.$row['apellidos'].'</td>
                           <!--<td>'.$row['apellidos'].'</td>-->
                           <td>'.$row['rut'].'</td>
                           <td>'.$row['tipo_muestra'].'</td>            
                           <td>'.$row['num_frasco'].'</td>
                           <td>'.$row['cirujano'].'</td>
                           <td>'.$row['areas_id_area'].'</td>
                           <td>'.$fecha_chilena.'</td>
                           <td>'.$estadoTrazabilidadBadge.'</td>
                           <td id="botonesTabla">
                               <div class="btn-group" role="group" aria-label="Basic example">
                                 <button onclick="obtenerDatosPacientes('.$row['id_muestra'].')" type="button" class="btn btn-info" data-toggle="modal" data-target="#myModalActualizarPaciente" data-backdrop="static" data-keyboard="false"><span><i class="fas fa-edit"></i></span></button>
                                 <button onclick="eliminarPaciente('.$row['id_muestra'].')" type="button" class="btn btn-danger"><span><i class="fas fa-trash-alt"></i></span></button>
                                 <button id="botonImprimir" onclick="printRow('.$row['id_muestra'].')" type="button" class="btn btn-success"><span><i class="fas fa-print"></i></span></button>
                               </div>
                           </td>
                       </tr>';
                       }
   
                       break;
   
                   case 'Basico':
                       if($_SESSION['areas_id_area'] == "5"){
                           $data .= '
                       
                       <tr>
                           <td>'.$row['nombres'].' '.$row['apellidos'].'</td>
                           <!--<td>'.$row['apellidos'].'</td>-->
                           <td>'.$row['rut'].'</td>
                           <td>'.$row['tipo_muestra'].'</td>            
                           <td>'.$row['num_frasco'].'</td>
                           <td>'.$row['cirujano'].'</td>
                           <td>'.$row['areas_id_area'].'</td>
                           <td>'.$fecha_chilena.'</td>
                           <td>'.$estadoTrazabilidadBadge.'</td>
                           <td>
                           <button id="botonImprimir" onclick="printRow('.$row['id_muestra'].')" type="button" class="btn btn-success"><span><i class="fas fa-print"></i></span></button>
                           </td>
                       </tr>';
                       }else{
                           $data .= '
                       
                       <tr>
                           <td>'.$row['nombres'].' '.$row['apellidos'].'</td>
                           <!--<td>'.$row['apellidos'].'</td>-->
                           <td>'.$row['rut'].'</td>
                           <td>'.$row['tipo_muestra'].'</td>            
                           <td>'.$row['num_frasco'].'</td>
                           <td>'.$row['cirujano'].'</td>
                           <td>'.$row['areas_id_area'].'</td>
                           <td>'.$fecha_chilena.'</td>
                           <td>'.$estadoTrazabilidadBadge.'</td>
                           <td id="botonesTabla">
                               <div class="btn-group" role="group" aria-label="Basic example">
                                 <button onclick="obtenerDatosPacientes('.$row['id_muestra'].')" type="button" class="btn btn-info" data-toggle="modal" data-target="#myModalActualizarPaciente" data-backdrop="static" data-keyboard="false"><span><i class="fas fa-edit"></i></span></button>
                                 <button id="botonImprimir" onclick="printRow('.$row['id_muestra'].')" type="button" class="btn btn-success"><span><i class="fas fa-print"></i></span></button>
                               </div>
                           </td>
                       </tr>';
                       }
                       break;
                   case 'Administrativo'://solo para especialidades 
                       $data .= '
                       
                       <tr>
                           <td>'.$row['nombres'].' '.$row['apellidos'].'</td>
                           <!--<td>'.$row['apellidos'].'</td>-->
                           <td>'.$row['rut'].'</td>
                           <td>'.$row['tipo_muestra'].'</td>            
                           <td>'.$row['num_frasco'].'</td>
                           <td>'.$row['cirujano'].'</td>
                           <td>'.$row['areas_id_area'].'</td>
                           <td>'.$fecha_chilena.'</td>
                           <td>'.$estadoTrazabilidadBadge.'</td>
                           
                           <td id="botonesTabla">
                               <div class="btn-group" role="group" aria-label="Basic example">
                                 <button id="botonImprimir" onclick="printRow('.$row['id_muestra'].')" type="button" class="btn btn-success"><span><i class="fas fa-print"></i></span></button>
                               </div>
                           </td>
                       </tr>';
                       break;           
               }    
           }
       }
       else
       {
           // en caso que no se muestren datos 
           $data .= '<tr><td colspan="10">¡No se encontraron datos!</td></tr>';
       }
       //concatenamos donde termina la etiqueta table
       $data .= '</table>';
       
       //imprimimos tabla completa
       echo $data;
   ?>
<style>
   .switch {
   position: relative;
   display: inline-block;
   width: 60px;
   height: 34px;
   }
   .switch input {display:none;}
   .slider {
   position: absolute;
   cursor: pointer;
   top: 0;
   left: 0;
   right: 0;
   bottom: 0;
   background-color: #ccc;
   -webkit-transition: .4s;
   transition: .4s;
   }
   .slider:before {
   position: absolute;
   content: "";
   height: 26px;
   width: 26px;
   left: 4px;
   bottom: 4px;
   background-color: white;
   -webkit-transition: .4s;
   transition: .4s;
   }
   input:checked + .slider {
   background-color: #2196F3;
   }
   input:focus + .slider {
   box-shadow: 0 0 1px #2196F3;
   }
   input:checked + .slider:before {
   -webkit-transform: translateX(26px);
   -ms-transform: translateX(26px);
   transform: translateX(26px);
   }
   /* Rounded sliders */
   .slider.round {
   border-radius: 34px;
   }
   .slider.round:before {
   border-radius: 50%;
   }
</style>
<!--script para paginacion de la tabla
<script type="text/javascript">
   // get the table element
   var $table = document.getElementById("muestra"),
   // number of rows per page
   $n = 30,
   // number of rows of the table
   $rowCount = $table.rows.length,
   // get the first cell's tag name (in the first row)
   $firstRow = $table.rows[0].firstElementChild.tagName,
   // boolean var to check if table has a head row
   $hasHead = ($firstRow === "TH"),
   // an array to hold each row
   $tr = [],
   // loop counters, to start count from rows[1] (2nd row) if the first row has a head tag
   $i,$ii,$j = ($hasHead)?1:0,
   // holds the first row if it has a (<TH>) & nothing if (<TD>)
   $th = ($hasHead?$table.rows[(0)].outerHTML:"");
   // count the number of pages
   var $pageCount = Math.ceil($rowCount / $n);
   // if we had one page only, then we have nothing to do ..
   if ($pageCount > 1) {
       // assign each row outHTML (tag name & innerHTML) to the array
       for ($i = $j,$ii = 0; $i < $rowCount; $i++, $ii++)
           $tr[$ii] = $table.rows[$i].outerHTML;
       // create a div block to hold the buttons
       $table.insertAdjacentHTML("afterend","<div style="+'margin-top:15px;'+" id='buttons'></div");
       // the first sort, default page is the first one
       sort(1);
   }
   
   // ($p) is the selected page number. it will be generated when a user clicks a button
   function sort($p) {
       /* create ($rows) a variable to hold the group of rows
       ** to be displayed on the selected page,
       ** ($s) the start point .. the first row in each page, Do The Math
       */
       var $rows = $th,$s = (($n * $p)-$n);
       for ($i = $s; $i < ($s+$n) && $i < $tr.length; $i++)
           $rows += $tr[$i];
       
       // now the table has a processed group of rows ..
       $table.innerHTML = $rows;
       // create the pagination buttons
       document.getElementById("buttons").innerHTML = pageButtons($pageCount,$p);
       // CSS Stuff
       document.getElementById("id"+$p).setAttribute("class","active");
   }
      
   // ($pCount) : number of pages,($cur) : current page, the selected one ..
   function pageButtons($pCount,$cur) {
       /* this variables will disable the "Prev" button on 1st page
          and "next" button on the last one */
       var $prevDis = ($cur == 1)?"disabled":"",
           $nextDis = ($cur == $pCount)?"disabled":"",
           /* this ($buttons) will hold every single button needed
           ** it will creates each button and sets the onclick attribute
           ** to the "sort" function with a special ($p) number..
           */
           $buttons = "<input type='button' value='&lt;&lt; Anterior' onclick='sort("+($cur - 1)+")' "+$prevDis+">";
       for ($i=1; $i<=$pCount;$i++)
           $buttons += "<input type='button' id='id"+$i+"'value='"+$i+"' onclick='sort("+$i+")'>";
       $buttons += "<input type='button' value='Siguiente &gt;&gt;' onclick='sort("+($cur + 1)+")' "+$nextDis+">";
       return $buttons;
   }
</script>-->




