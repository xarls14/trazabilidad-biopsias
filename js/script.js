var x = 1;

//crear usuario (solo administrador)
function crearUsuario(){

	var usuario_rut = $("#usuario_rut").val();
	var nombre = $("#nombre").val();
	var apellido = $("#apellido").val();
	var email = $("#email").val();
	var selectUnidad = $("#selectUnidad").val();
	var selectUsuario = $("#selectUsuario").val();
	var password = $("#password").val();
	var conf_password = $("#conf_password").val();

	$.post("../ajax/crearUsuario.php", {
		usuario_rut: usuario_rut,
		nombre: nombre,
		apellido: apellido,
		email: email,
		selectUnidad: selectUnidad,
		selectUsuario: selectUsuario,
		password: password,
		conf_password: conf_password
	}, function(data, status){
		//cerramos el popup
		$("#myModalCrearUsuario").modal("hide");

		document.getElementById("FormCrearUsuario").reset();
		//limpiamos los campos
	});
}
//agregamos paciente desde las demas vistas (no administrador)
/*function agregarPaciente(){
	//obtenemos los valores
	var nombres = $("#nombres").val();
	var apellidos = $("#apellidos").val();
	var rut = $("#rut").val();
	var tipo_muestra = $("#tipo_muestra").val();
	var unidad_origen = $("#unidad_origen").val();
	var num_frasco = $("#num_frasco").val();

	//agregamos los campos
	$.post("../ajax/agregarRecord.php", {
		nombres: nombres,
		apellidos: apellidos,
		rut: rut,
		tipo_muestra: tipo_muestra,
		unidad_origen: unidad_origen,
		num_frasco: num_frasco
	}, function(data, status){
		//cerramos el popup
		$("#myModalNuevoPaciente").modal("hide");

		//leer campos para recargar la tabla con nuevos datos al ingresarlos
		
		actualizarTabla();

		//limpiamos los campos
		var nombres = $("#nombres").val("");
		var apellidos = $("#apellidos").val("");
		var rut = $("#rut").val("");
		var tipo_muestra = $("#tipo_muestra").val("");
		var unidad_origen = $("#unidad_origen").val("");
		var num_frasco = $("#num_frasco").val("");
	});
}*/

//agregamos paciente desde vista administrador 
/*function agregarPacienteAdmin(){
	//obtenemos los valores
	var nombres = $("#nombres").val();
	var apellidos = $("#apellidos").val();
	var rut = $("#rut").val();
	var tipo_muestra = $("#tipo_muestra").val();
	var unidad_origen = $("#unidad_origen").val();
	var num_frasco = $("#num_frasco").val();

	//agregamos los campos
	$.post("../ajax/agregarRecord.php", {
		nombres: nombres,
		apellidos: apellidos,
		rut: rut,
		tipo_muestra: tipo_muestra,
		unidad_origen: unidad_origen,
		num_frasco: num_frasco
	}, function(data, status){
		//cerramos el popup
		$("#myModalNuevoPacienteAdmin").modal("hide");

		//leer campos para recargar la tabla con nuevos datos al ingresarlos
		
		actualizarTabla();

		//limpiamos los campos
		var nombres = $("#nombres").val("");
		var apellidos = $("#apellidos").val("");
		var rut = $("#rut").val("");
		var tipo_muestra = $("#tipo_muestra").val("");
		var unidad_origen = $("#unidad_origen").val("");
		var num_frasco = $("#num_frasco").val("");
	});
}*/

function agregarPaciente(){
	var datastring = $("#formCrearPaciente").serialize();
	$.ajax({
		type: "post",
		url: "../ajax/agregarRecord.php",
		data: datastring,
		success: function(datastring){//no es ta pasando por success ya que la query arroja error en el codigo mysqli pero no asi en mysql workbench
			$("#myModalNuevoPaciente").modal("hide");
			actualizarTabla();
			document.getElementById("formCrearPaciente").reset();
			$("#muestras").empty();
			x = 1;
		}
	});
}

function agregarPacienteAdmin(){
	//obtenemos los valores
	var datastring = $("#formCrearPaciente").serialize();
	$.ajax({
		type: "post",
		url: "../ajax/agregarRecord.php",
		data: datastring,
		success: function(datastring){//no es ta pasando por success ya que la query arroja error en el codigo mysqli pero no asi en mysql workbench
			$("#myModalNuevoPacienteAdmin").modal("hide");
			actualizarTabla();
			document.getElementById("formCrearPaciente").reset();
			$("#muestras").empty();
			x = 1;
		}
	});
}

