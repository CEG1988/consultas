<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "myDB";

$conn = new mysqli($servername, $username, $password, $dbname);

// Obtener fechas de inicio y fin del informe
$startDate = $_GET['startDate'];
$endDate = $_GET['endDate'];

// Consulta SQL para obtener las ventas dentro del rango de fechas seleccionado
$sql = "SELECT fecha, SUM(total) AS total_ventas FROM ventas WHERE fecha BETWEEN '$startDate' AND '$endDate' GROUP BY fecha";
$result = $conn->query($sql);

// Preparar datos para el gráfico
$dataPoints = array();
while($row = $result->fetch_assoc()) {
    $dataPoints[] = array("label" => $row["fecha"], "y" => $row["total_ventas"]);
}

// Convertir datos a formato JSON
echo json_encode($dataPoints);

$conn->close();
?>
