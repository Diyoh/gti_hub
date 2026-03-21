<?php
/**
 * Day 4 Expansion: Signup Page
 * This script allows new users to register for the GTI-Hub.
 */

session_start();
require_once 'db.php';

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $tech_stack = $_POST['tech_stack'] ?? '';

    if (!empty($name) && !empty($username) && !empty($password)) {
        // Check if username already exists
        $checkStmt = $pdo->prepare("SELECT id FROM innovators WHERE username = ?");
        $checkStmt->execute([$username]);
        
        if ($checkStmt->fetch()) {
            $error = "Username already taken. Please choose another.";
        } else {
            // Insert new innovator
            $sql = "INSERT INTO innovators (name, username, password, tech_stack) VALUES (?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            
            if ($stmt->execute([$name, $username, $password, $tech_stack])) {
                $success = "Account created successfully! <a href='login.php'>Login here</a>";
            } else {
                $error = "Failed to create account. Please try again.";
            }
        }
    } else {
        $error = "Name, Username, and Password are required.";
    }
}

$pageTitle = "New Innovator Registration";
include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GTI-Hub | <?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<main style="max-width: 500px; margin: 50px auto;">
    <h1>Join the Hub</h1>
    <p>Register your identity to start launching innovation sprints.</p>

    <?php if ($error): ?>
        <p style="color: red; background: #fee; padding: 10px; border-radius: 4px;"><?php echo $error; ?></p>
    <?php endif; ?>

    <?php if ($success): ?>
        <p style="color: green; background: #efe; padding: 10px; border-radius: 4px;"><?php echo $success; ?></p>
    <?php endif; ?>

    <form action="signup.php" method="POST">
        <label for="name">Full Name:</label>
        <input type="text" name="name" id="name" placeholder="e.g. Eyong Justine" required>

        <label for="username">Preferred Username:</label>
        <input type="text" name="username" id="username" placeholder="e.g. justine" required>
        
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>

        <label for="tech">Primary Tech Stack (comma separated):</label>
        <input type="text" name="tech_stack" id="tech" placeholder="e.g. PHP, MySQL, React">
        
        <button type="submit">Complete Registration</button>
    </form>

    <p style="text-align: center; margin-top: 20px;">
        Already an innovator? <a href="login.php">Sign in here</a>
    </p>
</main>

<?php include 'footer.php'; ?>
</body>
</html>
