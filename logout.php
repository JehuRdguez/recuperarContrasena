<?php 

# URL
# http://localhost/token/logout.php/login?user=Reinaldo&pass=123

include_once('services.php');

function logout($token){
    $mysqli = conectar();

    $query = 'SELECT * FROM usuarios WHERE token="'.$token.'"';
    $result = $mysqli->query($query);

    if($result && $result->num_rows > 0){
        $fila = $result->fetch_assoc();
        $query2 = 'UPDATE usuarios SET token = "NULL" WHERE id="'.$fila['id'].'"';
        $mysqli->query($query2);
        
        session_unset();
        session_destroy();
        exit();
    } else {
        return 'Error';
    }
}

$query = logout($token);
?>