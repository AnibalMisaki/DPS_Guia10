<?php
Header('Access-Control-Allow-Origin: *');
if ($_GET) {
    $comando = $_GET['comando'];
    $servername = "localhost";
    $username = "id17856787_misaki";
    $password = "?i1^=y<(wVmZ}3\$t";
    $dbname = "id17856787_usuarios";
    // Crear conexión
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
    if ($comando == 'agregar') {
        $direccion_postal = $_GET["direccion_postal"];
        $direccion_trabajo = $_GET["direccion_trabajo"];
        $email = $_GET["email"];
        $nivel_economico = $_GET["nivel_economico"];
        $nombre = $_GET["nombre"];
        $telefono = $_GET["telefono"];
        $sql = "INSERT INTO cliente
(direccion_postal,direccion_trabajo,email,nivel_economico,nombre,telefono)
VALUES ('$direccion_postal', '$direccion_trabajo',
'$email','$nivel_economico','$nombre','$telefono')";
        if ($conn->query($sql) === TRUE) {
            echo '{"mensaje":"Nuevo registro añadido"}';
        } else {
            echo '{"error: "' . $sql . ' ' . $conn->error . '"}';
        }
    }
    if ($comando == 'editar') {
        $direccion_postal = $_GET["direccion_postal"];
        $direccion_trabajo = $_GET["direccion_trabajo"];
        $email = $_GET["email"];
        $nivel_economico = $_GET["nivel_economico"];
        $nombre = $_GET["nombre"];
        $telefono = $_GET["telefono"];
        $id = $_GET["id"];
        $sql = "UPDATE cliente SET direccion_postal='$direccion_postal',
direccion_trabajo='$direccion_trabajo',email='$email',
nivel_economico='$nivel_economico', nombre='$nombre', telefono='$telefono'
WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo '{"mensaje":"Registro actualizado"}';
        } else {
            echo '{"error: "' . $sql . ' ' . $conn->error . '"}';
        }
    }
    if ($comando == 'eliminar') {
        $id = $_GET["id"];
        // sql to delete a record
        $sql = "DELETE FROM cliente WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo '{"mensaje":"Registro eliminado"}';
        } else {
            echo '{"error: "' . $sql . ' ' . $conn->error . '"}';
        }
    }
    if ($comando == 'listar') {
        $sql = "SELECT * FROM cliente";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // obtener cada uno de los registros y almacenarlos en un vector y luego regresarlos en formato json
            $registros = array();
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " .
                $registros[$i] = $row;
                $i++;
            }
            echo '{"records":' . json_encode($registros) . '}';
        } else {
            echo '{"records":[]}';
        }
    }
    $conn->close();
}