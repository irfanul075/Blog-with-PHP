<?php
require_once('db_connect.php');

// Create database

$sql1 = "CREATE TABLE users (
id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(30) NOT NULL,
email VARCHAR(50) NOT NULL UNIQUE,
image varchar(50) NULL, 
password VARCHAR(255) NOT NULL,
activation_code VARCHAR(100) NULL,
active TINYINT(3) DEFAULT 0,
user_type TINYINT(3) DEFAULT 0, /*1->admin*/
created_at TIMESTAMP
)";



$sql2 = "CREATE TABLE posts(
id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(50) NOT NULL,
body MEDIUMTEXT NOT NULL,
categories VARCHAR(50) NULL,
feature_image VARCHAR(50) NULL,
status TINYINT(3) DEFAULT 0, /*0->published 1->draft */
created_at TIMESTAMP, 
user_id INT UNSIGNED NOT NULL,
FOREIGN KEY (user_id) REFERENCES users(id)
)";



$sql3 ="CREATE TABLE password_resets(
email VARCHAR(50) NULL,
reset_token VARCHAR(50) NULL,
created_at TIMESTAMP 
)";



$sql4 = "CREATE TABLE comments (
id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
body VARCHAR(100) NOT NULL,
user_id INT(10) NOT NULL,
post_id INT(10) NOT NULL,
created_at TIMESTAMP
)";



$sql5 = "CREATE TABLE categories (
id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(30) NOT NULL,
slug VARCHAR(50) NOT NULL UNIQUE,
created_at TIMESTAMP
)";



if($conn->query($sql1) && $conn->query($sql2) && $conn->query($sql3) && $conn->query($sql4) && $conn->query($sql5)){
    echo "Table created Successfully";
}else{
    echo "Error creating Table". $conn->error;
}

mysqli_close($conn);
