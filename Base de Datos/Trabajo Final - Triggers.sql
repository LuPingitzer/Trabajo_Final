DELIMITER //

CREATE TRIGGER actualizar_ventas_totales
AFTER INSERT ON Detalles_Ventas
FOR EACH ROW
BEGIN
    UPDATE Productos
    SET ventas_totales = ventas_totales + NEW.cantidad
    WHERE id = NEW.id_producto;
END //

DELIMITER ;

DELIMITER //

CREATE TRIGGER actualizar_mas_vendido
AFTER UPDATE ON Productos
FOR EACH ROW
BEGIN
    DECLARE prod_mas_vendido INT;
    DECLARE prod_menos_vendido INT;

    SELECT id INTO prod_mas_vendido
    FROM Productos
    ORDER BY ventas_totales DESC
    LIMIT 1;

    SELECT id INTO prod_menos_vendido
    FROM Productos
    ORDER BY ventas_totales ASC
    LIMIT 1;

    INSERT INTO Reportes (producto_mas_vendido, producto_menos_vendido)
    VALUES (prod_mas_vendido, prod_menos_vendido);
END //

DELIMITER ;