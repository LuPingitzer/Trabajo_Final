<?php
// Incluir el archivo de configuración para la conexión a la base de datos
include('config/config.php');

// Conectar a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta SQL para obtener los reportes junto con los nombres de los productos
$sql = "
SELECT 
    r.id, 
    p_mas.nombre AS producto_mas_vendido, 
    p_menos.nombre AS producto_menos_vendido, 
    r.fecha_reporte 
FROM 
    Reportes r 
LEFT JOIN 
    Productos p_mas ON r.producto_mas_vendido = p_mas.id 
LEFT JOIN 
    Productos p_menos ON r.producto_menos_vendido = p_menos.id
";

$result = $conn->query($sql);

// Verificar si hay resultados
if ($result->num_rows > 0) {
    // Crear la tabla HTML
    echo "<table border='1'>
    <tr>
        <th>ID</th>
        <th>Producto Más Vendido</th>
        <th>Producto Menos Vendido</th>
        <th>Fecha del Reporte</th>
    </tr>";

    // Mostrar los resultados en la tabla
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>" . $row["id"] . "</td>
            <td>" . $row["producto_mas_vendido"] . "</td>
            <td>" . $row["producto_menos_vendido"] . "</td>
            <td>" . $row["fecha_reporte"] . "</td>
        </tr>";
    }
    echo "</table>";
} else {
    echo"<li><a href='index.html'>Menú</a></li>";
    echo "No hay reportes disponibles.";
}

// Cerrar la conexión
$conn->close();
?>
