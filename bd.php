<?php

try {
    $conexion=new PDO("mysql:host=localhost;dbname=gestion_empleados","root","");

}catch (Exception $e){
    echo "Error: ".$e->getMessage();
    die();
}
?>