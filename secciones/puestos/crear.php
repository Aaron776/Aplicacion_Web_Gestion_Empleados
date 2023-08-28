<?php
include('../../bd.php');
if ($_POST){
   $nombrePuesto=(isset($_POST['nombre_puesto'])?$_POST['nombre_puesto']:""); //recolectamos los datos del input del formulario
   $sentencia=$conexion->prepare("INSERT INTO puestos(id,nombrepuesto) VALUES(null,:nombrepuesto)");
   $sentencia->bindParam(":nombrepuesto",$nombrePuesto);
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
                <label for="nombre" class="form-label">Nombre del Puesto: </label>
                <input type="text" class="form-control" name="nombre_puesto" id="nombre">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Guardar Registro</button>
            </div>
        </form>
    </div>
</div>
<?php include('../../templates/footer.php'); ?>