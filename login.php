<?php
// Include config file
require_once 'config.php';
 
// Define variables and initialize with empty values
$rut = $password = $tipo_usuario = $id_area_usuarios = $nombre = $apellido = $id_usuario = "";
$rut_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["rut"]))){
        $rut_err = 'Por favor ingresa el rut.';
    } else{
        $rut = trim($_POST["rut"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST['password']))){
        $password_err = 'Ingresa tu contraseña';
    } else{
        $password = trim($_POST['password']);
    }
    
    // Validate credentials
    if(empty($rut_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT rut, password, tipo_usuario, areas_id_area, nombre, apellido, id_usuario FROM usuarios WHERE rut = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_rut);
            
            // Set parameters
            $param_rut = $rut;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $rut, $hashed_password, $tipo_usuario, $id_area_usuarios, $nombre, $apellido, $id_usuario);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            /* Password is correct, so start a new session and
                            save the username to the session */
                            session_start();
                            $_SESSION['rut'] = $rut;   
                            $_SESSION['tipo_usuario'] = $tipo_usuario;
                            $_SESSION['areas_id_area'] = $id_area_usuarios;
                            $_SESSION['nombre'] = $nombre;  
                            $_SESSION['apellido'] = $apellido;  
                            $_SESSION['id_usuario'] = $id_usuario;

                            /*id_area_usuarios
							USUARIOS
							1- PABELLON
							2- ENDOSCOPIA
							3- HOSPITALIZADOS
							4- ESPECIALIDADES
							5- LABORATORIO
							6- URGENCIAS
							*/

                            if ($tipo_usuario == "Administrador") {
                                header("location: administrador/welcome.php");
                            }elseif ($tipo_usuario == "Administrativo") {
                            	header("location: administrativo/welcome.php");
                            }else{
                                switch ($id_area_usuarios) {
                                case '1':
                                    header("location: Pabellon/welcome.php");
                                    break;
                                case '2':
                                    header("location: Endoscopia/welcome.php");
                                    break;  
                                
                                case '3':
                                    header("location: Hospitalizados/welcome.php");
                                    break;  
                                
                                case '4':
                                    header("location: Especialidades/welcome.php");
                                    break;  
                                
                                case '5':
                                    header("location: Laboratorio/welcome.php");
                                    break;  
                                  
                                case '6':
                                    header("location: Urgencias/welcome.php");
                                    break;  
                                }
                            }
                        } else{
                            // Display an error message if password is not valid
                            $password_err = 'La contraseña ingresada no es correcta.';
                            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                              <strong>!Alerta!</strong> $password_err
                              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                              </button>
                            </div>";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $rut_err = 'Cuenta no corresponde al rut ingresado.';
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                              <strong>!Alerta!</strong> $rut_err
                              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                              </button>
                            </div>";
                }
            } else{
                echo "Algo a ocurrido. Intentalo mas tarde.";
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                              <strong>!Alerta!</strong> $error
                              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                              </button>
                            </div>";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<title>Sistema Trazabilidad de Biopsia - Hospital Penco Lirquen.</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<style type="text/css">
  .error {
	  color: red;
	}


	.rut-error{
	  color: red;
	  }
</style>

<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/logo.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
	
	  <script src="https://code.jquery.com/jquery-3.1.1.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
      <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.17.0/additional-methods.min.js"></script>
      <script src="js/jquery.rut.chileno.min.js"></script>
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" >
			
			<div class="wrap-login100 p-t-50 p-b-90">
				<form class="login100-form validate-form flex-sb flex-w" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="formLoginUsuario">

					<span class="login100-form-title p-b-51">
						Sistema trazabilidad de biopsias
					</span>
					<div class="form-group <?php echo (!empty($rut_err)) ? 'has-error' : ''; ?>">
					<!--<span class="txt1 p-b-11">
						Rut
					</span>-->
					<div class="wrap-input100 validate-input m-b-30" data-validate = "Rut es requerido">
						<input class="input100" type="text" name="rut" value="<?php echo $rut; ?>" placeholder="Rut">
						<span class="focus-input100">
							<!--<?php echo $rut_err; ?>-->
						</span>
					</div>
					
					<!--<span class="txt1 p-b-11">
						Contraseña
					</span>-->
					<div class="wrap-input100 validate-input m-b-30" data-validate = "Contraseña es requerida" <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
						<!--<span class="btn-show-pass">
							<i class="fa fa-eye"></i>
						</span>-->
						<input class="input100" type="password" name="password" placeholder="Contraseña">
						<span class="focus-input100">
							<!--<?php echo $password_err; ?>-->
						</span>
					</div>
					
					<div class="flex-sb-m w-full p-b-48">
						<!--<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								Recordarme
							</label>
						</div>

						<div>
							<a href="#" class="txt3">
								Olvidaste la contraseña?
							</a>
						</div>-->
					</div>

					<div class="container-login100-form-btn m-t-17">
						<button class="login100-form-btn" onclick="validarLogin()">
							Iniciar Sesión
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->




</body>
</html>
<script type="text/javascript">
	function validarLogin(){
    $('#formLoginUsuario').validate({
    rules: {
  	password: {
  		required: true,
  	}
  },
  messages: {
    password: {
      required: 'Debe ingresar su contraseña',
      /*minlength: 'Al menos debe tener 8 caracteres',
      maxlength: 'El rut debe tener un máximo de 9 caracteres'*/
    },
  }, 		
        submitHandler: function () {
            alert("formulario aprobado");
        }
    });


    //validar rut con jquery
    $('#rut').rut({
    	placeholder: false,
    	required: true,
    });

}
</script>
