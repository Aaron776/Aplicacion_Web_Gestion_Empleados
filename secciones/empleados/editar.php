<?php
include('../../bd.php');
if (isset($_GET['txtID'])) { //Recupero los datos para poder actualizar
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

    $sentencia=$conexion->prepare("SELECT * FROM `empleados` WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_ASSOC);

    $primer_nombre=$registro['primernombre'];
    $segundo_nombre=$registro['segundonombre'];
    $primer_apellido=$registro['primerapellido'];
    $segundo_apellido=$registro['segundoapellido'];
    $fecha_ingreso=$registro['fecha_ingreso'];
    $puesto=$registro['idpuesto'];
    $foto=$registro['foto'];
    $cv=$registro['cv'];
    
    $sentencia2=$conexion->prepare("SELECT * FROM `puestos`"); // Aquí traigo los puestos de la tabla puestos de la base de datos
    $sentencia2->execute();
    $lista_puestos=$sentencia2->fetchAll(PDO::FETCH_ASSOC);   
}

if ($_POST){ //Aquí ya realizamos la actualización
    $first_name=(isset($_POST['primer_nombre'])?$_POST['primer_nombre']:"");
    $second_name=(isset($_POST['segundo_nombre'])?$_POST['segundo_nombre']:"");
    $first_surname=(isset($_POST['primer_apellido'])?$_POST['primer_apellido']:"");
    $second_surname=(isset($_POST['segundo_apellido'])?$_POST['segundo_apellido']:"");
    $puestoActualizado=(isset($_POST['id_puesto'])?$_POST['id_puesto']:"");
    $fecha_ingresoActualizado=(isset($_POST['fecha_ingreso'])?$_POST['fecha_ingreso']:"");

    $photo=(isset($_FILES['foto']['name'])?$_FILES['foto']['name']:"");
    $cvnuevo=(isset($_FILES['cv']['name'])?$_FILES['cv']['name']:"");

    $sentencia3=$conexion->prepare("UPDATE empleados SET primernombre=:primernombre, segundonombre=:segundonombre, primerapellido=:primerapellido, segundoapellido=:segundoapellido, foto=:foto, cv=:cv, idpuesto=:idpuesto, fecha_ingreso=:fecha_ingreso WHERE id=:id");
    $sentencia3->bindParam(":id",$txtID);
    $sentencia3->bindParam(":primernombre",$first_name);
    $sentencia3->bindParam(":segundonombre",$second_name);
    $sentencia3->bindParam(":primerapellido",$first_surname);
    $sentencia3->bindParam(":segundoapellido",$second_surname);
    $sentencia3->bindParam(":foto",$foto);
    $sentencia3->bindParam(":cv",$cv);
    $sentencia3->bindParam(":idpuesto",$puestoActualizado);
    $sentencia3->bindParam(":fecha_ingreso",$fecha_ingresoActualizado);

    
    // Eliminamos la foto actual
    if ($_FILES['foto']['tmp_name']) {
        $fotoActual = $registro['foto'];
        if (isset($fotoActual) && file_exists("./" . $fotoActual)) {
            unlink("./" . $fotoActual);
        }
    }

    // Eliminamos el CV actual
    if ($_FILES['cv']['tmp_name']) {
        $cvActual = $registro['cv'];
        if (isset($cvActual) && file_exists("./" . $cvActual)) {
            unlink("./" . $cvActual);
        }
    }
    
    // Actualizamos la foto
    if ($_FILES['foto']['tmp_name']) {
    $fotoActual = $registro['foto'];
    if (isset($fotoActual) && file_exists("./" . $fotoActual)) {
        unlink("./" . $fotoActual);
    }
}

    // Actualizamos el CV
    if ($_FILES['cv']['tmp_name']){
        $fecha_cv = new DateTime();
        $nombreArchivoCv = $fecha_cv->getTimestamp()."_".$_FILES['cv']['name'];
        $tmp_cv = $_FILES['cv']['tmp_name'];

        move_uploaded_file($tmp_cv, "./".$nombreArchivoCv);

        $sentencia3->bindParam(':cv', $nombreArchivoCv);
    }

    $sentencia3->execute();
    header("Location:index.php");
}
?>


<?php include('../../templates/header.php'); ?>
<br>
<div class="card">
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="" class="form-label">Primer Nombre: </label>
              <input type="text" name="primer_nombre" id="primer_nombre" value="<?php echo $primer_nombre; ?>" class="form-control" placeholder="" aria-describedby="helpId">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Segundo Nombre: </label>
                <input type="text" name="segundo_nombre" id="segundo_nombre" value="<?php echo $segundo_nombre; ?>"  class="form-control" placeholder="" aria-describedby="helpId">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Primer Apellido: </label>
                <input type="text" name="primer_apellido" id="primer_apellido" value="<?php echo $primer_apellido; ?>" class="form-control" placeholder="" aria-describedby="helpId">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Segundo Apellido: </label>
                <input type="text" name="segundo_apellido" id="segundo_apellido" value="<?php echo $segundo_apellido; ?>"  class="form-control" placeholder="" aria-describedby="helpId">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Foto: </label>
                <input type="file" name="foto" id="foto" class="form-control" value="<?php echo $foto; ?>" placeholder="" aria-describedby="helpId">
                <br>
                <img src="<?php echo $foto?>" alt="" width="75px">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">CV (PDF): </label>
                <input type="file" name="cv" id="cv" class="form-control" value="<?php echo $cv; ?>" placeholder="" aria-describedby="helpId">
                <br>
                <a href="<?php echo $cv; ?>"><?php echo $cv; ?></a> 
            </div>
            <div class="mb-3">
                    <label for="" class="form-label">Puesto: </label>
                    <select class="form-select form-select-lg" name="id_puesto" id="id_puesto">
                        <?php foreach($lista_puestos as $index){ ?> <!--Aqui traigo la lista de puestos de la tabla puestos de la base de datos-->
                            <option <?php if($index['id']==$puesto){echo "selected";} ?> value="<?php echo $index['id']; ?>"><?php echo $index['nombrepuesto']; ?></option>
                        <?php } ?>
                    </select>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Fecha de Ingreso:</label>
                <input type="date" name="fecha_ingreso" id="fecha_ingreso"  value="<?php echo $fecha_ingreso; ?>" class="form-control" placeholder="" aria-describedby="helpId">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Actualizar Registro</button>
            </div>
        </form>
    </div>
</div>
<?php include('../../templates/footer.php'); ?>