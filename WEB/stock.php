<?php
include('config/config.php');

$sql = "SELECT id, nombre, descripcion, precio, cantidad FROM Productos";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock</title>
</head>
<body>
    <h1>Stock</h1>
    <li><a href="index.html">Menú</a></li>
    <li><a href="productos/agregar_producto.html">Agregar producto</a></li>
    <table border="1">
        <thead>
            <tr>
                <th>ID Producto</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Cantidad en Stock</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['nombre'] . "</td>";
                    echo "<td>" . $row['descripcion'] . "</td>";
                    echo "<td>$" . $row['precio'] . "</td>";
                    echo "<td>" . $row['cantidad'] . "</td>";
                    echo "<td><a href='productos/actualizar_stock.php?id=" . $row['id'] . "'>Actualizar Stock</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No hay productos disponibles</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>

<?php
$conn->close();
?>
