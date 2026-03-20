# Day 2: Code Explanation & Teaching Guide

This guide provides a comprehensive, line-by-line breakdown of the "Interaction Layer" - the forms and processing logic.

---

## 1. sprints.php
The user interface for submitting new projects.

### PHP Initialization & Modularity
```php
<?php
// DATA INITIALIZATION
$pageTitle = "Sprint Intake"; // Sets the text displayed in the browser tab.

// MODULARITY: Injecting the reusable header
include 'header.php'; // Pulls the logo and menu from our central header file.
?>
```

### HTML Head & Styling
```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Standard encoding for all characters -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Mobile responsiveness -->
    <title>GTI-Hub | <?php echo $pageTitle; ?></title> <!-- Dynamic title via PHP -->
    <link rel="stylesheet" href="style.css"> <!-- Links to global design tokens -->
</head>
```

### Main Content & The Form
```html
<body>
<main>
    <h1>Sprint Launchpad</h1>
    <p>Fill in the details below to start a new innovation project.</p>
    
    <!-- 
      action: Specifies where the browser should send the data (to our processor).
      method: 'POST' ensures the data travels in the body of the request, not the URL.
    -->
    <form action="process-sprint.php" method="POST">
        <label for="title">Project Name:</label>
        <input type="text" name="sprint_title" id="title" required>
        <!-- name="sprint_title": The internal key used by PHP to catch this input. -->
        
        <label for="tech">Tech Category:</label>
        <select name="category" id="tech" required>
            <option value="" disabled selected>Select a category</option>
            <option value="AI">Artificial Intelligence</option>
            <option value="Web">Web Systems</option>
            <option value="IoT">Internet of Things</option>
        </select>
        
        <label for="hours">Estimated Hours:</label>
        <input type="number" name="hours" id="hours" min="1" max="100" required>
        <!-- type="number": Restricts input to digits and enables 'min' constraint. -->
        
        <button type="submit">Launch to Vault</button>
    </form>
</main>

<?php include 'footer.php'; ?> <!-- Attaches status and time at the bottom -->
```

---

## 2. process-sprint.php (Interaction & Processing)
The backend handler for the form.

```php
<?php
require_once 'db.php'; // Required for Day 3 connectivity.

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifies that the browser is indeed using POST (sending data)
    
    // 1. DATA CATCHING (Superglobals)
    $title = $_POST['sprint_title'] ?? '';
    $category = $_POST['category'] ?? '';
    $hours = $_POST['hours'] ?? 0;
    // '??': The Null Coalescing Operator. It provides a fallback if the data is missing.

    // 2. DATA SANITIZATION (Security)
    $safe_title = htmlspecialchars($title);
    // htmlspecialchars(): The most critical security step. It turns 
    // code-like characters (like < or >) into safe text to block XSS.

    // 3. PERSISTENCE (Security with Prepared Statements)
    $sql = "INSERT INTO sprints (title, category, estimated_hours) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    // prepare(): Tells the database to "guard" the structure of the command 
    // before the data arrives, preventing SQL Injection.
    
    if ($stmt->execute([$title, $category, $hours])) {
        http_response_code(201); // Standard code for "Resource Created Successfully"
        
        include 'header.php';
        echo "<main>..."; // Provides user-facing feedback with links to the Vault.
        include 'footer.php';
    }
} else {
    // If someone tries to visit process-sprint.php directly (via GET), we boot them out.
    header("Location: sprints.php");
    exit;
}
?>
```

---

## Key Terms for Students

- **The Action Attribute**: The "destination" of your data.
- **The POST Method**: The "transport vehicle" that carries data securely in the request body.
- **HTML Sanitization**: Keeping your database clean and your users safe from hackers.
- **Prepared Statements**: separating "Logic" from "Data" to prevent database manipulation.
- **Null Coalescing (`??`)**: A professional way to handle empty or missing inputs gracefully.
