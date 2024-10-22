CREATE DATABASE Biblioteca;

USE Biblioteca;


CREATE TABLE Personal (
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

CREATE TABLE Usuario (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(255) NOT NULL,
    genero VARCHAR(50),
    edad INT,
    telefono VARCHAR(20),
    correo VARCHAR(255),
    contraseña VARCHAR(255)
);


CREATE TABLE Salas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    unidades INT
);

CREATE TABLE Libros (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(255) NOT NULL,
    autor VARCHAR(255),
    genero VARCHAR(100),
    isbn VARCHAR(20) UNIQUE,
    ranking DECIMAL(3,2), 
    unidades INT
);

CREATE TABLE Material (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(255) NOT NULL,
    tipo VARCHAR(255) NOT NULL,
    unidades INT
);

CREATE TABLE Rentas_Libros (
    id INT PRIMARY KEY AUTO_INCREMENT,
    persona VARCHAR(255) NOT NULL,
    no_membresia INT,
    id_libro INT,
    fecha_salida DATE,
    fecha_regreso DATE,
    FOREIGN KEY (no_membresia) REFERENCES Membresias(no_membresia),
    FOREIGN KEY (id_libro) REFERENCES Libros(id)
);

CREATE TABLE Rentas_Material (
    id INT PRIMARY KEY AUTO_INCREMENT,
    persona VARCHAR(255) NOT NULL,
    no_membresia INT,
    id_material INT,
    fecha_salida DATE,
    fecha_regreso DATE,
    FOREIGN KEY (no_membresia) REFERENCES Membresias(no_membresia),
    FOREIGN KEY (id_material) REFERENCES Material(id)
);

CREATE TABLE Rentas_Salas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    persona VARCHAR(255) NOT NULL,
    no_membresia INT,
    id_sala INT,
    fecha_reserva DATE,
    hora_inicio TIME,
    hora_fin TIME,
    FOREIGN KEY (no_membresia) REFERENCES Membresias(no_membresia),
    FOREIGN KEY (id_sala) REFERENCES Salas(id)
);

CREATE TABLE Membresias (
    no_membresia INT PRIMARY KEY AUTO_INCREMENT,
    id_persona INT,
    nivel_membresia VARCHAR(50),
    penalizaciones INT,
    telefono VARCHAR(20),
    FOREIGN KEY (id_persona) REFERENCES Usuario(id)
);