//obtenemos datos de los usuarios para luego modificarlos (Update)
function obtenerDatosPacientes(id){
	//agregamos el id del usuario para ocuparlo luego
	$("#id_paciente_oculto").val(id);
	$.post("../ajax/leerDetallesPaciente.php",{
		id: id
	},
	function (data, status){
		//parse datos json
		var paciente = JSON.parse(data);
		//recuperamos datos del usuario y ponemos en modal
		$("#actualizar_nombres").val(paciente.nombres);
		$("#actualizar_apellidos").val(paciente.apellidos);
		$("#actualizar_rut").val(paciente.rut);
		$("#actualizar_tipo_muestra").val(paciente.tipo_muestra);
		$("#actualizar_unidad_origen").val(paciente.areas_id_area);
		$("#actualizar_num_frasco").val(paciente.num_frasco);
		$("#actualizar_cirujano").val(paciente.cirujano);

	});	
	//mostramos modal
	$("#myModalActualizarPaciente").modal("show");
}

function obtenerDatosPacientesAdmin(id){
	//agregamos el id del usuario para ocuparlo luego
	$("#id_paciente_oculto").val(id);
	$.post("../ajax/leerDetallesPacienteAdmin.php",{
		id: id
	},
	function (data, status){
		//parse datos json
		var paciente = JSON.parse(data);
		//recuperamos datos del usuario y ponemos en modal
		$("#actualizar_nombres").val(paciente.nombres);
		$("#actualizar_apellidos").val(paciente.apellidos);
		$("#actualizar_rut").val(paciente.rut);
		$("#actualizar_tipo_muestra").val(paciente.tipo_muestra);
		$("#actualizar_unidad_origen").val(paciente.areas_id_area);
		$("#actualizar_num_frasco").val(paciente.num_frasco);
		$("#actualizar_cirujano").val(paciente.cirujano);
	});	
	//mostramos modal
	$("#myModalActualizarPacientesAdmin").modal("show");
}

//funcion para update pacientes
function actualizarPaciente() {
    // get values
    var nombres = $("#actualizar_nombres").val();
    var apellidos = $("#actualizar_apellidos").val();
    var rut = $("#actualizar_rut").val();
    var tipo_muestra = $("#actualizar_tipo_muestra").val();
    var unidad_origen = $("#actualizar_unidad_origen").val();
    var num_frasco = $("#actualizar_num_frasco").val();
    var cirujano = $("#actualizar_cirujano").val();
 
    // get hidden field value
    var id = $("#id_paciente_oculto").val();
 
    // Update the details by requesting to the server using ajax
    $.post("../ajax/actualizarDetallesPaciente.php", {
            id: id,
            nombres: nombres,
			apellidos: apellidos,
			rut: rut,
			tipo_muestra: tipo_muestra,
			unidad_origen: unidad_origen,
			num_frasco: num_frasco,
			cirujano: cirujano
        },
        function (data, status) {
            // hide modal popup
            $("#myModalActualizarPaciente").modal("hide");
            // reload Users by using readRecords();
            actualizarTabla();
        }
    );
}

//funcion para realizar update de password, sin que pida la anterior
function actualizarPasswordUsuario(){
	var antigua_password = $("#antigua_password").val();
	var password = $("#nueva_password").val();
	var conf_password = $("#conf_nueva_password").val();

	$.post("../ajax/actualizarPasswordUsuario.php", {
			antigua_password: antigua_password,
			password: password,
			conf_password: conf_password
		},
		function(data, status){
			$("#myModalActualizarCambiarPassword").modal("hide");
		}
	);
}

function actualizarPacienteAdmin() {//actualizamos muestras
    // get values
    var nombres = $("#actualizar_nombres").val();
    var apellidos = $("#actualizar_apellidos").val();
    var rut = $("#actualizar_rut").val();
    var tipo_muestra = $("#actualizar_tipo_muestra").val();
    var unidad_origen = $("#actualizar_unidad_origen").val();
    var num_frasco = $("#actualizar_num_frasco").val();
    var cirujano = $("#actualizar_cirujano").val();
 
    // get hidden field value
    var id = $("#id_paciente_oculto").val();
 
    // Update the details by requesting to the server using ajax
    $.post("../ajax/actualizarDetallesPaciente.php", {
            id: id,
            nombres: nombres,
			apellidos: apellidos,
			rut: rut,
			tipo_muestra: tipo_muestra,
			unidad_origen: unidad_origen,
			num_frasco: num_frasco,
			cirujano: cirujano
        },
        function (data, status) {
            // hide modal popup
            $("#myModalActualizarPacienteAdmin").modal("hide");
            // reload Users by using readRecords();
            
            //$("#tablaMuestra").load(" #tablaMuestra");
            actualizarTabla();
            //$("#tablaMuestra").load(location.href + " #tablaMuestra");
        }
    );
}

