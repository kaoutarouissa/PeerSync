CREATE DATABASE Peersync;
USE Peersync;

CREATE TABLE users(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(255) NOT NULL
);

CREATE TABLE skills(
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL
);

CREATE TABLE users_skills(
    id INT AUTO_INCREMENT PRIMARY KEY,
    status ENUM('maitrisé', 'à travailler') NOT NULL,

    id_skill INT,
    id_user INT,

    FOREIGN KEY (id_skill) REFERENCES skills(id),
    FOREIGN KEY (id_user) REFERENCES users(id)
);

CREATE TABLE help_requests(
    id INT AUTO_INCREMENT PRIMARY KEY,

    title VARCHAR(255) NOT NULL,
    description VARCHAR(255) NOT NULL,

    status ENUM('EN_ATTENTE', 'ASSIGNE', 'RESOLUE') DEFAULT 'EN_ATTENTE',

    technologie VARCHAR(255),

    id_tuteur INT,
    id_student INT,
    id_skill INT,

    FOREIGN KEY (id_tuteur) REFERENCES users(id),
    FOREIGN KEY (id_student) REFERENCES users(id),
    FOREIGN KEY (id_skill) REFERENCES skills(id)
);
ALTER TABLE users
ADD email VARCHAR(20);