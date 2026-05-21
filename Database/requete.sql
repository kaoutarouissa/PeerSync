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
UPDATE users
SET password = '$2a$12$mA2gMldsYGq84pxzeXCLxePTEYMVCoFKoqbY9sreJZVd6zidrRiPS'
WHERE email = 'kawtar@gmail.com';
INSERT INTO skills (title) VALUES
('OOP PHP'),
('JavaScript'),
('HTML'),
('CSS'),
('SQL'),
('Laravel'),
('Git'),
('React');
DELETE FROM help_requests
WHERE status = 'EN_ATTENTE';
DELETE FROM help_requests
WHERE status = 'ASSIGNE';
ALTER TABLE help_requests DROP COLUMN status;
ALTER TABLE help_requests
ADD status ENUM('EN_ATTENTE', 'ASSIGNE', 'RESOLUE') DEFAULT 'EN_ATTENTE';
ALTER TABLE help_requests
ADD commentaire TEXT;