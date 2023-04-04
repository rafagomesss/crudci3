CREATE DATABASE cadastro COLLATE utf8mb4_0900_ai_ci;
USE cadastro;

# DROP TABLE IF EXISTS level_access;
CREATE TABLE IF NOT EXISTS level_access(
	id INT UNSIGNED AUTO_INCREMENT NOT NULL,
    level ENUM('Administrator', 'Collaborator', 'User'),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME,
    PRIMARY KEY(id)
);
# INSERT INTO level_access (level) VALUES ('Administrator'), ('Collaborator'), ('User');
# TRUNCATE TABLE level_access;
SELECT * FROM level_access;

# DROP TABLE IF EXISTS users;
CREATE TABLE IF NOT EXISTS users(
	id INT UNSIGNED AUTO_INCREMENT NOT NULL,
    name VARCHAR(200) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    level_access_id INT UNSIGNED DEFAULT 3,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME,
	CONSTRAINT fk_user_level_access FOREIGN KEY (level_access_id)
	REFERENCES level_access (id)
    ON DELETE NO ACTION,
    PRIMARY KEY(id)
);
# TRUNCATE TABLE users;
SELECT * FROM users;

# DROP TABLE IF EXISTS collaborators;
CREATE TABLE IF NOT EXISTS collaborators(
	id INT UNSIGNED AUTO_INCREMENT NOT NULL,
    first_name VARCHAR(200) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    cellphone VARCHAR(17) NOT NULL,
    cpf VARCHAR(14),
    zip_code VARCHAR(9),
    address VARCHAR(255),
    address_number VARCHAR(50),
    address_complement VARCHAR(100),
    neighborhood VARCHAR(200),
    city VARCHAR(200),
    position VARCHAR(200),
    sector VARCHAR(200),
    status ENUM('Ativo', 'Inativo') DEFAULT 'Ativo' NOT NULL,
    is_deleted BOOLEAN DEFAULT false,
    user_id INT UNSIGNED,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME,
    deleted_at DATETIME DEFAULT NULL,
    CONSTRAINT fk_collaborators_user FOREIGN KEY (user_id)
	REFERENCES users (id)
    ON DELETE NO ACTION,
    PRIMARY KEY(id)
);
# TRUNCATE TABLE collaborators;
SELECT * FROM collaborators;

# DROP TABLE IF EXISTS product_categories;
CREATE TABLE IF NOT EXISTS product_categories(
	id INT UNSIGNED AUTO_INCREMENT NOT NULL,
    name VARCHAR(200) NOT NULL,
	created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME,
    PRIMARY KEY (id)
);
# TRUNCATE TABLE product_categories;
SELECT * FROM product_categories;

# DROP TABLE IF EXISTS products;
CREATE TABLE IF NOT EXISTS products(
	id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10,2),
    category_id INT UNSIGNED DEFAULT NULL,
	created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME,
    CONSTRAINT fk_product_category FOREIGN KEY (category_id)
	REFERENCES product_categories (id)
    ON DELETE NO ACTION,
    PRIMARY KEY(id)
);
# TRUNCATE TABLE products;
SELECT * FROM products;





