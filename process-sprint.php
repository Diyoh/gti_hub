<?php
/**
 * Day 3: Persistence Layer Upgraded
 * This script now saves data into the Innovation Vault (MySQL).
 */

require_once 'db.php'; // Load the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 1. DATA CATCHING
    $title = $_POST['sprint_title'] ?? '';
    $category = $_POST['category'] ?? '';
    $hours = $_POST['hours'] ?? 0;

    // 2. DATA SANITIZATION for UI
    $safe_title = htmlspecialchars($title);

    // 3. PERSISTENCE: INSERT into Vault
    // We use PREPARED STATEMENTS (?) for maximum security
    // This separates the SQL command from the user data
    $sql = "INSERT INTO sprints (title, category, estimated_hours) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    
    // Execute the "atomic" change
    if ($stmt->execute([$title, $category, $hours])) {
        // Professional success code
        http_response_code(201);
        
        include 'header.php';
        echo "<main style='max-width: 800px; margin: 20px auto; font-family: sans-serif; text-align: center; padding: 40px;'>";
        echo "<h1>✅ Sprint Successfully Archived!</h1>";
        echo "<p>Project <strong>$safe_title</strong> is now permanently stored in the Innovation Vault.</p>";
        echo "<div style='margin-top: 30px;'>";
        echo "<a href='vault.php' style='background: #687291; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px;'>View Vault</a> ";
        echo "<a href='sprints.php' style='margin-left: 10px; color: #687291;'>Launch another</a>";
        echo "</div>";
        echo "</main>";
        include 'footer.php';
    } else {
        echo "Failed to archive sprint.";
    }

} else {
    header("Location: sprints.php");
    exit;
}
?>