function actualizarPacientesAdmin(){//actualizamos pacientes
	// get values
    var nombres = $("#actualizar_nombres").val();
    var apellidos = $("#actualizar_apellidos").val();
    var rut = $("#actualizar_rut").val();
    var tipo_muestra = $("#actualizar_tipo_muestra").val();
    var unidad_origen = $("#actualizar_unidad_origen").val();
    var num_frasco = $("#actualizar_num_frasco").val();
    var cirujano = $("#actualizar_cirujano").val();
 
    // get hidden field value
    var id = $("#id_paciente_oculto").val();
 
    // Update the details by requesting to the server using ajax
    $.post("../ajax/actualizarDetallesPacienteAdmin.php", {
            id: id,
            nombres: nombres,
			apellidos: apellidos,
			rut: rut,
			tipo_muestra: tipo_muestra,
			unidad_origen: unidad_origen,
			num_frasco: num_frasco,
			cirujano: cirujano

        },
        function (data, status) {
            // hide modal popup
            $("#myModalActualizarPacientesAdmin").modal("hide");
            // reload Users by using readRecords();
            actualizarTablaListarPacienteAdmin();
        }
    );
}

function aprobarMuestrasDesdeUnidades(id){
	var conf = confirm("¿Está seguro que desea aprobar esta muestra?");
	if(conf == true){
		$.post("../ajax/aprobarMuestrasDesdeUnidades.php",{
				id: id
			},
			function (data,status){
				actualizarTablaLabSinEstado();
			}
		);	
	}
}

function reprobarMuestrasDesdeUnidades(id){
	var conf = confirm("¿Está seguro que desea rechazar esta muestra?");
	if(conf == true){
		$.post("../ajax/reprobarMuestrasDesdeUnidades.php",{
				id: id
			},
			function (data,status){
				actualizarTablaLabSinEstado();
			}
		);	
	}
}

function aprobarMuestrasDesdeHigueras(id){
	var conf = confirm("¿Está seguro que desea aprobar esta muestra proveniente desde hospital higueras?");
	if(conf == true){
		$.post("../ajax/aprobarMuestrasDesdeHigueras.php",{
				id: id
			},
			function (data,status){
				actualizarTablaLabTransitoHigueras();
			}
		);	
	}
}

function reprobarMuestrasDesdeHigueras(id){
	var conf = confirm("¿Está seguro que desea rechazar esta muestra proveniente desde hospital higueras?");
	if(conf == true){
		$.post("../ajax/reprobarMuestrasDesdeHigueras.php",{
				id: id
			},
			function (data,status){
				actualizarTablaLabTransitoHigueras();
			}
		);	
	}
}

function iniciarTransitoHigueras(id){
	var conf = confirm("¿Está seguro que desea iniciar el tránsito al hospital higueras de esta muestra?");
	if(conf == true){
		$.post("../ajax/iniciarTransitoHigueras.php",{
				id: id
			},
			function (data,status){
				actualizarTablaLabEstadoHigueras();
			}
		);	
	}
}

function updateRechazadoHplToAprobadoHPL(id){
	var conf = confirm("¿Está seguro que desea modificar el estado de esta muestra?");
	if(conf == true){
		$.post("../ajax/updateMuestrasRechazadasLabHpl.php",{
				id: id
			},
			function (data,status){
				actualizarTablaLabRechazados();
			}
		);	
	}
}

function reprobarMuestrasAprobadasLabHpl(id){
	var conf = confirm("¿Está seguro que desea modificar el estado de esta muestra?");
	if(conf == true){
		$.post("../ajax/reprobarMuestrasAprobadasLabHpl.php",{
				id: id
			},
			function (data,status){
				actualizarTablaLabEstadoHigueras();
			}
		);	
	}
}


//en caso de pedir que se modifique se descomenta el codigo

/*function updateRechazadoHiguerasToRecibidoHigueras(id){
	var conf = confirm("¿Está seguro que desea modificar el estado de esta muestra?");
	if(conf == true){
		$.post("../ajax/updateMuestrasRechazadasHospitalHigueras.php",{
				id: id
			},
			function (data,status){
				actualizarTablaLabRechazadosHigueras();
			}
		);	
	}
}*/

function recepcionarMuestraAdministrativo(id){
	var conf = confirm("¿Está seguro que desea recepcionar esta muestra?");
	if(conf == true){
		$.post("../ajax/recepcionarMuestraAdministrativo.php",{
				id: id
			},
			function (data,status){
				actualizarTablaAdministrativoMuestraAprobadaHigueras();
			}
		);	
	}
}

