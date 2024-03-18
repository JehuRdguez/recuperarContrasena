<?php 

include_once('connection.php');

if(isset($_GET['token'])) {

    if($_GET['token'] !== 'Error') {
        $result = recuperarContrasena($_GET['token'], $_GET['user'], $_GET['newPass']);
        if($result) {
            echo 'Su contraseña ha sido restablecida exitosamente.';
        } else {
            echo 'Error';
        }
    } else {
        echo 'Error';
    }
} else {

    if(isset($_GET['user'])) {
        $user = $_GET['user'];

        $token = generarToken($user);
        
        if($token !== '') {

            echo 'Enlace de recuperación: http://localhost/token/pagRecuperacion.php?token='.$token.'&user='.$user;
        } else {
            echo 'Error';
        }
    }
}



function generarToken($user){
    $token = 'NULL';
    $mysqli = conectar();
    
    $query = "SELECT * FROM usuarios WHERE user = '".$user."' LIMIT 1";
    $result = $mysqli->query($query);

    if($result && $result->num_rows > 0){
        $token = SHA1($user.microtime());
        
        $query2 = 'UPDATE usuarios SET tokenRecup = "'.$token.'" WHERE user = "'.$user.'"';
        $mysqli->query($query2);

        return $token;
    } else {
        return 'Error';
    }
}

function recuperarContrasena($token, $user, $newPass){
    $mysqli = conectar();
    
    $query = "SELECT * FROM usuarios WHERE user = '".$user."' AND tokenRecup = '".$token."' LIMIT 1";
    $result = $mysqli->query($query);

    if($result && $result->num_rows > 0){
        $pass = md5($newPass);
        $query2 = 'UPDATE usuarios SET password = "'.$pass.'", tokenRecup = "NULL" WHERE user = "'.$user.'"';
        $mysqli->query($query2);

        return true;
    } else {
        return false;
    }
}

?>