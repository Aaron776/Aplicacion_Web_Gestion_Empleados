<?php
include ('../../bd.php');
if (isset($_GET['txtID'])) { //Recupero los datos para poder actualizar
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

    $sentencia=$conexion->prepare("SELECT *,(SELECT nombrepuesto FROM puestos WHERE puestos.id=empleados.idpuesto limit 1) as puesto FROM `empleados` WHERE id=:id");
    $sentencia->bindParam(':id',$txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_ASSOC);

    $primer_nombre=$registro['primernombre'];
    $segundo_nombre=$registro['segundonombre'];
    $primer_apellido=$registro['primerapellido'];
    $segundo_apellido=$registro['segundoapellido'];
    $fecha_ingreso=$registro['fecha_ingreso'];
    $puesto=$registro['puesto'];
    $foto=$registro['foto'];
    $cv=$registro['cv']; 
    
    $fechaInicio=new DateTime($fecha_ingreso);
    $fechaFin=new DateTime(date('Y-m-d'));
    $intervalo=date_diff($fechaInicio,$fechaFin);

}

ob_start(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carta Recomendacion</title>
</head>
<body>
    <h1 style="text-align: center;">Carta Recomendacion</h1>
    <p>Quito, Ecuador</p>
    <p>ricardo90@yahoo.com</p>
    <p>0984588833</p>
    <p><?php echo date('d/m/Y');?></p>

    <p>Estimado Jhonathan Sanchez,

    Me complace escribir esta carta de recomendación en apoyo de <?php echo $primer_nombre." ".$segundo_nombre." ".$primer_apellido." ".$segundo_apellido;?>., a quien tuve el placer de supervisar y trabajar junto durante <?php echo $intervalo->format('%y años, %m meses y %d días');?>. en Chevrolet en el puesto de <?php echo $puesto;?>.

    Durante el tiempo que colaboramos juntos, <?php echo $primer_nombre." ".$segundo_nombre." ".$primer_apellido." ".$segundo_apellido;?>, me dijo que era un gran trabajo. demostró un nivel excepcional de habilidad, dedicación y profesionalismo en su trabajo. Su capacidad para enfrentar desafíos y encontrar soluciones efectivas fue verdaderamente impresionante. [Él/Ella] siempre estuvo dispuesto/a a asumir responsabilidades adicionales y a trabajar en equipo para alcanzar los objetivos del proyecto.

    <?php echo $primer_nombre." ".$segundo_nombre." ".$primer_apellido." ".$segundo_apellido;?> posee un amplio conocimiento y experiencia en el area de <?php echo $puesto;?>. Su habilidad para resolver problemas y soluciones creativas fue altamente valorada por el equipo., lo que se reflejó en su habilidad para realizar tareas complejas y cumplir con los plazos establecidos. Su habilidad para analizar situaciones, identificar problemas y proponer soluciones creativas fue altamente valorada por el equipo.

    Además de sus habilidades técnicas, <?php echo $primer_nombre." ".$segundo_nombre." ".$primer_apellido." ".$segundo_apellido;?> se destaca por su capacidad de comunicación clara y efectiva, tanto verbalmente como por escrito. Su habilidad para presentar ideas de manera convincente y concisa fue fundamental para el éxito de varios proyectos en los que trabajamos juntos.

    Más allá de su destreza profesional, <?php echo $primer_nombre." ".$segundo_nombre." ".$primer_apellido." ".$segundo_apellido;?> es una persona amigable, confiable y altamente ética. Su ética laboral, integridad y actitud positiva hacia el trabajo lo convierten en un compañero de equipo ejemplar. [Él/Ella] siempre está dispuesto/a a ayudar a otros y se destaca por su capacidad para manejar situaciones de manera profesional y diplomática.

    Basado/a en mi experiencia trabajando con <?php echo $puesto;?>, <?php echo $primer_nombre." ".$segundo_nombre." ".$primer_apellido." ".$segundo_apellido;?> es un candidato/a para la área de <?php echo $puesto;?>., no tengo ninguna duda de que [Él/Ella] será un activo valioso para cualquier empresa u organización. Su experiencia, habilidades y personalidad encajarían perfectamente en cualquier entorno de trabajo.

    Si necesitas más información o deseas discutir más a fondo las habilidades y competencias de <?php echo $primer_nombre." ".$segundo_nombre." ".$primer_apellido." ".$segundo_apellido;?>, no dudes en contactarme. Estoy encantado/a de brindar cualquier detalle adicional.

    En resumen, recomiendo sinceramente a <?php echo $primer_nombre." ".$segundo_nombre." ".$primer_apellido." ".$segundo_apellido;?> para cualquier posición relacionada con <?php echo $puesto;?>. Estoy seguro/a de que [Él/Ella] hará una contribución significativa y será una adición valiosa para cualquier equipo.

    Le deseo a <?php echo $primer_nombre." ".$segundo_nombre." ".$primer_apellido." ".$segundo_apellido;?> mucho éxito en todas sus futuras empresas. Si tienes alguna pregunta o necesitas más información, no dudes en comunicarte conmigo.</p>

    Atentamente,

    <p>Ricardo Rodriguez</p>
    <p>Jefe de Personal</p>
    <p>Chevrolet</p>
    
</body>
</html>



<?php
require_once('../../libs/autoload.inc.php');
use Dompdf\Dompdf;

$HTML = ob_get_clean();
$dompdf = new Dompdf();
$opciones = $dompdf->getOptions();
$opciones->set(array('isRemoteEnabled' => true));
$dompdf->setOptions($opciones);
$dompdf->loadHtml($HTML);
$dompdf->setPaper('letter');
$dompdf->render();
$dompdf->stream("Carta_Recomendacion.pdf", array("Attachment" => false));




?>
