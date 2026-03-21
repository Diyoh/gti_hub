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

-- Table structure for 'innovators' (Day 4)
CREATE TABLE IF NOT EXISTS innovators (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    tech_stack TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed data for Day 4
INSERT INTO innovators (name, username, password, tech_stack) VALUES 
('Eyong Justine', 'justine', 'password123', 'PHP, MySQL, HTML, CSS'),
('Arrey Brown', 'arrey', 'secure456', 'Python, Django, React');
