<?php
include('../../bd.php');
if (isset($_GET['txtID'])) { //Recupero los datos para poder actualizar
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

    $sentencia=$conexion->prepare("SELECT * FROM `usuarios` WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();

    $registro=$sentencia->fetch(PDO::FETCH_LAZY);
    $usuario=$registro['usuario'];
    $password=$registro['password'];
    $email=$registro['email'];
}

if ($_POST){ //Aqui ya realizmos la actualizacion
    $user=(isset($_POST['nombre_usuario'])?$_POST['nombre_usuario']:"");
    $pass=(isset($_POST['password'])?$_POST['password']:"");
    $correo=(isset($_POST['email'])?$_POST['email']:"");
    $sentencia=$conexion->prepare("UPDATE usuarios SET usuario=:usuario,password=:password,email=:email WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->bindParam(":usuario",$user);
    $sentencia->bindParam(":password",$pass);
    $sentencia->bindParam(":email",$correo);
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
                <input type="text" name="nombre_usuario" value="<?php echo $usuario; ?>" class="form-control" id="nombre">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label"> Contraseña: </label>
                <input type="password" name="password" value="<?php echo $password; ?>" class="form-control" id="password">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label"> Email: </label>
                <input type="email" name="email" value="<?php echo $email; ?>" class="form-control" id="email">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Actualizar Registro</button>
            </div>
        </form>
    </div>
</div>
<?php include('../../templates/footer.php'); ?>