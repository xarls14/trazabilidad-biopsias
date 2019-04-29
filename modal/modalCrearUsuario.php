<style type="text/css">
  .error {
  color: red;
}
</style>
<div class="modal fade" id="myModalCrearUsuario">
    <div class="modal-dialog modal-lg" style="width: 600px;">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Registrar Usuario</h4>
          <button type="button" class="close" data-dismiss="modal" onclick="limpiarNuevoUsuario()">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body" >
          <form id="FormCrearUsuario" method="post" role="form">

            <!--Nombre-->
            <div class="row">
              <div class="form-group col-sm-6">
                <label>Nombre</label>
                <input placeholder="Ingresa nombre" id="nombre" name="nombre" class="form-control" data-validation-engine="validate[required]" maxlength="20" onkeypress="return soloLetras(event)">
              </div>  
            <!--Apellido-->
              <div class="form-group col-sm-6">
                  <label>Apellido</label>
                  <input placeholder="Ingresa apellido" id="apellido" name="apellido" class="form-control" data-validation-engine="validate[required]" maxlength="20" onkeypress="return soloLetras(event)">
              </div> 
            </div>

            <!--Rut -->
            <div class="row">
              <div class="form-group col-sm-12">
                <label>Rut</label>
                <input placeholder="Ingresa rut" id="usuario_rut" name="usuario_rut" class="form-control" data-validation-engine="validate[required]" onkeypress="return validacionCaracteresRut(event)" maxlength="12">
              </div>
            </div>         
            
             
            <!--Email-->
            <div class="row">
              <div class="form-group col-sm-12">
                <label>Email</label>
                <input placeholder="Ingresa email" type="email" id="email" name="email" class="form-control" data-validation-engine="validate[required]" onkeypress="return validarCaracteresEmail(event)" maxlength="50">
              </div>
            </div>
            
            <div class="row">
              <!--Unidad Usuario-->
              <div class="form-group col-sm-6">
                  <label>Unidad usuario</label>
                  <select class="form-control" type="select" id="selectUnidad" name="selectUnidad" placeholder="Seleccione unidad">
                    <option value="1">Pabellon</option>
                    <option value="2">Endoscopia</option>
                    <option value="3">Hospitalizados</option>
                    <option value="4">Especialidades</option>
                    <option value="5">Laboratorio</option>
                    <option value="6">Urgencias</option>
                  </select>
              </div>
              <!--Tipo Usuario-->
              <div class="form-group col-sm-6">
                  <label>Tipo Usuario</label>
                  <select class="form-control" type="select" id="selectUsuario" name="selectUsuario">
                    <option value="Administrador">Administrador</option>
                    <option value="Jefatura">Jefatura</option>
                    <option value="Administrativo">Administrativo</option>
                    <option value="Basico">Básico</option>
                  </select>
              </div>
            </div>
            
            <div class="row">
              <!--contraseña-->
              <div class="form-group col-sm-12">
                  <label>Contraseña</label>
                  <input placeholder="Ingresa contraseña" type="password" id="password" name="password" class="form-control" data-validation-engine="validate[required]" onkeypress="return validarCaracteresPassword(event)" maxlength="30">
              </div>
            </div>
            <div class="row">
              <!--Confirmar contraseña-->
              <div class="form-group col-sm-12">
                  <label>Confirmar Contraseña</label>
                  <input placeholder="Confirma contraseña" type="password" id="conf_password" name="conf_password" class="form-control" data-validation-engine="validate[required]" onkeypress="return validarCaracteresPassword(event)" maxlength="30">
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" name="submit" id="submit" class="btn btn-primary">Crear Usuario</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="limpiarNuevoUsuario()">Cancelar</button>
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

    function validarCaracteresEmail(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = "qwertyuioplkjhgfdsazxcvbnm0123456789.-_@";
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

    function validarCaracteresPassword(e){
      key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = "qwertyuioplkjhgfdsazxcvbnm0123456789.-_";
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