<?php
session_start();
$url_base="http://localhost:8080/Ejemplos%20de%20Sistemas%20Web/Aplicacion_Web_Gestion_Empleados/"
?>

<!doctype html>
<html lang="en">
<head>
  <title>App Gestion Empleados</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
   <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css">
</head>
<body>
  <header>
   <nav class="navbar navbar-expand navbar-light bg-light">
       <ul class="nav navbar-nav">
           <li class="nav-item">
               <a class="nav-link" href="<?php echo $url_base;?>secciones/empleados/index.php">Empleados</a>
           </li>
           <li class="nav-item">
               <a class="nav-link" href="<?php echo $url_base;?>secciones/puestos/index.php">Puestos de Empleados</a>
           </li>
           <li class="nav-item">
               <a class="nav-link" href="<?php echo $url_base;?>secciones/usuarios/index.php">Usuarios</a>
           </li>
           <li class="nav-item">
               <a class="nav-link" href="<?php echo $url_base;?>logout.php">LogOut</a>
           </li>
       </ul>
   </nav>
  </header>
  <main class="container">