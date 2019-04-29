<?php
// Include config file
require_once 'config.php';
 
// Define variables and initialize with empty values
$rut = $password = $confirmar_password = $nombre = $apellido = $email = "";
$rut_err = $password_err = $confirmar_password_err = $nombre_err = $apellido_err = $email_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate rut
    if(empty(trim($_POST["rut"]))){
        $rut_err = '<a style="color:red;">Debes ingresar el rut.</a>';//"Debes ingresar el rut";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM usuarios WHERE rut = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_rut);
            
            // Set parameters
            $param_rut = trim($_POST["rut"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $rut_err = '<a style="color:red;">Este rut ya se encuentra registrado.</a>';//"Este rut ya se encuentra registrado.";
                } else{
                    $rut = trim($_POST["rut"]);
                }
            } else{
                echo "Algo ha ocurrido, porfavor intentalo mas tarde.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    //validamos nombre vacio
    if(empty(trim($_POST['nombre']))){
        $nombre_err = '<a style="color:red;">Debes ingresar el nombre.</a>';//"Debes ingresar el nombre";
        $nombre = "";
    }else{
        $nombre = trim($_POST['nombre']);
    }

    //validamos apellido vacio
    if(empty(trim($_POST['apellido']))){
        $apellido_err = '<a style="color:red;">Debes ingresar el apellido.</a>';//"Debes ingresar el apellido";
    }else{
        $apellido = trim($_POST['apellido']);
    }

    //validamos email vacio
    if(empty(trim($_POST['email']))){
        $email_err = '<a style="color:red;">Debes ingresar el email.</a>';//"Debes ingresar el email";
    }else{
        $email = trim($_POST['email']);
    }

    // Validate password
    if(empty(trim($_POST['password']))){
        $password_err = '<a style="color:red;">Debes ingresar una contraseña.</a>';//"Debes ingresar una contraseña";     
    } elseif(strlen(trim($_POST['password'])) < 6){
        $password_err = '<a style="color:red;">La contraseña debe tener al menos 6 caracteres.</a>';//"La contraseña debe tener al menos 6 caracteres.";
    } else{
        $password = trim($_POST['password']);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirmar_password"]))){
        $confirmar_password_err = '<a style="color:red;">Debes confirmar la contraseña.</a>';//'Debes confirmar la contraseña.';     
    } else{
        $confirmar_password = trim($_POST['confirmar_password']);
        if($password != $confirmar_password){
            $confirmar_password_err = '<a style="color:red;">La contraseña no coincide.</a>'; //'La contraseña no coincide.';
        }
    }
    
    // Revisamos errores en los imput antes de hacer insert en la BD
    if(empty($rut_err) && empty($password_err) && empty($confirmar_password_err) && empty($nombre_err) && empty($apellido_err) && empty($email_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO usuarios (rut, password, nombre, apellido, email, tipo_usuario, areas_id_area) VALUES (?,?,?,?,?,'Jefatura','4')";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_rut, $param_password, $param_nombre, $param_apellido, $param_email);
            
            // Set parameters
            $param_rut = $rut;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_nombre = $nombre;
            $param_apellido = $apellido;
            $param_email = $email;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                //header("location: login.php");
            } else{
                echo "Algo ha ocurrido, porfavor intentalo mas tarde.";
                
            }
        }
         
        // Close statement
        //var_dump(mysqli_error($link)); //detalles error conexion
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>



 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
</head>
<body>
    <div class="modal fade" id="myModalNuevoUsuario">
        <div class="modal-dialog modal-lg">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Registrar Usuario</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body" >
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" id="nuevoUsuarioForm">
            <!--Rut -->
            <div class="form-group <?php echo (!empty($rut_err)) ? 'has-error' : ''; ?>">
                <label>Rut</label>
                <input placeholder="Ingresa rut" type="form-text" name="rut" class="form-control" value="<?php echo $rut; ?>">
                <span class="help-block"><?php echo $rut_err; ?></span>
            </div>    
            <!--Nombre-->
            <div class="form-group <?php echo (!empty($nombre_err)) ? 'has-error' : ''; ?>">
                <label>Nombre</label>
                <input placeholder="Ingresa nombre" type="form-text" name="nombre" class="form-control" value="<?php echo $nombre; ?>">
                <span class="help-block"><?php echo $nombre_err; ?></span>
            </div>  
            <!--Apellido-->
            <div class="form-group <?php echo (!empty($apellido_err)) ? 'has-error' : ''; ?>">
                <label>Apellido</label>
                <input placeholder="Ingresa apellido" type="form-text" name="apellido" class="form-control" value="<?php echo $apellido; ?>">
                <span class="help-block"><?php echo $apellido_err; ?></span>
            </div>  
            <!--Email-->
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input placeholder="Ingresa email" type="email" name="email" class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>
            <!--contraseña-->
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Contraseña</label>
                <input placeholder="Ingresa contraseña" type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <!--Confirmar contraseña-->
            <div class="form-group <?php echo (!empty($confirmar_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirmar Contraseña</label>
                <input placeholder="Confirma conraseña" type="password" name="confirmar_password" class="form-control" value="<?php echo $confirmar_password; ?>">
                <span class="help-block"><?php echo $confirmar_password_err; ?></span>
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-primary" value="Registrar">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </form>
        </div>
    </div>
  </div>
        
        
    </div>    
</body>
</html>
