CREATE DATABASE todo_app;
USE todo_app;

CREATE TABLE users(
id        int(255) AUTO_INCREMENT NOT NULL,
email     varchar(100) UNIQUE NOT NULL,
nickname  varchar(100) NOT NULL,
password  varchar(255) NOT NULL,
CONSTRAINT pk_users PRIMARY KEY(id),
CONSTRAINT uq_users UNIQUE(email)
)ENGINE=InnoDb;

INSERT INTO users VALUES (NULL, 'webmaster@webmaster.com', 'webmaster', 'webmaster123');

CREATE TABLE todos(
id         int(255) AUTO_INCREMENT NOT NULL,
user_id    int(255) NOT NULL,
content    varchar(255) NOT NULL,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
CONSTRAINT pk_todos PRIMARY KEY(id),
CONSTRAINT fk_todos_users FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE
)ENGINE=InnoDb;