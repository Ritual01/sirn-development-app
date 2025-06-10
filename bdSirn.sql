-- Tabla de usuarios
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Tabla de muestras, con FK a usuarios
CREATE TABLE muestras (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    lugar VARCHAR(100) NOT NULL,
    fecha DATE NOT NULL,
    nivel_cloro DECIMAL(5,2) NOT NULL,
    turbidez DECIMAL(5,2) NOT NULL, -- Nuevo atributo
    ph DECIMAL(4,2) NOT NULL,       -- Nuevo atributo
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

-- Tabla de analisis, con FK a muestras
CREATE TABLE analisis (
    id INT AUTO_INCREMENT PRIMARY KEY,
    muestra_id INT NOT NULL,
    resultado VARCHAR(255),
    fecha_analisis DATE NOT NULL,
    FOREIGN KEY (muestra_id) REFERENCES muestras(id)
);

-- Insertar usuarios
PS C:\xampp\mysql\bin> .\mysql.exe -h w29ifufy55ljjmzq.cbetxkdyhwsb.us-east-1.rds.amazonaws.com -u htvv7guq3cc1i2yi -pb79bapb51asa0mme k9ek3c3nz5ipfihw -e "INSERT INTO usuarios (nombre, correo, password) VALUES
('admin', 'admin@correo.com', '1234'),
('usuario', 'usuario@correo.com', '1234');"

-- Insertar muestras (asociadas a usuarios: 1=admin, 2=usuario)
.\mysql.exe -h w29ifufy55ljjmzq.cbetxkdyhwsb.us-east-1.rds.amazonaws.com -u htvv7guq3cc1i2yi -pb79bapb51asa0mme k9ek3c3nz5ipfihw -e "INSERT INTO muestras (usuario_id, lugar, fecha, nivel_cloro, turbidez, ph) VALUES
(1, 'Pozo Norte', '2025-06-01', 1.29, 7.69, 7.74),
(2, 'Pozo Sur', '2025-06-02', 0.9, 9.4, 5.83),
(1, 'Pozo Este', '2025-06-03', 0.1, 0.49, 6.56),
(2, 'Pozo Oeste', '2025-06-04', 1.01, 2.12, 9.89),
(1, 'Pozo Central', '2025-06-05', 0.44, 4.59, 9.95),
(2, 'Pozo Norte', '2025-06-06', 0.0, 2.84, 5.16),
(1, 'Pozo Sur', '2025-06-07', 1.88, 0.15, 8.16),
(2, 'Pozo Este', '2025-06-08', 1.2, 6.33, 7.63),
(1, 'Pozo Oeste', '2025-06-09', 0.93, 5.92, 9.01),
(2, 'Pozo Central', '2025-06-10', 1.53, 3.78, 8.22);"

-- Insertar análisis (asociados a muestras)
.\mysql.exe -h w29ifufy55ljjmzq.cbetxkdyhwsb.us-east-1.rds.amazonaws.com -u htvv7guq3cc1i2yi -pb79bapb51asa0mme k9ek3c3nz5ipfihw -e "INSERT INTO analisis (muestra_id, resultado, fecha_analisis) VALUES
(1, '0', '2025-06-01'),
(2, '0', '2025-06-02'),
(3, '0', '2025-06-03'),
(4, '0', '2025-06-04'),
(5, '0', '2025-06-05'),
(6, '0', '2025-06-06'),
(7, '0', '2025-06-07'),
(8, '0', '2025-06-08'),
(9, '0', '2025-06-09'),
(10,'0', '2025-06-10');"

.\mysql.exe -h w29ifufy55ljjmzq.cbetxkdyhwsb.us-east-1.rds.amazonaws.com -u htvv7guq3cc1i2yi -pb79bapb51asa0mme k9ek3c3nz5ipfihw -e "SELECT 
    muestras.id,
    muestras.lugar,
    muestras.fecha,
    muestras.nivel_cloro,
    muestras.turbidez,
    muestras.ph,
    usuarios.nombre AS usuario_nombre,
    usuarios.correo AS usuario_correo
FROM muestras
INNER JOIN usuarios ON muestras.usuario_id = usuarios.id;"