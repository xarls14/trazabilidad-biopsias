
<div class="modal fade" id="myModalActualizarPacienteAdmin">
    <div class="modal-dialog modal-lg" style="width: 600px;">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Actualizar muestra</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <form method="post">
            <!--Nombres y apellidos -->
            <div class="row">
              <div class="form-group col-sm-6">
              <label>Nombres</label>
              <input type="form-text" class="form-control" id="actualizar_nombres" placeholder="Ingresa nombres" disabled="true">     
            </div>
              <div class="form-group col-sm-6">
                <label>Apellidos</label>
                <input type="form-text" class="form-control" id="actualizar_apellidos" placeholder="Ingresa apellidos" disabled="true">
              </div>
            </div>
            <!--Rut -->
           <div class="row">
             <div class="form-group col-sm-12">
              <label>Rut</label>
              <input type="form-text" class="form-control" id="actualizar_rut" placeholder="Ingresa rut" disabled="true">    
            </div>
           </div>
            

              <div class="row">
                <!--Tipo de muestra -->
                <div class="form-group col-sm-6">
                  <label>Tipo muestra</label>
                  <input type="form-text" class="form-control" id="actualizar_tipo_muestra" placeholder="Ingresa tipo muestra" maxlength="60">  
                </div>
                <!--N° Frasco -->
                <div class="form-group col-sm-6">
                  <label>N° Frasco</label>
                  <input type="form-number" class="form-control" id="actualizar_num_frasco" placeholder="Ingrese N° frasco" min="1" max="99" maxlength="2">     
                </div>
              </div>

              <div class="row">
                 <!--Establecimiento de origen -->
                <div class="form-group col-sm-6">
                  <label>Establecimiento origen</label>
                  <input type="form-text" class="form-control" id="actualizar_establecimiento_origen" placeholder="HPL" disabled="true">
                </div>
                
                <!--Unidad de origen -->
                <div class="form-group col-sm-6">
                  <label>Unidad paciente</label>
                  <select class="form-control" type="select" id="actualizar_unidad_origen" disabled="true">
                    <option value="1">Pabellon</option>
                    <option value="2">Endoscopia</option>
                    <option value="3">Hospitalizados</option>
                    <option value="4">Especialidades</option>
                    <option value="5">Laboratorio</option>
                    <option value="6">Urgencias</option>
                  </select>
                     <!--<input type="form-text" class="form-control" id="actualizar_unidad_origen" placeholder="Ingresa unidad de origen">-->
                </div>
              </div>
              <div class="form-group">
                <label>Cirujano</label>
                <input type="form-text" class="form-control" id="actualizar_cirujano" name="cirujano" placeholder="Cirujano que realizo muestra">
              </div>
          </form>
        </div>
        
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" onclick="actualizarPacienteAdmin()">Actualizar</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
          <input type="hidden" id="id_paciente_oculto">
        </div>
    </div>
  </div>
</div>

<script>
    function soloLetras(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
       especiales = "8-37-39-46";

       tecla_especial = false
       for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }

        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
    }

    function validacionCaracteresCirujano(e){
      key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " áéíóúabcdefghijklmnñopqrstuvwxyz.";
       especiales = "8-37-39-46";

       tecla_especial = false
       for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }

        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
    }

    function validacionCaracteresRut(e){
      key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = "-.0123456789kK";
       especiales = "8-37-39-46";

       tecla_especial = false
       for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }

        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
    }
</script>