<?php

$conn = pg_connect("host=mageova-postgres.ccfjejrsiibd.us-east-2.rds.amazonaws.com port=5432 dbname=Mageova_New user=mageova password=Jalisconoterajes");

if (!$conn) {
    die('Error al conectar con la base de datos: ' . pg_connect_error());
}
?>
