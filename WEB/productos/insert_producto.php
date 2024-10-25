<?php
include('../config/config.php');

$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];
$cantidad = $_POST['cantidad'];

$sql = "INSERT INTO Productos (nombre, descripcion, precio, cantidad) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssdi", $nombre, $descripcion, $precio, $cantidad);

if ($stmt->execute()) {
    header("Location: ../stock.php");
    exit();
} else {
    echo "Error al agregar el producto: " . $stmt->error;
}

$conn->close();
?>
