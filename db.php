<?php

// Como no usamos Ajax las páginas funcionan cargandose llendo de una a otra sin que tengan un vínculo, por este
// motivo no podemos mostrar datos, entonces la solucíon sin Ajax es iniciar una sesión que nos permita guardar un dato
// y luego traerlo de vuelta y imprimirlo.

// INICIANDO SESIÓN
session_start();

// CONEXIÓN A LA BASE DE DATOS
$conn = mysqli_connect (
    'localhost',
    'root',
    '',
    'fazt_course_php_crud_mysql'
);

?>