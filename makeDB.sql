CREATE DATABASE IF NOT EXISTS myproject;

USE myproject;

CREATE TABLE IF NOT EXISTS user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(20), NOT NULL
    avatar VARCHAR(255),
    type VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS post (
    id INT AUTO_INCREMENT PRIMARY KEY,
    uploader INT,
    content TEXT,
    post_time DATETIME
);

CREATE TABLE IF NOT EXISTS upload (
    id INT AUTO_INCREMENT PRIMARY KEY,
    uploader VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    size INT,
    type VARCHAR(225),
    upload_time DATETIME
);
