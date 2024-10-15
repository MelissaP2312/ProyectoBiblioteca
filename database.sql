CREATE DATABASE IF NOT EXISTS Biblioteca;

USE Biblioteca;

CREATE TABLE IF NOT EXISTS Salas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    unidades INT
);

CREATE TABLE IF NOT EXISTS Libros (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(255) NOT NULL,
    autor VARCHAR(255),
    genero VARCHAR(100),
    isbn VARCHAR(20) UNIQUE,
    ranking DECIMAL(3,2), 
    unidades INT
);

CREATE TABLE IF NOT EXISTS Material (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(255) NOT NULL,
    tipo VARCHAR(255) NOT NULL,
    unidades INT
);

CREATE TABLE IF NOT EXISTS Rentas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    persona VARCHAR(255) NOT NULL,
    no_membresia INT,
    id_libro INT,
    fecha_salida DATE,
    fecha_regreso DATE,
    FOREIGN KEY (no_membresia) REFERENCES Membresias(no_membresia),
    FOREIGN KEY (id_libro) REFERENCES Libros(id)
);

CREATE TABLE IF NOT EXISTS Membresias (
    no_membresia INT PRIMARY KEY AUTO_INCREMENT,
    id_persona INT,
    nivel_membresia VARCHAR(50),
    penalizaciones INT,
    telefono VARCHAR(20),
    FOREIGN KEY (id_persona) REFERENCES Usuario(id)
);

CREATE TABLE IF NOT EXISTS Personal (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(255) NOT NULL,
    edad INT,
    genero VARCHAR(50),
    direccion VARCHAR(255),
    telefono VARCHAR(20),
    posicion VARCHAR(255),
    correo VARCHAR(255),
    contraseña VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS Usuario (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(255) NOT NULL,
    genero VARCHAR(50),
    edad INT,
    telefono VARCHAR(20),
    direccion VARCHAR(255),
    correo VARCHAR(255),
    contraseña VARCHAR(255),
    apellidos VARCHAR(255)
);
