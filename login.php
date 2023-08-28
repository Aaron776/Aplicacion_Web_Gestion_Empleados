<?php
include("./bd.php");
session_start();
if($_POST){ // Aqui verifico si existe ese usuario y contraseña que estoy ingresando en el login
    $sentenciaSQL = $conexion->prepare("SELECT *,count(*) as n_usuarios FROM usuarios WHERE usuario=:usuario AND password=:password");
    $usuario=$_POST['usuario'];
    $password=$_POST['password'];

    $sentenciaSQL->bindParam(":usuario",$usuario);
    $sentenciaSQL->bindParam(":password",$password);

    $sentenciaSQL->execute();
    $registro=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

    if($registro['n_usuarios']>0){ // Si existe ese usuario y contraseña, entonces inicio la sesion
        $_SESSION['usuario']=$registro['usuario'];
        $_SESSION['logueado']=true;
        header("Location:index.php");
    }else{
      $mensaje="Usuario o contraseña incorrectos";
    }
}

?>

<!doctype html>
<html lang="en">
<head>
  <title>Login</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>
<body>
 
  <main class="container">
    <div class="row">
        <div class="col-md-4">   
        </div>
        <div class="col-md-4">
            <br><br><br><br><br><br><br>
            <h1 style="text-align:center"><b>Bienvenido</b></h1>
            <br>
            <div class="card">
                <div class="card-body">
                  <?php if(isset($mensaje)){?>
                    <div class="alert alert-danger" role="alert">
                      <strong><?php echo $mensaje;?></strong>
                    </div>
                   <?php }?>
                    
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="username" class="form-label">Usuario: </label>
                            <input type="text" class="form-control" id="usuario" name="usuario">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña:</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="mb-3" style="text-align:center">
                            <button type="submit" class="btn btn-primary">Ingresar</button>
                            <button type="reset" class="btn btn-danger">Limpiar</button>
                        </div>
                </div>
            </div>
        </div>
    </div>
  </main>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>