//funcion leer records
function actualizarTabla(){
	$.get("../ajax/actualizarTabla.php", {}, function(data, status){
		$(".display").html(data);//leer datos ya lo tenemos con php
		$('#muestra').DataTable( {
			
			/*responsive: {
            details: {
                type: 'column',
                target: 'tr'
            	}
	        },
	        columnDefs: [ {
	            className: 'control',
	            orderable: false,
	            targets:   0
	        } ],
	        order: [ 1, 'asc' ],
	        "aoColumnDefs": [ 
		      { 'bSortable': false, 'aTargets': [ 0,1,2,3,4,5,6,7,8 ] } 
		     ],*/
		     ordering: false,
		    stateSave: true,
		    "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
            },
            dom: 'Bfrtip',
            buttons:[
            	'excel',
            	{
            		extend: 'pdfHtml5',
	                orientation: 'landscape',
	                pageSize: 'LEGAL',

            	}
            ]
		});   
	});
}

function actualizarTablaLabEstadoHigueras(){
	$.get("../ajax/actualizarTablaLabEstadoHigueras.php", {}, function(data, status){
		$(".display").html(data);//leer datos ya lo tenemos con php
		$('#muestra').DataTable( {
		    stateSave: true,
		    /*"aoColumnDefs": [ 
		      { 'bSortable': false, 'aTargets': [ 0,1,2,3,4,5,6,7,8 ] } 
		     ],*/
		     ordering: false,
		    "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
            },
            dom: 'Bfrtip',
            buttons:[
            	'excel',
            	{
            		extend: 'pdfHtml5',
	                orientation: 'landscape',
	                pageSize: 'LEGAL',

            	}
            ]
		});
	});
}

function actualizarTablaLabSinEstado(){
	$.get("../ajax/actualizarTablaLabSinEstado.php", {}, function(data, status){
		$(".display").html(data);//leer datos ya lo tenemos con php
		$('#muestra').DataTable( {
		    stateSave: true,
		    /*"aoColumnDefs": [ 
		      { 'bSortable': false, 'aTargets': [ 0,1,2,3,4,5,6,7,8 ] } 
		     ],*/
		     ordering: false,
		    "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
            },
            dom: 'Bfrtip',
            buttons:[
            	'excel',
            	{
            		extend: 'pdfHtml5',
	                orientation: 'landscape',
	                pageSize: 'LEGAL',

            	}
            ]
		});
	});
}

function actualizarTablaLabRechazados(){
	$.get("../ajax/actualizarTablaLabRechazados.php", {}, function(data, status){
		$(".display").html(data);//leer datos ya lo tenemos con php
		$('#muestra').DataTable( {
		    stateSave: true,
		    /*"aoColumnDefs": [ 
		      { 'bSortable': false, 'aTargets': [ 0,1,2,3,4,5,6,7,8 ] } 
		     ],*/
		     ordering: false,
		    "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
            },
            dom: 'Bfrtip',
            buttons:[
            	'excel',
            	{
            		extend: 'pdfHtml5',
	                orientation: 'landscape',
	                pageSize: 'LEGAL',

            	}
            ]
		});
	});
}

function actualizarTablaLabRechazadosHigueras(){
	$.get("../ajax/actualizarTablaLabRechazadosHigueras.php", {}, function(data, status){
		$(".display").html(data);//leer datos ya lo tenemos con php
		$('#muestra').DataTable( {
		    stateSave: true,
		    /*"aoColumnDefs": [ 
		      { 'bSortable': false, 'aTargets': [ 0,1,2,3,4,5,6,7,8 ] } 
		     ],*/
		     ordering: false,
		    "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
            },
            dom: 'Bfrtip',
            buttons:[
            	'excel',
            	{
            		extend: 'pdfHtml5',
	                orientation: 'landscape',
	                pageSize: 'LEGAL',

            	}
            ]
		});
	});
}

function actualizarTablaLabTransitoHigueras(){
	$.get("../ajax/actualizarTablaLabTransitoHigueras.php", {}, function(data, status){
		$(".display").html(data);//leer datos ya lo tenemos con php
		$('#muestra').DataTable( {
		    stateSave: true,
		    /*"aoColumnDefs": [ 
		      { 'bSortable': false, 'aTargets': [ 0,1,2,3,4,5,6,7,8 ] } 
		     ],*/
		     ordering: false,
		    "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
            },
            dom: 'Bfrtip',
            buttons:[
            	'excel',
            	{
            		extend: 'pdfHtml5',
	                orientation: 'landscape',
	                pageSize: 'LEGAL',

            	}
            ]
		});
	});
}

function actualizarTablaListarPacienteAdmin(){
	$.get("../ajax/actualizarTablaListarPacienteAdmin.php", {}, function(data, status){
		$(".display").html(data);//leer datos ya lo tenemos con php
		$('#muestra').DataTable( {
		    stateSave: true,
		    /*"aoColumnDefs": [ 
		      { 'bSortable': false, 'aTargets': [ 0,1,2,3,4,5,6,7,8 ] } 
		     ],*/
		     ordering: false,
		    "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
            },
            dom: 'Bfrtip',
            buttons:[
            	'excel',
            	{
            		extend: 'pdfHtml5',
	                orientation: 'landscape',
	                pageSize: 'LEGAL',

            	}
            ]
		});
	});
}

