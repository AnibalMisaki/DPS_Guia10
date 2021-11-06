<?php
Header('Access-Control-Allow-Origin:*');
if ($_GET) {
    $comando = $_GET['comando'];
    $servername = "localhost";
    $username = "id17856787_misaki";
    $password = "?i1^=y<(wVmZ}3\$t";
    $dbname = "id17856787_usuarios";
    // Crear la conexión
    $conn = new mysqli(
        $servername,
        $username,
        $password,
        $dbname
    );
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    if ($comando == 'autenticar') {
        $usuario = $_GET["usuario"];
        $contrasena = $_GET["contrasena"];
        $sql = "Select * from usuarios where usuario='$usuario' and
contrasena='$contrasena'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo '{"encontrado":"si"}';
        } else {
            echo '{"encontrado":"no"}';
        }
    }
    $conn->close();
}
