CREATE DATABASE foro;
USE foro;

CREATE TABLE usuarios (
    ide_usu INT AUTO_INCREMENT PRIMARY KEY,
    nom_usu VARCHAR(100) NOT NULL,
    ema_usu VARCHAR(100) NOT NULL,
    con_usu VARCHAR(100) NOT NULL  
);

CREATE TABLE posts (
    ide_pos INT AUTO_INCREMENT PRIMARY KEY,
    ide_usu INT NOT NULL,
    tit_pos VARCHAR(255) NOT NULL,
    tex_pos VARCHAR(500) NOT NULL,
    fec_pos DATETIME DEFAULT CURRENT_TIMESTAMP,
    can_pos INT DEFAULT 0,
    FOREIGN KEY (ide_usu) REFERENCES usuarios(ide_usu) ON DELETE CASCADE
);

CREATE TABLE respuestas (
    ide_res INT AUTO_INCREMENT PRIMARY KEY,
    ide_pos INT NOT NULL,
    ide_usu INT NOT NULL,
    tex_res VARCHAR(500) NOT NULL,
    fec_res DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (ide_pos) REFERENCES posts(ide_pos) ON DELETE CASCADE,
    FOREIGN KEY (ide_usu) REFERENCES usuarios(ide_usu) ON DELETE CASCADE
);

/*INSERTS */
INSERT INTO usuarios (nom_usu, ema_usu, con_usu) VALUES
('Juan Pérez', 'juan@example.com', 'password123'),
('María García', 'maria@example.com', 'clave456'),
('Carlos López', 'carlos@example.com', 'segura789'),
('Ana Martínez', 'ana@example.com', 'pass2023'),
('David Fernández', 'david@example.com', 'davidpass'),
('Laura Sánchez', 'laura@example.com', 'laurasec');

INSERT INTO posts (ide_usu, tit_pos, tex_pos, fec_pos, can_pos) VALUES
(1, 'Mi primer post', 'Este es mi primer post en la plataforma.', '2024-01-01 10:00:00', 5),
(2, 'Aprendiendo SQL', 'Hoy aprendí sobre las consultas en SQL.', '2024-01-02 12:30:00', 8),
(3, 'Consejos de programación', 'Algunos consejos útiles para mejorar en programación.', '2024-01-03 15:45:00', 12),
(4, 'Base de datos relacionales', 'Explicación sobre bases de datos relacionales y sus ventajas.', '2024-01-04 18:20:00', 3),
(5, 'Errores comunes en SQL', 'Lista de errores comunes que se deben evitar al usar SQL.', '2024-01-05 20:10:00', 7),
(6, 'Buenas prácticas en MySQL', 'Cómo optimizar consultas y mejorar el rendimiento en MySQL.', '2024-01-06 09:30:00', 10);

INSERT INTO respuestas (ide_pos, ide_usu, tex_res, fec_res) VALUES
(1, 2, 'Buen artículo, me sirvió mucho.', '2024-01-01 11:00:00'),
(1, 3, 'Gracias por compartir.', '2024-01-01 11:30:00'),
(2, 4, 'SQL es fundamental en desarrollo.', '2024-01-02 14:00:00'),
(3, 1, 'Muy buenos consejos, los aplicaré.', '2024-01-03 16:10:00'),
(4, 5, 'Gran aporte sobre bases de datos.', '2024-01-04 19:00:00'),
(5, 6, 'Interesante, desconocía algunos errores.', '2024-01-05 21:00:00');