function actualizarTablaAdministrativoMuestraAprobadaHigueras(){
	$.get("../ajax/actualizarTablaAdministrativoMuestraAprobadaHigueras.php", {}, function(data, status){
		$(".display").html(data);//leer datos ya lo tenemos con php
		$('#muestra').DataTable( {
		    stateSave: true,
		    /*"aoColumnDefs": [ 
		      { 'bSortable': false, 'aTargets': [ 0,1,2,3,4,5,6,7,8 ] } 
		     ],*/
		     ordering: false,
		    "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
            },
            dom: 'Bfrtip',
            buttons:[
            	'excel',
            	{
            		extend: 'pdfHtml5',
	                orientation: 'landscape',
	                pageSize: 'LEGAL',

            	}
            ]
		});
	});
}

function actualizarTablaAdministrativoMuestrasFinalizadas(){
	$.get("../ajax/actualizarTablaAdministrativoMuestrasFinalizadas.php", {}, function(data, status){
		$(".display").html(data);//leer datos ya lo tenemos con php
		$('#muestra').DataTable( {
		    stateSave: true,
		    /*"aoColumnDefs": [ 
		      { 'bSortable': false, 'aTargets': [ 0,1,2,3,4,5,6,7,8 ] } 
		     ],*/
		     ordering: false,
		    "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
            },
            dom: 'Bfrtip',
            buttons:[
            	'excel',
            	{
            		extend: 'pdfHtml5',
	                orientation: 'landscape',
	                pageSize: 'LEGAL',

            	}
            ]
		});
	});
}

//funcion eliminar paciente o fila
function eliminarPaciente(id){
	var conf = confirm("¿Está seguro que desea aprobar esta muestra?");
	if(conf == true){
		$.post("../ajax/eliminarPaciente.php",{
				id: id
			},
			function (data,status){
				actualizarTabla();
			}
		);	
	}
}


//funcion imprimir zona de la tabla
function imprSelec(muestra){
	var ficha=document.getElementById(muestra);
	var ventimp=window.open(' ','popimpr');
	ventimp.document.write(ficha.innerHTML);
	ventimp.document.close();ventimp.print();
	ventimp.close();
}

function printData(muestra)
{
   /*var divToPrint=document.getElementById("muestra");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();*/

   //css para ocultar botones y bordes de tabla
   let tableHTML = '<style>'+
                  // tus estilos
                  '#botonesTabla{' +
                  'display: none !important;' +
                  '}' +
                  'table {'+
    					'border-collapse: collapse;'+
					'}'+

				'table, td, th {'+
    				'border: 0.5px solid black;'+
				'}'+
                  '</style>';
	tableHTML += document.getElementById('muestra').innerHTML;
	let newWin = window.open('');
	newWin.document.write(tableHTML);
	newWin.print();
	newWin.close();
}

