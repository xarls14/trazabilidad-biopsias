<style type="text/css">
  .error {
  color: red;
}
</style>
<div class="modal fade" id="myModalNuevoPaciente">
    <div class="modal-dialog modal-lg" style="width: 600px;">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Ingresar muestra</h4>
          <button type="button" class="close" data-dismiss="modal" onclick="limpiarNuevoPacienteAdmin()">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <form id="formCrearPaciente" method="post">
            <!--Nombres y apellidos-->
            <div class="row">
               <div class="form-group col-sm-6">
                <label>Nombres</label>
                <input tdype="form-text" class="form-control" id="nombres" name="nombres" placeholder="Ingresa nombres" maxlength="40" onkeypress="return soloLetras(event)">     
              </div>
              <div class="form-group col-sm-6">
                <label>Apellidos</label>
                <input type="form-text" class="form-control" id="apellidos" name="apellidos" placeholder="Ingresa apellidos" maxlength="40" onkeypress="return soloLetras(event)">     
              </div>
            </div>
            <!--Rut -->
           <div class="row">
            <div class="form-group col-sm-12">
              <label>Rut</label>
              <input type="form-text" class="form-control" id="rut" placeholder="Ingresa rut" name="rut" onkeypress="return validacionCaracteresRut(event)" maxlength="12">     
            </div>
           </div>

           <div class="row">
             <div class="form-group col-sm-6">
                <label>Tipo muestra</label>
              </div>
              <div class="form-group col-sm-5">
                <label>N° Frasco</label>
              </div>
              <div class="form-group col-sm-1">
                <button type="button" class="btn btn-success" href="#" id="addMuestra" style="width: 30px;
                  height: 30px;
                  padding: 6px 0px;
                  border-radius: 15px;
                  text-align: center;
                  font-size: 12px;
                  line-height: 1.42857;
                  float: right;">
                  <i class="fas fa-plus"></i></button> 
              </div>
           </div>


           <div class="row">
            <!--Tipo Muestra -->
             <div class="form-group col-sm-6">
               <input type="form-text" class="form-control" id="tipo_muestra" name="tipo_muestra[]" placeholder="Ingresa tipo muestra N°1" maxlength="60">
             </div>

             <div class="form-group col-sm-6">
               <input type="form-text" class="form-control" id="num_frasco" name="num_frasco[]" placeholder="Ingrese N° frasco" min="1" max="99" maxlength="2">
             </div>
           </div>

           <div class="row" id="muestras" style="margin-top: 8px;"></div>
            
           <div class="row">
             <!--Establecimiento de origen -->
              <div class="form-group col-sm-12">
                <label>Establecimiento origen</label>
                <input type="form-text" class="form-control" id="establecimiento_origen" name="establecimiento_origen" placeholder="HPL" disabled="true">     
              </div>
           </div> 
              
            <!--Unidad Paciente (Solo debe salir cuando se abre desde administrador)-->
            <div class="form-group" style="display: none;">
                <label>Unidad paciente</label>
                <select class="form-control" type="select" id="unidad_origen" name="unidad_origen">
                  <option value="1">Pabellon</option>
                  <option value="2">Endoscopia</option>
                  <option value="3">Hospitalizados</option>
                  <option value="4">Especialidades</option>
                  <option value="5">Laboratorio</option>
                  <option value="6">Urgencias</option>
                </select>
            </div>
            <div class="form-group">
              <label>Cirujano</label>
              <input type="form-text" class="form-control" id="cirujano" name="cirujano" placeholder="Cirujano que realizo muestra" maxlength="20" onkeypress="return validacionCaracteresCirujano(event)">
            </div>
           <div class="modal-footer">
          <button type="submit" class="btn btn-primary" onclick="validarFormPaciente()">Agregar</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="limpiarNuevoPacienteAdmin()">Cancelar</button>
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