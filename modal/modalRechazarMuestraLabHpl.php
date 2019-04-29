<style type="text/css">
  .error {
  color: red;
}


.rut-error{
  color: red;
  }
</style>

<div class="modal fade" id="myModalRechazarMuestraLabHpl">
    <div class="modal-dialog modal-lg" style="width: 600px;">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Rechazar muestra</h4>
          <button type="button" class="close" data-dismiss="modal" onclick="limpiarNuevoPacienteAdmin()">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <form id="formRechazarMuestraLabHpl" method="post">
            

            <div class="form-group">
              <label>Observaciones</label>
              <input type="form-text" class="form-control" id="observaciones" name="observaciones" placeholder="Ingresar observaciones del rechazo" maxlength="100" onkeypress="return validacionObservacion(event)">

            </div>

            <div class="modal-footer">
              <button type="submit" name="submit" id="submit" class="btn btn-danger" onclick="validarFormRechazarMuestraLabHpl()">Rechazar</button>
              <button type="button" class="btn btn-light" data-dismiss="modal" onclick="limpiarNuevoPacienteAdmin()">Cancelar</button>
            </div>    
          </form>
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

    function validacionObservacion(e){
      key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " áéíóúabcdefghijklmnñopqrstuvwxyz0123456789-/,.";
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