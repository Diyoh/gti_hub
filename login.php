<?php
/**
 * Day 4: The Gateway (Authentication Layer)
 * This script handles user login and session initialization.
 */


session_start();
require_once 'db.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!empty($username) && !empty($password)) {
        // Prepare statement to prevent SQL Injection
        $stmt = $pdo->prepare("SELECT id, name, password, tech_stack FROM innovators WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && $password === $user['password']) {
            // Success! Initialize session
            $_SESSION['innovator_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['tech_stack'] = $user['tech_stack'];
            
            header("Location: nexus.php");
            exit;
        } else {
            $error = "Access Denied: Invalid Credentials";
        }
    } else {
        $error = "Please fill in all fields.";
    }
}

$pageTitle = "The Gateway";
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
<main style="max-width: 400px; margin: 50px auto;">
    <h1>The Gateway</h1>
    <p>Identity verification required to access the Innovation Vault.</p>

    <?php if ($error): ?>
        <p style="color: red; background: #fee; padding: 10px; border-radius: 4px;"><?php echo $error; ?></p>
    <?php endif; ?>

    <form action="login.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>
        
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
        
        <button type="submit">Unlock Access</button>
    </form>
    
    <p style="text-align: center; margin-top: 20px;">
        New innovator? <a href="signup.php">Create an account</a>
    </p>
</main>

<?php include 'footer.php'; ?>
</body>
</html>
