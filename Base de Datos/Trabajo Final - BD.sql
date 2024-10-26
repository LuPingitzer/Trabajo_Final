CREATE DATABASE botonescierres;
USE botonescierres;
CREATE TABLE Productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10, 2) NOT NULL,
    cantidad INT NOT NULL,
    ventas_totales INT DEFAULT 0,
    fecha_agregado TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Ventas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    total DECIMAL(10, 2),
    id_producto INT,
    cantidad INT NOT NULL,
    precio_unitario DECIMAL(10, 2),
    fecha_venta TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_producto) REFERENCES Productos(id)
);


CREATE TABLE Reportes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    producto_mas_vendido INT,
    producto_menos_vendido INT,
    fecha_reporte TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (producto_mas_vendido) REFERENCES Productos(id),
    FOREIGN KEY (producto_menos_vendido) REFERENCES Productos(id)
);