<?php 

# URL
# http://localhost/token/services.php/login?user=Reinaldo&pass=123

include_once('connection.php');

function login($user, $pass){
    $token = 'NULL';
    $pass = MD5($pass);
    $query = "SELECT * FROM usuarios WHERE user = '".$user."' AND password = '".$pass."' LIMIT 1";
    $mysqli = conectar();
    $result = $mysqli->query($query);

    if($result && $result->num_rows > 0){
        $fila = $result->fetch_assoc();
        $token = SHA1($fila['user'].$fila['password'].$fila['sessionDate']);
        $query2 = 'UPDATE usuarios SET token = "'.$token.'" WHERE id = "'.$fila['id'].'" ';
        $mysqli->query($query2);

        return $token;
    } else {
        return 'Error';
    }
}

function consulta($token){
    $mysqli = conectar();

    $query = 'SELECT * FROM usuarios WHERE token="'.$token.'"';
    $result = $mysqli->query($query);
    
    if($result && $result->num_rows > 0){
        return $result;
    } else {
        return 'Error';
    }
}

$token = login($_GET['user'],$_GET['pass']);
$query = consulta($token);

if($query){
    $fila = $query->fetch_assoc();
    echo ($fila['user'].$fila['password'].$fila['sessionDate']);
}
?>