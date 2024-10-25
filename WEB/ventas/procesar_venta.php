<?php
include('../config/config.php');

$id_producto = $_POST['producto'];
$cantidad = $_POST['cantidad'];

$sql = "SELECT precio, cantidad FROM Productos WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_producto);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $precio_unitario = $row['precio'];
    $stock_disponible = $row['cantidad'];

    // Verificar si hay suficiente stock
    if ($stock_disponible >= $cantidad) {
        $total = $precio_unitario * $cantidad;

        // Insertar la venta en la tabla Ventas
        $sql_insert = "INSERT INTO Ventas (id_producto, cantidad, precio_unitario, total) VALUES (?, ?, ?, ?)";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bind_param("iidd", $id_producto, $cantidad, $precio_unitario, $total);

        if ($stmt_insert->execute()) {
            // Actualizar el stock del producto
            $nuevo_stock = $stock_disponible - $cantidad;
            $sql_update_stock = "UPDATE Productos SET cantidad = ? WHERE id = ?";
            $stmt_update_stock = $conn->prepare($sql_update_stock);
            $stmt_update_stock->bind_param("ii", $nuevo_stock, $id_producto);
            $stmt_update_stock->execute();

            echo "Venta realizada con éxito.";
        } else {
            echo "Error al realizar la venta.";
        }
    } else {
        echo "Stock insuficiente.";
    }
} else {
    echo "Producto no encontrado.";
}

$conn->close();
?>
