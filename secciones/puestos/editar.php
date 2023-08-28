<?php
include('../../bd.php');
if (isset($_GET['txtID'])) { //Recupero los datos para poder actualizar
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

    $sentencia=$conexion->prepare("SELECT * FROM `puestos` WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();

    $registro=$sentencia->fetch(PDO::FETCH_LAZY);
    $nombrePuesto=$registro['nombrepuesto'];
}

if ($_POST){ //Aqui ya realizmos la actualizacion
    $nombrePuesto=(isset($_POST['nombre_puesto'])?$_POST['nombre_puesto']:""); //recolectamos los datos del input del formulario
    $sentencia=$conexion->prepare("UPDATE puestos SET nombrepuesto=:nombrepuesto WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
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
                <label class="form-label">Nombre del Puesto: </label>
                <input type="text" class="form-control" name="nombre_puesto" value="<?php echo $nombrePuesto;?>">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Actualizar</button>
            </div>
        </form>
    </div>
</div>
<?php include('../../templates/footer.php'); ?>