<?php
include('../config/config.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT nombre, cantidad FROM Productos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $producto = $result->fetch_assoc();
    } else {
        echo "Producto no encontrado.";
        exit;
    }
} else {
    echo "ID de producto no proporcionado.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nueva_cantidad = $_POST['cantidad'];
    $sql = "UPDATE Productos SET cantidad = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $nueva_cantidad, $id);

    if ($stmt->execute()) {
        header("Location: ../stock.php");
        exit();
    } else {
        echo "Error al actualizar el stock.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Stock</title>
</head>
<body>
    <h1>Actualizar Stock de <?php echo $producto['nombre']; ?></h1>
    <li><a href="../stock.php">Stock</a></li>
    <form action="" method="POST">
        <label for="cantidad">Cantidad Actual:</label>
        <input type="number" id="cantidad_actual" value="<?php echo $producto['cantidad']; ?>" disabled>
        <br><br>

        <label for="cantidad">Nueva Cantidad en Stock:</label>
        <input type="number" name="cantidad" id="cantidad" required>
        <br><br>

        <button type="submit">Actualizar Stock</button>
    </form>

    <br>
    <a href="../stock.php">Volver al stock</a>
</body>
</html>

<?php
$conn->close();
?>