//print row: imprimimos los datos de los pacientes para imprimir en datamax
function printRow(id){

	$("#id_paciente_oculto").val(id);
	$.ajax({
		type: "POST",
		cache: false,
		data: {id: id},
		url: "../ajax/leerDetallesPacientePrintRow.php",
		dataType: "html",
		success: function(data)
		{
			var paciente = JSON.parse(data);
			var unidad_origen_parseada = "";

			switch(paciente.areas_id_area){
				case '1':
					unidad_origen_parseada = 'Pabellon';
				break;

				case '2':
					unidad_origen_parseada = 'Endoscopia y PCM';
				break;

				case '3':
					unidad_origen_parseada = 'Hospitalizados';
				break;

				case '4':
					unidad_origen_parseada = 'Especialidades';
				break;

				case '5':
					unidad_origen_parseada = 'Laboratorio';
				break;

				case '6':
					unidad_origen_parseada = 'Urgencias';
				break;
			}

			//parseamos fecha a formato local ej: 31-10-1989
			var fecha = paciente.fecha_ingreso;
			var fecha_parseada = new Date(fecha);
			var fecha_chile = fecha_parseada.toLocaleDateString();

			let tableHTML = 
			'<style>'+
			'table{'+
					'align: center;'+
					'width: 400px;'+
					'font-weight: bold;'+
			    	'border-collapse: collapse;'+
			  		'font-size: 15px;'+
			  		'height: 65px;'+
					'margin-top: 10px;'+
			  		'margin-bottom: 10px;'+
			  		'margin-left: 100px;'+
			  		'font-family: Arial;'+
			  		'border: 0.5px solid black;'+
					'}'+
			        'td, th {'+
			            'border: none;'+
   					    'padding: 5px;'+
			            '}'+
			'</style>'+
			'<table>'+
			  '<tr>'+
			    '<td>'+
			      'Nombres'+
			    '</td>'+
			    '<td>'+
			      paciente.nombres+
			    '</td>'+
			  '</tr>'+
			  '<tr>'+
			    '<td>'+
			      'Apellidos'+
			    '</td>'+
			    '<td>'+
			      paciente.apellidos+
			    '</td>'+
			  '</tr>'+
			   '<tr>'+
			    '<td>'+
			      'Rut'+
			    '</td>'+
			    '<td>'+
			      paciente.rut+
			    '</td>'+
			  '</tr>'+
			  '<tr>'+
			    '<td>'+
			      'Tipo de muestra'+
			    '</td>'+
			    '<td style="word-wrap: break-word; width: 200px;">'+
			      paciente.tipo_muestra+
			    '</td>'+
			  '</tr>'+
			   '<tr>'+
			    '<td>'+
			      'Fecha obtención'+
			    '</td>'+
			    '<td>'+
			      fecha_chile+
			    '</td>'+
			  '</tr>'+
			  '<tr>'+
			    '<td>'+
			      'Establecimiento origen'+
			    '</td>'+
			    '<td>'+
			      'Hospital Penco Lirquen'+
			    '</td>'+
			  '</tr>'+
			  '<tr>'+
			    '<td>'+
			      'Unidad de origen'+
			    '</td>'+
			    '<td>'+
			      unidad_origen_parseada+
			    '</td>'+
			  '</tr>'+	  
			  '<tr>'+
			    '<td>'+
			      'N° Frasco'+
			    '</td>'+
			    '<td>'+
			      '<strong style="font-size: 15px">'+paciente.num_frasco+'</strong>'+
			    '</td>'+
			  '</tr>'+
			  '<tr>'+
			    '<td>'+
			      'Cirujano'+
			    '</td>'+
			    '<td>'+
			      '<strong style="font-size: 15px">'+paciente.cirujano+'</strong>'+
			    '</td>'+
			  '</tr>'+
			'</table>'

			;
			let popupWin = window.open('', '_blank', 'top=0,left=0,height=1080px,width=1920px');
		    popupWin.document.open();
		    popupWin.document.write(tableHTML);
		    popupWin.print();
		    popupWin.close();
		    
		}		
	});
}

function limpiarMuestras(){
	document.getElementById("formCrearPaciente").reset();
	$("#muestras").empty();
	x = 1;
}

function limpiarNuevoUsuario(){
	document.getElementById("FormCrearUsuario").reset();//removemos los inputs extras de muestras
	$( "label.error" ).remove();//eliminamos los labels de error que quedan al cancelar el formulario 
}

function limpiarNuevoPacienteAdmin(){
	document.getElementById("formCrearPaciente").reset();
	$( "label.error" ).remove();
	limpiarMuestras();
}
//agregar mas muestras 
$(document).ready(function(){
	var max_muestra = 8;
	var wrapper = $("#muestras");
	var add_muestra = $("#addMuestra");
	

	$(add_muestra).click(function(e){
		e.preventDefault();
		if(x < max_muestra){
			x++;
			muestra = '<div class="form-group col-sm-6" id="muestraDiv"><input id="tipo_muestra'+x+'" type="form-text" class="form-control" name="tipo_muestra['+x+']'
			+'" placeholder="Ingresa tipo muestra N°'+
			 x +'" style="margin-top: 8px;"><a href="#" class="delete" style="display:none;">Delete</a></div>'+
			'<div class="form-group col-sm-6"><input id="num_frasco'+x+'" type="form-text" class="form-control" name="num_frasco['+x+']'+
			'" placeholder="Ingrese N° frasco" style="margin-top: 8px;"><a style="margin-top: 8px;" href="#" class="delete">Eliminar</a></div>';
			$(wrapper).append(muestra);
		}else{
			alert("Puede ingresar un máximo de 8 muestras.");
		}
	});

	$(wrapper).on("click",".delete", function(e){
		e.preventDefault();
		x--;
		$('#muestras div:last').remove(); 
		$('#muestras div:last').remove();
		
	})	
});

function abrirModalRechazarMuestraLabHpl(id){
	$('#myModalRechazarMuestraLabHpl').modal('show'); 
    var observaciones = $("#observaciones").val(); 
    var id = $("#id_paciente_oculto").val();
 
    // Update the details by requesting to the server using ajax
    $.post("../ajax/actualizarDetallesPacienteAdmin.php", {//cambiar por el reprobar muestra lab hpl
            id: id,
			observaciones: observaciones

        },
        function (data, status) {
        	//aca deberiamos llamar a validar form y esa funcion llama a 
        	//reprobar muestra

            // hide modal popup
            //$("#myModalActualizarPacientesAdmin").modal("hide");
            // reload Users by using readRecords();
            //actualizarTablaListarPacienteAdmin();
        }
    );


}

//probaremos sacar esta opcion ya que cuando actualiza lo hace con dos 
/*$(document).ready(function(){
	actualizarTabla();
});*/ 


