CREATE DATABASE myproject;

USE myproject;

CREATE TABLE user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    avatar VARCHAR(255),
    type VARCHAR(50)
);

CREATE TABLE post (
    id INT AUTO_INCREMENT PRIMARY KEY,
    uploader VARCHAR(255) NOT NULL,
    content TEXT,
    post_time DATETIME
);

CREATE TABLE upload (
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
-- mã hóa mật khẩu thành dạng md5
-- Tài khoản giáo viên
INSERT INTO user (username, name, password, email, type)
VALUES ('teacher1', 'Teacher 1', 'f83e69e4170a786e44e3d32a2479cce9', 'teacher1@example.com', 'admin'),
       ('teacher2', 'Teacher 2', 'f83e69e4170a786e44e3d32a2479cce9', 'teacher2@example.com', 'admin');

-- Tài khoản sinh viên
INSERT INTO user (username, name, password, email, type)
VALUES ('student1', 'Student 1', 'f83e69e4170a786e44e3d32a2479cce9', 'student1@example.com', 'user'),
       ('student2', 'Student 2', 'f83e69e4170a786e44e3d32a2479cce9', 'student2@example.com', 'user');