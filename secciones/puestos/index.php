<?php
include('../../bd.php');

$sentencia=$conexion->prepare("SELECT * FROM `puestos`");
$sentencia->execute();
$lista_puestos=$sentencia->fetchAll(PDO::FETCH_ASSOC);


if (isset($_GET['txtID'])) {
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
    $sentencia=$conexion->prepare(" DELETE FROM puestos WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    header("Location:index.php");
}
?>

<?php include('../../templates/header.php'); ?>
<br>
<div class="card">
    <div class="card-header">
        <a href="crear.php" type="button" class="btn btn-primary">Agregar Puesto</a>
    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table" id="puestos">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($lista_puestos as $index){ ?>
                    <tr class="">
                        <td><?php echo $index['id']; ?></td>
                        <td><?php echo $index['nombrepuesto']; ?></td>
                        <td>
                            <a  class="btn btn-warning" href="editar.php?txtID=<?php echo $index['id'];?>" role="button">Editar</a>
                            <a  class="btn btn-danger eliminarRegistro" href="index.php?txtID=<?php echo $index['id'];?>" role="button">Eliminar</a>
                        </td>
                    <?php } ?>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include('../../templates/footer.php'); ?>
<script>
    $(document).ready(function() {
    $('#puestos').DataTable( {
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