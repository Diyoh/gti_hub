-- GTI-Hub Database Setup Schema
-- Run this in phpMyAdmin or your MySQL CLI

CREATE DATABASE IF NOT EXISTS gti_hub_db;
USE gti_hub_db;

-- Table structure for 'sprints'
CREATE TABLE IF NOT EXISTS sprints (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    category VARCHAR(100),
    estimated_hours INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
