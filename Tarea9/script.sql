-- BASE DE DATOS: Sistema de Reporte de Incidencias
CREATE DATABASE IF NOT EXISTS sistema_incidencias;
USE sistema_incidencias;

-- GEOGRAFIA PRINCIPAL
CREATE TABLE provincias (
    id_provincia INT PRIMARY KEY AUTO_INCREMENT,
    nombre_provincia VARCHAR(100) NOT NULL
);

CREATE TABLE municipios (
    id_municipio INT PRIMARY KEY AUTO_INCREMENT,
    nombre_municipio VARCHAR(100) NOT NULL,
    id_provincia INT NOT NULL,
    FOREIGN KEY (id_provincia) REFERENCES provincias(id_provincia)
);

CREATE TABLE barrios (
    id_barrio INT PRIMARY KEY AUTO_INCREMENT,
    nombre_barrio VARCHAR(100) NOT NULL,
    id_municipio INT NOT NULL,
    FOREIGN KEY (id_municipio) REFERENCES municipios(id_municipio)
);

-- TIPOS DE INCIDENCIAS
CREATE TABLE tipos_incidencias (
    id_tipo INT PRIMARY KEY AUTO_INCREMENT,
    nombre_tipo VARCHAR(50) NOT NULL,
    descripcion VARCHAR(200)
);

-- USUARIOS
CREATE TABLE usuarios (
    id_usuario INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(200) NOT NULL UNIQUE,
    nombre VARCHAR(150) NOT NULL,
    tipo_usuario ENUM('reportero', 'validador') NOT NULL,
    proveedor ENUM('gmail', 'office365', 'local') NOT NULL,
    password VARCHAR(255),
    activo TINYINT(1) DEFAULT 1
);

-- TABLA PRINCIPAL: INCIDENCIAS
CREATE TABLE incidencias (
    id_incidencia INT PRIMARY KEY AUTO_INCREMENT,
    titulo VARCHAR(200) NOT NULL,
    descripcion TEXT NOT NULL,
    fecha_ocurrencia DATETIME NOT NULL,
    id_provincia INT NOT NULL,
    id_municipio INT NOT NULL,
    id_barrio INT,
    latitud DECIMAL(10, 8),
    longitud DECIMAL(11, 8),
    muertos INT DEFAULT 0,
    heridos INT DEFAULT 0,
    perdida_estimada DECIMAL(12, 2) DEFAULT 0,
    link_redes TEXT,
    foto VARCHAR(300),
    id_reportero INT NOT NULL,
    estado ENUM('pendiente', 'aprobado', 'rechazado') DEFAULT 'pendiente',
    id_validador INT,
    fecha_validacion DATETIME,
    
    FOREIGN KEY (id_provincia) REFERENCES provincias(id_provincia),
    FOREIGN KEY (id_municipio) REFERENCES municipios(id_municipio),
    FOREIGN KEY (id_barrio) REFERENCES barrios(id_barrio),
    FOREIGN KEY (id_reportero) REFERENCES usuarios(id_usuario),
    FOREIGN KEY (id_validador) REFERENCES usuarios(id_usuario)
);

-- RELACIÓN MUCHOS A MUCHOS: INCIDENCIAS-TIPOS
CREATE TABLE incidencia_tipo (
    id_incidencia INT NOT NULL,
    id_tipo INT NOT NULL,
    PRIMARY KEY (id_incidencia, id_tipo),
    FOREIGN KEY (id_incidencia) REFERENCES incidencias(id_incidencia),
    FOREIGN KEY (id_tipo) REFERENCES tipos_incidencias(id_tipo)
);

-- COMENTARIOS
CREATE TABLE comentarios (
    id_comentario INT PRIMARY KEY AUTO_INCREMENT,
    id_incidencia INT NOT NULL,
    id_usuario INT NOT NULL,
    comentario TEXT NOT NULL,
    fecha_comentario DATETIME DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (id_incidencia) REFERENCES incidencias(id_incidencia),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);

-- CORRECCIONES SUGERIDAS
CREATE TABLE correcciones (
    id_correccion INT PRIMARY KEY AUTO_INCREMENT,
    id_incidencia INT NOT NULL,
    id_usuario INT NOT NULL,
    muertos_nuevo INT,
    heridos_nuevo INT,
    id_provincia_nueva INT,
    id_municipio_nuevo INT,
    perdida_nueva DECIMAL(12, 2),
    latitud_nueva DECIMAL(10, 8),
    longitud_nueva DECIMAL(11, 8),
    justificacion TEXT NOT NULL,
    estado_correccion ENUM('pendiente', 'aprobada', 'rechazada') DEFAULT 'pendiente',
    fecha_correccion DATETIME DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (id_incidencia) REFERENCES incidencias(id_incidencia),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);

-- DATOS INICIALES
INSERT INTO tipos_incidencias (nombre_tipo, descripcion) VALUES
('accidente', 'Accidentes de tránsito'),
('pelea', 'Peleas y altercados'),
('robo', 'Robos y asaltos'),
('desastre', 'Desastres naturales');

INSERT INTO provincias (nombre_provincia) VALUES
('Distrito Nacional'),
('Santo Domingo'),
('Santiago'),
('La Altagracia'),
('Puerto Plata'),
('San Cristóbal');

INSERT INTO municipios (nombre_municipio, id_provincia) VALUES
('Distrito Nacional', 1),
('Santo Domingo Este', 2),
('Santo Domingo Norte', 2),
('Santiago', 3),
('Punta Cana', 4),
('Puerto Plata', 5),
('San Cristóbal', 6);

INSERT INTO barrios (nombre_barrio, id_municipio) VALUES
('Zona Colonial', 1),
('Naco', 1),
('Los Alcarrizos', 2),
('Villa Mella', 3),
('Centro Santiago', 4),
('Bávaro', 5);

INSERT INTO usuarios (email, nombre, tipo_usuario, proveedor, password) VALUES
('admin@sistema.com', 'Administrador', 'validador', 'local', 'admin123');