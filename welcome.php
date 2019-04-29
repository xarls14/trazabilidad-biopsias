<?php
   /*-----------INICIAMOS LA SESION---------*/
   session_start(); 
   /*----------------------------*/
   
   /*------------INCLUDES-----------------*/
   include 'config.php';
   include 'modal/modalNuevoPaciente.php';
   include 'modal/modalActualizarPaciente.php';
   include 'modal/ModalCrearUsuario.php';
   include 'registrar.php';
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
      </style>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!--Icono Corporativo-->
      <link rel="icon" type="image/png" href="images/icons/logo.png"/>
      <title>Lista Pacientes HPL</title>
      <!-- Bootstrap CSS CDN -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
      <!-- Css custom slide menu -->
      <link rel="stylesheet" href="css/slide-menu.css">
      <link rel="stylesheet" href="css/barraBusqueda.css">
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
   </head>
   <body>
      <div class="wrapper">
         <!-- Sidebar  -->
         <nav id="sidebar">
            <div class="sidebar-header">
               <img src="images/icons/logo.png" id="" width="40" height="40" style="float: left; margin-right: 5px; margin-top: 6px;">
               <h3>Laboratorio HPL</h3>
            </div>
            <ul class="list-unstyled components">
               <li class="active">
                  <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Inicio</a>
                  <ul class="collapse list-unstyled" id="homeSubmenu">
                     <li>
                        <a href="#">Opción 1</a>
                     </li>
                     <li>
                        <a href="#">Opción 2</a>
                     </li>
                     <li>
                        <a href="#">Opción 3</a>
                     </li>
                  </ul>
               </li>
               <li>
                  <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Páginas</a>
                  <ul class="collapse list-unstyled" id="pageSubmenu">
                     <li>
                        <a href="#">Páginas 1</a>
                     </li>
                     <li>
                        <a href="#">Páginas 2</a>
                     </li>
                     <li>
                        <a href="#">Páginas 3</a>
                     </li>
                  </ul>
               </li>
               <li>
                  <a href="#">Contactos</a>
               </li>
            </ul>
            <ul class="list-unstyled CTAs" style="margin-top: 300px;">

               <li>
                  <a class="nuevoUsuario" href="#" data-toggle="modal" data-target="#myModalCrearUsuario">
                  <i class="fas fa-user-plus">  
                  </i>
                  <span>Nuevo Usuario</span>
                  </a> 
               </li>
               <li>
                  <a href="logout.php" class="cerrarSesion">
                  <i class="fas fa-sign-out-alt">
                  </i>
                  <span>Cerrar Sesión</span>
                  </a>
               </li>
            </ul>
         </nav>
         <!-- Page Content  -->
         <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
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
            <a href="javascript:printData('muestra')">Imprimir Tabla</a>
            <h2 style="margin-bottom: 30px;">Listado de pacientes</h2>
            <div>
               <input id="myInputBuscar" type="text" placeholder="Buscar paciente....." style="margin-bottom: 10px;">
               <div class="btn-group" role="group" aria-label="Basic example" style="margin-bottom: 10px;">
                  <button type="button" class="btn btn-secondary"><i class="fas fa-file-excel"></i><span> Excel</span>
                  <button type="button" class="btn btn-secondary"><i class="fas fa-file-pdf"></i><span> Pdf</span>
                  <button type="button" class="btn btn-secondary"><i class="fas fa-print"></i><span> Imprimir</span>
               </div>
            </div>

            <div class="form-group" style="margin-top: 20px;">
                <h4>N° Registros</h4>
                <select class="form-control-sm" id="maxRows"  style="width: 100px;">
                    <option value="10">10</option>     
                    <option value="20">20</option>
                    <option value="30">30</option>
                </select>
            </div>

            

            <!-- mostramos tabla dinamica -->
            <div>
                <div class="display"></div>
                <div style="margin-top: 30px;">
                    <ul class="pagination pagination-sm">
                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </div>
            </div>
            

      </div>
      <!-- Font Awesome JS -->
      <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
      <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
      <!-- jQuery CDN - Slim version (=without AJAX) -->
      <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
      <!-- Popper.JS -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
      <!-- Bootstrap JS -->
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
      <!-- jQuery Custom Scroller CDN -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
      <script type="text/javascript" src="js/script.js"></script>
   </body>
</html>