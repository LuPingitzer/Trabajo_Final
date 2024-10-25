<?php
include('../config/config.php');

$sql = "SELECT Ventas.id, Productos.nombre AS producto, Ventas.cantidad, Ventas.precio_unitario, Ventas.total, Ventas.fecha_venta 
        FROM Ventas 
        JOIN Productos ON Ventas.id_producto = Productos.id
        ORDER BY Ventas.fecha_venta DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Ventas</title>
</head>
<body>
    <h1>Historial de Ventas</h1>
    <a href="../ventas.html">Volver a Ventas</a>
    <table border="1">
        <thead>
            <tr>
                <th>ID Venta</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Total</th>
                <th>Fecha de Venta</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['producto'] . "</td>";
                    echo "<td>" . $row['cantidad'] . "</td>";
                    echo "<td>$" . $row['precio_unitario'] . "</td>";
                    echo "<td>$" . $row['total'] . "</td>";
                    echo "<td>" . $row['fecha_venta'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No se encontraron ventas</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>

<?php
$conn->close();
?>