//tooltip
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});

/* menu lateral js */
$(document).ready(function () {
    $("#sidebar").mCustomScrollbar({
        theme: "minimal"
    });

    $('#sidebarCollapse').on('click', function () {
        $('#sidebar, #content').toggleClass('active');
        $('.collapse.in').toggleClass('in');
        $('a[aria-expanded=true]').attr('aria-expanded', 'false');
    });
});

//buscador custom para tabla (no se ocupa en este proyecto)
$(document).ready(function(){
   	$("#myInputBuscar").on("keyup", function() {
    	var value = $(this).val().toLowerCase();
	    $("#tabla-pacientes tr").filter(function() {
	        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	    });
	});
});


//validar form de crear usuario
$(document).ready(function () {
	//validador para formulario crear usuario en vista administrador
    $('#FormCrearUsuario').validate({
    rules: {
    nombre: {
      required: true,
      maxlength: 50,
    },
    apellido:{
      required: true,
      maxlength: 50,
    },
	usuario_rut: {
      /*required: true,
      minlength: 8,
      maxlength: 9,*/
    },
    email: {
      required: true,
      email: true,
      maxlength: 50,
    },
    password: {
      required: true,
      maxlength: 30,
    },
    conf_password: {
      required: true,
      equalTo:"#password",
      maxlength: 30,
    }
  },
  messages: {
    nombre:{
      required: 'Debe ingresar el nombre',
      maxlength: 'El nombre debe tener una máximo de 50 caracteres',
    },
    apellido:{
      required: 'Debe ingresar el apellido.',
      maxlength: 'El apellido debe tener una máximo de 50 caracteres',
    },
    usuario_rut: {
      /*required: 'Debe ingresar un rut válido',
      maxlength: 'El rut debe tener un máximo de 9 caracteres'*/
    },
    email: {
      required: 'Debe ingresar un email',
      email: 'El formato debe ser ejemplo@dominio.cl',
      maxlength: 'El email debe tener un máximo de 50 caracteres',
    },
    password: {
      required: 'Debe ingresar una contraseña',
      maxlength: 'La contraseña debe tener un máximo de 30 caracteres',
    },
    conf_password: {
      required: 'Debe confirmar la primera contraseña',
      equalTo: 'La contraseña debe coincidir...',
      maxlength: 'La contraseña debe tener un máximo de 30 caracteres',
    }
  },
  		
        submitHandler: function () {
            crearUsuario();
        }
    });

    $('#usuario_rut').rut({
    	placeholder: false,
    });
});

//validar form para pacientes en administrador
function validarFormPacienteAdmin(){
    $('#formCrearPaciente').validate({
    rules: {
    nombres: {
      required: true,
      maxlength: 50,
    },
    apellidos:{
      required: true,
      maxlength: 50,
    },
	rut: {
      /*required: true,
      minlength: 8,
      maxlength: 9,*/
    },
    tipo_muestra: {
    	required: true,
    },
    num_frasco: {
    	required: true,
    },
    cirujano: {
    	required: true,
    	maxlength: 30,
    }
  },
  messages: {
    nombres:{
      required: 'Debe ingresar nombres',
      maxlength: 'Nombres debe tener una máximo de 50 caracteres',
    },
    apellidos:{
      required: 'Debe ingresar apellidos',
      maxlength: 'Apellidos debe tener una máximo de 50 caracteres',
    },
    rut: {
      /*required: 'Debe ingresar un rut válido',
      minlength: 'Al menos debe tener 8 caracteres',
      maxlength: 'El rut debe tener un máximo de 9 caracteres'*/
    },
    tipo_muestra: {
    	required: 'Debe ingresar el tipo de muestra',
    },
    num_frasco: {
    	required: 'Debe ingresar el N° de frasco',
    },
    cirujano: {
    	required: 'Debe ingresar cirujano que realizó muestra',
    	maxlength: 'Debe tener un máximo de 30 caracteres'
    },
  }, 		
        submitHandler: function () {
            agregarPacienteAdmin();
        }
    });

    //funciona pero no cumple con lo necesario ya que sigue validando el primer elemento
    $("[name^=tipo_muestra").each(function () {
        $(this).rules("add", {
            required: true,        
            messages:{
            	required: 'Debe ingresar el tipo de muestra',
            }
        });
    });

    $("[name^=num_frasco").each(function () {
        $(this).rules("add", {
            required: true,
            number: true,
            messages:{
            	required: 'Debe ingresar el N° de frasco',
            	number: 'Solo números estan permitidos',
            }
        });
    });

    //validar rut con jquery
    $('#rut').rut({
    	placeholder: false,
    });

}


