<?php
session_start();

function conectar(){
    
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "test";

    $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
    return $conn;
}

?>
