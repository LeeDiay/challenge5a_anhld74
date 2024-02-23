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

-- hai tài khoản giáo viên và hai tài khoản sinh viên 
-- tài khoản giáo viên: teacher1 / 123456a@A ; teacher2 / 123456a@A
-- tài khoản sinh viên: student1 / 123456a@A ; student2 / 123456a@A).

-- Tài khoản giáo viên
INSERT INTO user (username, name, password, email, type)
VALUES ('teacher1', 'Teacher 1', '123456a@A', 'teacher1@example.com', 'admin'),
       ('teacher2', 'Teacher 2', '123456a@A', 'teacher2@example.com', 'admin');

-- Tài khoản sinh viên
INSERT INTO user (username, name, password, email, type)
VALUES ('student1', 'Student 1', '123456a@A', 'student1@example.com', 'user'),
       ('student2', 'Student 2', '123456a@A', 'student2@example.com', 'user');
