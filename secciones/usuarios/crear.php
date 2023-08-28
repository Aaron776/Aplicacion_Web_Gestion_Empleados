<?php
include('../../bd.php');
if ($_POST){
   $usuario=(isset($_POST['nombre_usuario'])?$_POST['nombre_usuario']:""); //recolectamos los datos del input del formulario
   $password=(isset($_POST['password'])?$_POST['password']:"");
   $email=(isset($_POST['email'])?$_POST['email']:"");
   $sentencia=$conexion->prepare("INSERT INTO usuarios(id,usuario,password,email) VALUES(null,:usuario,:password,:email)");
   $sentencia->bindParam(":usuario",$usuario);
   $sentencia->bindParam(":password",$password);
   $sentencia->bindParam(":email",$email);
   $sentencia->execute();
   header("Location:index.php");
}

?>

<?php include('../../templates/header.php'); ?>
<br>
<div class="card">
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nombre" class="form-label"> Usuario: </label>
                <input type="text" name="nombre_usuario" class="form-control" id="nombre">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label"> Contraseña: </label>
                <input type="password" name="password" class="form-control" id="password">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label"> Email: </label>
                <input type="email" name="email" class="form-control" id="email">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Guardar Registro</button>
            </div>
        </form>
    </div>
</div>
<?php include('../../templates/footer.php'); ?>