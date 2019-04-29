
<div class="modal fade" id="myModalActualizarCambiarPassword">
    <div class="modal-dialog modal-lg" style="width: 600px;">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Cambiar contraseña</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <form method="post" id="formCambiarPassword" role="form"> 
            <!--Ingresar antigua contraseña -->
            <div class="form-group">
              <label>Antigua contraseña</label>
              <input class="form-control" id="antigua_password" name="antigua_password" placeholder="Ingrese antigua contraseña" type="password">  
            </div>           
            <!--Ingresar nueva contraseña -->
            <div class="form-group">
              <label>Nueva contraseña</label>
              <input class="form-control" id="nueva_password" name="nueva_password" placeholder="Ingrese nueva contraseña" type="password">  
            </div>  
            <div class="form-group">
              <label>Confirmar nueva contraseña</label>
              <input class="form-control" id="conf_nueva_password" name="conf_nueva_password" placeholder="Confirme nueva contraseña" type="password">  
            </div> 
            <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Actualizar</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
          <input type="hidden" id="id_usuario_oculto">
        </div>      
          </form>
        </div>
        
        
    </div>
  </div>
</div>

