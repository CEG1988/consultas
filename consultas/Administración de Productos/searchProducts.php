<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "S3gur1d4d";
$dbname = "myDB";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar si se recibió la variable 'searchText'
if(isset($_GET['searchText'])) {
    // Consulta SQL para buscar productos por nombre o categoría
    $searchText = $_GET['searchText'];
    $sql = "SELECT * FROM `productos` WHERE nombre LIKE '%$searchText%' OR categoria LIKE '%$searchText%'";
    $result = $conn->query($sql);

    // Generar tabla HTML con los resultados
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["nombre"] . "</td><td>" . $row["categoria"] . "</td><td>" . $row["precio"] . "</td><td>" . $row["stock"] . "</td></tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No se encontraron productos</td></tr>";
    }
} else {
    echo "<tr><td colspan='4'>Por favor, ingrese un término de búsqueda</td></tr>";
}
$conn->close();
?>

