# Day 3: Code Explanation & Teaching Guide

This guide provides a comprehensive breakdown of the "Persistence Layer" - how we store data in a MySQL database.

---

## 1. Database Setup (MySQL)
The foundational structure for storing our data.

```sql
CREATE DATABASE gti_hub_db; -- Creates the database container
USE gti_hub_db; -- Tells MySQL to use this database for subsequent commands

CREATE TABLE sprints ( -- Defines a new table named 'sprints'
    id INT AUTO_INCREMENT PRIMARY KEY, -- A unique ID for every row; 'AUTO_INCREMENT' means it counts up automatically
    title VARCHAR(255) NOT NULL, -- The project name; 'VARCHAR' means text, '255' is the max length
    category VARCHAR(100), -- The tech sector (AI, Web, IoT)
    estimated_hours INT, -- A simple number for time tracking
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- Records the exact second the project was launched
);
```

---

## 2. db.php (The Connection)
The "Handshake" that connects our PHP code to the MySQL server.

```php
<?php
$host = 'localhost'; // Usually 'localhost' when running on XAMPP
$db = 'gti_hub_db'; // Must match the name we used in SQL
$user = 'root'; // Default XAMPP username
$pass = ''; // Default XAMPP password is empty

// DSN: Data Source Name. It is the precise "address" of your database.
$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

// Configuration options for professional error handling
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Scream (throw an error) if the connection fails
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Fetch data as an easy-to-read associative array
];

try {
    // Attempting to establish the connection via PDO (PHP Data Objects)
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    // If the 'try' fails, the 'catch' captures the error and stops the script safely.
    die("Vault Connection Failed: " . $e->getMessage());
}
?>
```

---

## 3. vault.php (The Reader)
How we fetch data from the "Vault" and display it on the screen.

```php
<?php
include 'db.php'; // Injects the $pdo connection object into this page.

// Sending a request to the database to find all records
$stmt = $pdo->query("SELECT * FROM sprints ORDER BY created_at DESC");
// DESC: Short for 'Descending'. Shows the newest projects at the top.

$sprints = $stmt->fetchAll(); // Grabs every matching row and saves it to the $sprints array.
?>

<head>
    <link rel="stylesheet" href="style.css"> <!-- Standardizes the table design -->
</head>

...

<table>
  <?php foreach ($sprints as $s): ?> 
  <!-- Loops through every project found in the database -->
    <tr>
        <td><?php echo $s['id']; ?></td> <!-- Displays the unique ID -->
        <td><?php echo htmlspecialchars($s['title']); ?></td> <!-- Sanitizes the title for safety -->
        <td><?php echo $s['category']; ?></td>
        <td><?php echo $s['created_at']; ?></td>
    </tr>
  <?php endforeach; ?>
</table>
```

---

## 4. process-sprint.php (The Writer)
Using **Prepared Statements** to save data securely.

```php
<?php
require_once 'db.php'; // Pulls in the connection

// SQL Template with 'placeholders' (?)
// We don't put user data directly in the command to prevent SQL Injection attacks.
$sql = "INSERT INTO sprints (title, category, estimated_hours) VALUES (?, ?, ?)";

$stmt = $pdo->prepare($sql);
// prepare(): Sends the command structure to the server first.

// execute(): Fills the ? with the real data and safely runs the command.
if ($stmt->execute([$title, $category, $hours])) {
    http_response_code(201); // Standard code for successful creation
    ...
}
?>
```

---

## Key Terms for Students

- **PDO (PHP Data Objects)**: The modern, secure standard for database interaction in PHP.
- **SQL Injection**: A dangerous attack where users try to hijack your database.
- **Prepared Statements**: The primary defense against SQL Injection.
- **Persistence**: Ensuring data survives long after the script finishes or the computer restarts.
