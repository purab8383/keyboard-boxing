-- Create the database (if it doesn't exist)
CREATE DATABASE IF NOT EXISTS bubble;

-- Use the new database
USE bubble;

-- Create the scoreboard table
CREATE TABLE IF NOT EXISTS scoreboard (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    characters INT NOT NULL,
    seconds INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