function validarFormPaciente(){
    $('#formCrearPaciente').validate({
    rules: {
    nombres: {
      required: true,
      maxlength: 40,
    },
    apellidos:{
      required: true,
      maxlength: 40,
    },
	rut: {
      /*required: true,
      minlength: 8,
      maxlength: 9,*/
    },
    tipo_muestra: {
    	required: true,
    },
    num_frasco: {
    	required: true,
    },
    cirujano: {
    	required: true,
    	maxlength: 30,
    }
  },
  messages: {
    nombres:{
      required: 'Debe ingresar nombres',
      maxlength: 'Nombres debe tener una máximo de 40 caracteres',
    },
    apellidos:{
      required: 'Debe ingresar apellidos',
      maxlength: 'Apellidos debe tener una máximo de 40 caracteres',
    },
    rut: {
      /*required: 'Debe ingresar un rut válido',
      minlength: 'Al menos debe tener 8 caracteres',
      maxlength: 'El rut debe tener un máximo de 9 caracteres'*/
    },
    tipo_muestra: {
    	required: 'Debe ingresar el tipo de muestra',
    },
    num_frasco: {
    	required: 'Debe ingresar el N° de frasco',
    },
    cirujano: {
    	required: 'Debe ingresar cirujano que realizó muestra',
    	maxlength: 'Debe tener un máximo de 30 caracteres'
    },
  }, 		
        submitHandler: function () {
            agregarPaciente();
        }
    });

    //funciona pero no cumple con lo necesario ya que sigue validando el primer elemento
    $("[name^=tipo_muestra").each(function () {
        $(this).rules("add", {
            required: true,        
            messages:{
            	required: 'Debe ingresar el tipo de muestra',
            }
        });
    });

    $("[name^=num_frasco").each(function () {
        $(this).rules("add", {
            required: true,
            number: true,
            messages:{
            	required: 'Debe ingresar el N° de frasco',
            	number: 'Solo números estan permitidos',
            }
        });
    });

    $('#rut').rut({
    	placeholder: false,
    });
}

//validar formulario para especialidades (deberia funcionar para las demas pantallas) 
function validarFormRechazarMuestraLabHpl(){
    $('#formRechazarMuestraLabHpl').validate({
    rules: {
	    observaciones: {
	    	required: true,
	    	maxlength: 100,
	    }
	},
	messages: {
	    observaciones: {
	    	required: 'Debe ingresar observaciones del rechazo.',
	    	maxlength: 'Debe tener un máximo de 100 caracteres'
		},
  	}, 		
        submitHandler: function () {
        	//funcion rechazar muestra lab hpl e ingresar obs
        }
    });
}

/*function validarFormActualizarPacienteAdmin(){
	$('#formActualizarPacienteAdmin').validate({
    rules: {
    nombres: {
      required: true,
      maxlength: 50,
    },
    apellidos:{
      required: true,
      maxlength: 50,
    },
	rut: {
      /*required: true,
      minlength: 8,
      maxlength: 9,*/
    /*},
  },
  messages: {
    nombres:{
      required: 'Debe ingresar nombres',
      maxlength: 'Nombres debe tener una máximo de 50 caracteres',
    },
    apellidos:{
      required: 'Debe ingresar apellidos',
      maxlength: 'Apellidos debe tener una máximo de 50 caracteres',
    },
    rut: {
      required: 'Debe ingresar un rut válido',
      minlength: 'Al menos debe tener 8 caracteres',
      maxlength: 'El rut debe tener un máximo de 9 caracteres'
    },
  }, 		
        submitHandler: function () {
            agregarPaciente();
        }
    });

    $('#rut').rut({
    	placeholder: false,
    	required: true,
    });
}*/

/*//validar form cambio de password
$(document).ready(function () {
	//validador para formulario crear usuario en vista administrador
    $('#formCambiarPassword').validate({
    rules: {
    antigua_password:{
    		required: true,	
    		},	
    nueva_password: {
		       	required: true,
		      	maxlength: 30,
	    	},
    conf_nueva_password: {
		      	required: true,
		      	equalTo:"#nueva_password",
		      	maxlength: 30,
		    }
  },
  messages: {
  	antigua_password: {
  				required: 'Debe ingresar la antigua contraseña',
  	},
    nueva_password: {
			    required: 'Debe ingresar la nueva contraseña',
			    maxlength: 'La contraseña debe tener un máximo de 30 caracteres',
		    },
			conf_nueva_password: {
			    required: 'Debe confirmar la primera contraseña',
			    equalTo: 'La contraseña debe coincidir con la nueva contraseña',
			    maxlength: 'La contraseña debe tener un máximo de 30 caracteres',
			}
  },
  		
        submitHandler: function () {
            actualizarPasswordUsuario();
        }
    });
});*/

//funcion alternativa para buscar en tabla
/*function myFunction() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInputBuscar");
  filter = input.value.toUpperCase();
  table = document.getElementById("muestra");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}*/










