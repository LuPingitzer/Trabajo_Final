<?php
// Incluir el archivo de configuración
include('../config/config.php');

// Obtener todos los productos de la base de datos
$sql = "SELECT id, nombre, precio, cantidad FROM Productos";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realizar Venta</title>
    <style>
        .product-info {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h1>Realizar Venta</h1>
    <a href="../ventas.html">Volver a Ventas</a>
    <form action="procesar_venta.php" method="POST">
        <label for="producto">Producto:</label>
        <select name="producto" id="producto" onchange="updateProductInfo()">
            <option value="">Selecciona un producto</option>
            <?php
            // Mostrar los productos en el selector
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row['id'] . '" data-precio="' . $row['precio'] . '" data-cantidad="' . $row['cantidad'] . '">' . $row['nombre'] . '</option>';
                }
            } else {
                echo '<option value="">No hay productos disponibles</option>';
            }
            ?>
        </select>
        <br><br>

        <div id="product-details" class="product-info" style="display: none;">
            <p>Precio: <span id="product-price"></span></p>
            <p>Cantidad disponible: <span id="product-stock"></span></p>
            <label for="cantidad">Cantidad a vender:</label>
            <input type="range" name="cantidad" id="cantidad" min="1" max="1" value="1" oninput="updateQuantityLabel()">
            <span id="quantity-label">1</span>
        </div>
        <br>

        <button type="submit">Realizar Venta</button>
    </form>

    <script>
        function updateProductInfo() {
            const productoSelect = document.getElementById("producto");
            const selectedOption = productoSelect.options[productoSelect.selectedIndex];

            // Obtener el precio y cantidad del producto seleccionado
            const precio = selectedOption.getAttribute("data-precio");
            const cantidad = selectedOption.getAttribute("data-cantidad");

            if (precio && cantidad) {
                document.getElementById("product-price").textContent = `$${precio}`;
                document.getElementById("product-stock").textContent = cantidad;
                document.getElementById("cantidad").max = cantidad;
                document.getElementById("cantidad").value = 1;  // Valor inicial del deslizante
                document.getElementById("quantity-label").textContent = 1;
                document.getElementById("product-details").style.display = "block";
            } else {
                document.getElementById("product-details").style.display = "none";
            }
        }

        function updateQuantityLabel() {
            const cantidad = document.getElementById("cantidad").value;
            document.getElementById("quantity-label").textContent = cantidad;
        }
    </script>
</body>
</html>

<?php
$conn->close();
?>
