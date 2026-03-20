# Day 1: Code Explanation & Teaching Guide

This guide provides a detailed, line-by-line breakdown of the code implemented on Day 1.

---

## 1. header.php
This file handles the top section of every page.

```php
<header> <!-- Defines the header section of the page -->
    <div class="logo">GTI-Hub</div> <!-- A container for the site's logo/identity -->
    <nav> <!-- Defines a set of navigation links -->
        <ul> <!-- An unordered list to hold navigation items -->
            <li><a href="nexus.php">Nexus</a></li> <!-- Link to the Dashboard -->
            <li><a href="sprints.php">Sprints</a></li> <!-- Link to the Sprint Intake form -->
            <li><a href="vault.php">Vault</a></li> <!-- Link to the Innovation Vault table -->
        </ul>
    </nav>
</header>
<hr> <!-- A horizontal line to separate the header from the main content -->
```

---

## 2. footer.php
This file handles the bottom section and displays dynamic server information.

```php
<footer> <!-- Defines the footer section of the page -->
    <p>System Status: <span class="online">ONLINE</span></p> <!-- Static status indicator -->
    <p>Server Handshake: <?php echo date("H:i:s"); ?></p> 
    <!-- 
      <?php ... ?>: The PHP tags tell the server to execute code inside.
      echo: This command outputs (prints) text to the browser.
      date("H:i:s"): A PHP function that returns the current time (Hour:Minute:Second).
    -->
</footer>
```

---

## 3. nexus.php
The main dashboard. It uses PHP to manage data and HTML to display it.

### PHP Logic (Top of file)
```php
<?php
// 1. DATA INITIALIZATION (The Server-Side Logic)
$innovatorName = "Arrey Brown"; // A 'String' variable storing a name.
$isLead = true; // A 'Boolean' variable (true/false) used for permission checks.
$innovationScore = 92; // An 'Integer' (whole number) for scoring.
$techStack = [ // An 'Array' - a single container holding multiple values.
    "HTML5 Semantic Markup",
    "CSS3 Layout Engines",
    "Server-Side PHP",
    "Git Version Control"
];

// 2. MODULARITY: Injecting the reusable header
require_once 'db.php'; // Include database connection

// Fetch the total number of sprints from the vault
$stmt = $pdo->query("SELECT COUNT(*) as total FROM sprints");
$vaultStats = $stmt->fetch();
$totalSprints = $vaultStats['total'];

include 'header.php'; // Pulls in the logo and navigation menu
?>
```

### HTML Structure & Dynamic Content
```php
<!DOCTYPE html> <!-- Declares this is an HTML5 document -->
<html lang="en">
<head>
    ... <!-- Meta tags and Title -->
    <link rel="stylesheet" href="style.css"> <!-- Links to our global stylesheet -->
</head>
</head>
<body>
<main>
    <section id="profile-summary">
        <h1>Welcome to the Nexus, <?php echo $innovatorName; ?></h1>
        <!-- Injects the value of $innovatorName into the heading -->
        
        <?php if ($isLead): ?> 
        <!-- An 'if' statement: This block only runs if $isLead is 'true' -->
            <p><span class="badge">Project Lead</span></p>
        <?php endif; ?> <!-- Closes the 'if' statement -->
        
        <p>Innovation Score: <strong><?php echo $innovationScore; ?></strong></p>
        <p>Sprints Launched: <strong><?php echo $totalSprints; ?></strong></p>
    </section>

    <section id="skills-matrix">
        <h2>Technical Baseline</h2>
        <ul>
            <?php foreach ($techStack as $skill): ?>
            <!-- A 'foreach' loop: It iterates (walks) through every item in the $techStack array -->
                <li><?php echo htmlspecialchars($skill); ?></li>
                <!-- 
                  htmlspecialchars(): A security function that converts special characters 
                  (like < or >) into safe HTML entities to prevent script injection.
                -->
            <?php endforeach; ?> <!-- Closes the 'foreach' loop -->
        </ul>
    </section>
</main>

<?php 
// 3. MODULARITY: Injecting the reusable footer
include 'footer.php'; // Pulls in the footer code
?>
</body>
</html>
```

---

## Important Concepts Covered

- **The PHP Delimiter (`<?php ... ?>`)**: Tells the server where PHP starts and ends.
- **Variables (`$name`)**: Must start with a dollar sign. They store data for later use.
- **Includes (`include 'file.php'`)**: Allows you to reuse code, making maintenance easier.
- **Foreach Loops**: The most efficient way to display lists of data from a collection (array).
- **Sanitization (`htmlspecialchars`)**: A critical security practice to keep your web app safe from attackers.
