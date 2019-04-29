<?php
   /*-----------INICIAMOS LA SESION---------*/
   session_start(); 
   /*----------------------------*/
   
   /*------------INCLUDES-----------------*/
   include '../config.php';
   include '../modal/modalNuevoPaciente.php';
   include '../modal/modalActualizarPaciente.php';
   /*--------------------------------------*/
   
   // If session variable is not set it will redirect to login page
   if(!isset($_SESSION['rut']) || empty($_SESSION['rut'])){
     //header("location: login.php");
     exit;
   }
   
   //conexion y query para consulta de datatable
   $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
   $query = "SELECT * FROM pacientes ORDER BY id ASC";
   $result = mysqli_query($link, $query);
   ?>
<!DOCTYPE html>
<html>
   <head>
<style type="text/css">

   span > i {
      color: white;
   }
            
   span > input {
      background: none;
      color: white;
      padding: 0;
      border: 0;
   } 

   .dropbtn {
       padding: 20px;
       font-size: 40px;
       border: none;
       cursor: pointer;
       background-color: #fafafa;
   }

   .dropdown {
       position: absolute;
       display: inline-block;

   }

   .dropdown-content {
       display: none;
       position: absolute;
       background-color: #f9f9f9;
       min-width: 250px;
       box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
       z-index: 1;
       right: 10;
   }

   .dropdown-content a {
       color: black;
       padding: 12px 16px;
       text-decoration: none;
       display: block;
   }

   .dropdown-content a:hover {background-color: #f1f1f1}

   .dropdown:hover .dropdown-content {
       display: block;
   }
</style>
      <link rel="icon" type="image/png" href="../images/icons/logo.png"/>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta http-equiv="Content-Type" content="text/html">
      <title>Sistema Trazabilidad de Biopsia - Hospital Penco Lirquen.</title>


      <script src="https://code.jquery.com/jquery-3.1.1.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
      <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.17.0/additional-methods.min.js"></script>
      <script src="../js/jquery.rut.chileno.min.js"></script>
      <!--<script src="http://pagination.js.org/dist/2.1.3/pagination.js"></script>-->
      <!--<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">-->
            
      <!-- Bootstrap CSS CDN -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

      <!--<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>-->
      <!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">-->

      <!-- Css custom slide menu -->
      <link rel="stylesheet" href="../css/slide-menu.css">
      <link rel="stylesheet" href="../css/barraBusqueda.css">
      <link rel="stylesheet" href="../css/tabla-pacientes.css">

      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

      <!-- Font Awesome JS -->
      <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
      <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
      <!-- Popper.JS 
       <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>-->
      
      <!-- Bootstrap JS Modals y otros-->
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

      <!-- jQuery Custom Scroller CDN menu lateral -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

      <script type="text/javascript" src="../js/script.js"></script>

      <!--Script para datatables y sus plugins-->
      <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
      <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
      <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    
   </head>
   <body>
      <div class="wrapper">
         <!-- Sidebar  -->
         <nav id="sidebar">
            <div class="sidebar-header">
               <img src="../images/icons/logo.png" id="" width="60" height="60" style=" margin-right: 5px; margin-top: 6px; margin-bottom: 10px;">
               <h2>Sistema Trazabilidad de Biopsia HPL</h2>
               <!--<p>Tipo Usuario: <?php echo($_SESSION['tipo_usuario']); ?></p>-->

            </div>
            <ul class="list-unstyled components">
               <li>
                  <a href="../Hospitalizados/welcome.php">Listar muestras</a>
               </li>
               <li>
                  <a href="../Hospitalizados/welcomeListarPacientes.php">Listar pacientes</a>
               </li>
            </ul>
         </nav>
         <!-- Page Content  -->
         <div id="content">

            <div>
               <div class="col-sm-11 float-left">
                  <h4 style=" margin-right: 5px; margin-top: 6px; margin-top: 50px;">Bienvenido, <?php echo($_SESSION['nombre']); echo(' '); echo($_SESSION['apellido']); ?>.</h4>
               </div>
               
               <div class="col-sm-1 float-right">
                  <div class="dropdown">
                    <button class="dropbtn"><i class="fas fa-cog"></i></button>
                    <div class="dropdown-content">
                      <!--<a href="#"><i class="fas fa-key"></i> Cambiar Contraseña</a>-->
                      <a href="../logout.php"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
                    </div>
                  </div>
               </div>
            </div> 

            <nav class="navbar navbar-expand-lg navbar-light bg-light col-sm-12">
               <div class="container-fluid">
                  <button type="button" id="sidebarCollapse" class="btn btn-info">
                  <i class="fas fa-align-left"></i>
                  <span>Menú</span>
                  </button>
                  <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <i class="fas fa-align-justify"></i>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                     <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item active">
                           <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalNuevoPaciente">
                           <i class="fas fa-user-plus"></i>
                           <span>Nuevo Paciente</span>
                        </li>
                     </ul>
                  </div>
               </div>
            </nav>

            <!-- Titulo  buscador tabla -->
            <h2 style="margin-bottom: 30px;">Listado de muestras</h2>
            
            <!--<div>
               <input id="myInputBuscar" type="text" placeholder="Buscar muestra..." style="margin-bottom: 10px;">
            </div>-->

            
            <div>
                <div class="display"></div>
            </div>
      </div>
   </body>
</html>


<script type="text/javascript">
   $(document).ready( function () {
  actualizarTabla();
});
</script>
