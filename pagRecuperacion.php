<?php
$token = $_GET['token'];
$user = $_GET['user'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperación de Contraseña</title>
</head>
<body>
    <form action="recuperar.php"  method="get" onsubmit="return verificarContrasenas();">
        <label>Contraseña nueva:</label><br>
        <input type="password" id="newPass" name="newPass" required><br><br>
        <label>Confirmar contraseña:</label><br>
        <input type="password" id="confirmPass" required><br><br>
        <input type="hidden" name="token" value="<?php echo $token; ?>">
        <input type="hidden" name="user" value="<?php echo $user; ?>">
        <button type="submit">Cambiar contraseña</button>
    </form>

    <script>
        function verificarContrasenas() {
            var newPass = document.getElementById("newPass").value;
            var confirmPass = document.getElementById("confirmPass").value;

            if (newPass !== confirmPass) {
                alert("Las contraseñas no coinciden.");
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
