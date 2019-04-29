
<div class="modal fade" id="myModalActualizarPacientesAdmin">
    <div class="modal-dialog modal-lg" style="width: 600px;">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Actualizar paciente</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <form method="post" id="formActualizarPacienteAdmin">
            <!--Nombres y apellidos -->
            <div class="row">
              <div class="form-group col-sm-6">
              <label>Nombres</label>
              <input type="form-text" class="form-control" id="actualizar_nombres" name="nombres" placeholder="Ingresa nombres" maxlength="50" onkeypress="return soloLetras(event)">     
            </div>
              <div class="form-group col-sm-6">
                <label>Apellidos</label>
                <input type="form-text" class="form-control" id="actualizar_apellidos" name="apellidos" placeholder="Ingresa apellidos" maxlength="50" onkeypress="return soloLetras(event)">
              </div>
            </div>
            <!--Rut -->
           <div class="row">
             <div class="form-group col-sm-12">
              <label>Rut</label>
              <input type="form-text" name="rut" class="form-control" id="actualizar_rut" placeholder="Ingresa rut" onkeypress="return validacionCaracteresRut(event)" maxlength="12">     
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
          </form>
        </div>
        
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" onclick="actualizarPacientesAdmin()">Actualizar</button>
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