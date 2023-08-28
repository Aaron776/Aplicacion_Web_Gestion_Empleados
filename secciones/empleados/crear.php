<?php
include('../../bd.php');
if ($_POST){
   $primer_nombre=(isset($_POST['primer_nombre'])?$_POST['primer_nombre']:""); //recolectamos los datos del input del formulario
   $segundo_nombre=(isset($_POST['segundo_nombre'])?$_POST['segundo_nombre']:"");
   $primer_apellido=(isset($_POST['primer_apellido'])?$_POST['primer_apellido']:"");
   $segundo_apellido=(isset($_POST['segundo_apellido'])?$_POST['segundo_apellido']:"");
   $foto=(isset($_FILES['foto']['name'])?$_FILES['foto']['name']:"");
   $cv=(isset($_FILES['cv']['name'])?$_FILES['cv']['name']:"");
   $idpuesto=(isset($_POST['id_puesto'])?$_POST['id_puesto']:"");
   $fecha_ingreso=(isset($_POST['fecha_ingreso'])?$_POST['fecha_ingreso']:"");

   $sentencia=$conexion->prepare("INSERT INTO empleados (id, primernombre, segundonombre, primerapellido, segundoapellido, foto, cv, idpuesto, fecha_ingreso) VALUES (null, :primer_nombre, :segundo_nombre, :primer_apellido,:segundo_apellido, :foto, :cv, :idpuesto, :fecha_ingreso)");
   $sentencia->bindParam(':primer_nombre',$primer_nombre);
   $sentencia->bindParam(':segundo_nombre',$segundo_nombre);
   $sentencia->bindParam(':primer_apellido',$primer_apellido);
   $sentencia->bindParam(':segundo_apellido',$segundo_apellido);

   $fecha_foto=new DateTime();
   $nombreArchivoFoto=($foto!="")?$fecha_foto->getTimestamp()."_".$_FILES['foto']['name']:"";
   $tmp_foto=$_FILES['foto']['tmp_name'];

   if ($tmp_foto!=""){
      move_uploaded_file($tmp_foto,"./".$nombreArchivoFoto);
   }
   $sentencia->bindParam(':foto',$nombreArchivoFoto);

   $fecha_cv=new DateTime();
   $nombreArchivoCv=($cv!="")?$fecha_cv->getTimestamp()."_".$_FILES['cv']['name']:"";
   $tmp_cv=$_FILES['cv']['tmp_name'];

   if ($tmp_cv!=""){
      move_uploaded_file($tmp_cv,"./".$nombreArchivoCv);
   }
   $sentencia->bindParam(':cv',$nombreArchivoCv);

   $sentencia->bindParam(':idpuesto',$idpuesto);
   $sentencia->bindParam(':fecha_ingreso',$fecha_ingreso);
   $sentencia->execute(); 
   header('Location: index.php');
}
$sentencia2=$conexion->prepare("SELECT * FROM `puestos`"); // Aqui traigo los puestos de la tabla páestos de la base de datos
$sentencia2->execute();
$lista_puestos=$sentencia2->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include('../../templates/header.php'); ?>
<br>
<div class="card">
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="" class="form-label">Primer Nombre: </label>
              <input type="text" name="primer_nombre" id="primer_nombre" class="form-control" placeholder="" aria-describedby="helpId">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Segundo Nombre: </label>
                <input type="text" name="segundo_nombre" id="segundo_nombre" class="form-control" placeholder="" aria-describedby="helpId">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Primer Apellido: </label>
                <input type="text" name="primer_apellido" id="primer_apellido" class="form-control" placeholder="" aria-describedby="helpId">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Segundo Apellido: </label>
                <input type="text" name="segundo_apellido" id="segundo_apellido" class="form-control" placeholder="" aria-describedby="helpId">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Foto: </label>
                <input type="file" name="foto" id="foto" class="form-control" placeholder="" aria-describedby="helpId">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">CV (PDF): </label>
                <input type="file" name="cv" id="cv" class="form-control" placeholder="" aria-describedby="helpId">
            </div>
            <div class="mb-3">
                    <label for="" class="form-label">Puesto: </label>
                    <select class="form-select form-select-lg" name="id_puesto" id="id_puesto">
                        <?php foreach($lista_puestos as $index){ ?> <!--Aqui traigo la lista de puestos de la tabla puestos de la base de datos-->
                            <option value="<?php echo $index['id']; ?>"><?php echo $index['nombrepuesto']; ?></option>
                        <?php } ?>
                    </select>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Fecha de Ingreso:</label>
                <input type="date" name="fecha_ingreso" id="fecha_ingreso" class="form-control" placeholder="" aria-describedby="helpId">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Guardar Registro</button>
            </div>
        </form>
    </div>
</div>
<?php include('../../templates/footer.php'); ?>