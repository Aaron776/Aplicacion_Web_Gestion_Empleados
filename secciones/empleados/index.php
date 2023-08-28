<?php
include('../../bd.php');
$sentencia=$conexion->prepare("SELECT *,(SELECT nombrepuesto FROM puestos WHERE puestos.id=empleados.idpuesto limit 1) as puesto FROM `empleados`");
$sentencia->execute();
$lista_empleados=$sentencia->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET['txtID'])) {
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
    $sentencia=$conexion->prepare("SELECT foto,cv FROM empleados WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $registroRecuperado=$sentencia->fetch(PDO::FETCH_LAZY);
    
    if (isset($registroRecuperado["foto"]) && isset($registroRecuperado["foto"])){
        if (file_exists("./".$registroRecuperado["foto"])){
            unlink("./".$registroRecuperado["foto"]);
        }
    }

    if(isset($registroRecuperado["cv"]) && isset($registroRecuperado["cv"])){
        if (file_exists("./".$registroRecuperado["cv"])){
            unlink("./".$registroRecuperado["cv"]);
        }
    }

    $sentencia=$conexion->prepare(" DELETE FROM empleados WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    header("Location:index.php");
}
?>


<?php include('../../templates/header.php'); ?>
<br>
<div class="card">
    <div class="card-header">
        <a href="crear.php" type="button" class="btn btn-primary">Agregar Empleado</a>
    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table" id="empleados">
                <thead>
                    <tr>
                        <th scope="col">Nombre Completo</th>
                        <th scope="col">Foto</th>
                        <th scope="col">CV</th>
                        <th scope="col">Puesto</th>
                        <th scope="col">Fecha Ingresa</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($lista_empleados as $index){?>
                    <tr class="">
                        <td><?php echo $index['primernombre']?> <?php echo $index['primerapellido']?> <?php echo $index['segundonombre']?> <?php echo $index['segundoapellido']?></td>
                        <td>
                            <img src="<?php echo $index['foto']?>" alt="" width="75px">
                        </td>
                        <td>
                            <a href="<?php echo $index['cv']?>"><?php echo $index['cv']?></a>
                        </td>
                        <td><?php echo $index['puesto']?></td>
                        <td><?php echo $index['fecha_ingreso']?></td>
                        <td>
                            <a  type="button" class="btn btn-primary" href="carta_recomendacion.php?txtID=<?php echo $index['id']?>">Carta</a>
                            <a  href="editar.php?txtID=<?php echo $index['id']?>" type="button" class="btn btn-warning">Editar</a>
                            <a  href="index.php?txtID=<?php echo $index['id'];?>" type="button" class="btn btn-danger eliminarRegistro">Eliminar</a>
                        </td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
        
    </div>
</div>
<?php include('../../templates/footer.php'); ?>
<script>
    $(document).ready(function() {
    $('#empleados').DataTable( {
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "No se encontraron resultados",
            "info": " Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "( filtrado de _MAX_ registros totales)",
            "search": "Buscar",
            "paginate": {
                "next": "Siguiente",
                "previous": "Anterior"
            }
        }
    } );
} );
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('.eliminarRegistro').click(function(e) {
            e.preventDefault();
            var url = $(this).attr('href');
            
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡Esta acción no se puede deshacer!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        });
    });
</script>