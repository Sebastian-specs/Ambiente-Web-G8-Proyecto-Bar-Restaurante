CREATE DATABASE IF NOT EXISTS proyecto_sc502 CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE proyecto_sc502;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(120) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    rol ENUM('admin','cliente') NOT NULL DEFAULT 'cliente',
    token_recuperacion VARCHAR(120) DEFAULT NULL,
    token_expira DATETIME DEFAULT NULL,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE reservas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    fecha DATE NOT NULL,
    hora TIME NOT NULL,
    personas INT NOT NULL,
    comentario VARCHAR(255) DEFAULT NULL,
    estado ENUM('pendiente','aprobada','rechazada') DEFAULT 'pendiente',
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_reserva_usuario FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

INSERT INTO usuarios(nombre, email, password, rol)
VALUES (
    'Administrador',
    'admin@correo.com',
    '$2y$10$wHq3P2qNQ2m0pM7mYkT6AeFEhJ2pA31r1x3Ti8Y6J8fGk9mJf1G3m',
    'admin'
);