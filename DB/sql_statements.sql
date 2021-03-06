DROP DATABASE IF EXISTS hkspaceblog;

CREATE DATABASE hkspaceblog;

USE hkspaceblog;

CREATE TABLE usertype (
    ID INT NOT NULL AUTO_INCREMENT,
    type VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY(ID)
);

CREATE TABLE users(
    ID INT NOT NULL AUTO_INCREMENT,
    firstname VARCHAR(255) NOT NULL,
    middlename VARCHAR(255),
    lastname VARCHAR(255) NOT NULL,
    birthdate DATE NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    username VARCHAR(255) UNIQUE NOT NULL,
    profile_photo TEXT,
    password VARCHAR(255) NOT NULL,
    type_id INT NOT NULL,
    FOREIGN KEY(type_id) REFERENCES usertype(ID),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY(ID)
);

CREATE TABLE posts (
    ID INT NOT NULL AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    summary TEXT NOT NULL,
    content TEXT NOT NULL,
    author_id INT NOT NULL,
    FOREIGN KEY(author_id) REFERENCES users(ID),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY(ID)
);

CREATE TABLE comments(
    ID INT NOT NULL AUTO_INCREMENT,
    comment TEXT,
    post_id INT NOT NULL,
    user_id INT NOT NULL,
    FOREIGN KEY(post_id) REFERENCES posts(ID),
    FOREIGN KEY(user_id) REFERENCES users(ID),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY(ID)
);

INSERT INTO usertype(ID, type)
VALUES(NULL, 'admin'),
      (NULL, 'user')

