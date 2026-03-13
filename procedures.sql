USE proyecto_sc502;

DELIMITER $$

CREATE PROCEDURE sp_listar_reservas()
BEGIN
    SELECT r.id, u.nombre, u.email, r.fecha, r.hora, r.personas, r.comentario, r.estado, r.creado_en
    FROM reservas r
    INNER JOIN usuarios u ON u.id = r.usuario_id
    ORDER BY r.fecha DESC, r.hora DESC;
END $$

CREATE PROCEDURE sp_insertar_reserva(
    IN p_usuario_id INT,
    IN p_fecha DATE,
    IN p_hora TIME,
    IN p_personas INT,
    IN p_comentario VARCHAR(255)
)
BEGIN
    INSERT INTO reservas(usuario_id, fecha, hora, personas, comentario)
    VALUES (p_usuario_id, p_fecha, p_hora, p_personas, p_comentario);
END $$

DELIMITER ;