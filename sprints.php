<?php
// Day 4 Gatekeeper: Access Control Check
session_start();
if (!isset($_SESSION['innovator_id'])) {
    header("Location: login.php");
    exit;
}
// DATA INITIALIZATION
$pageTitle = "Sprint Intake";

// MODULARITY: Injecting the reusable header
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
<main>
    <h1>Sprint Launchpad</h1>
    <p>Fill in the details below to start a new innovation project.</p>
    
    <!-- 
      action: Where to send the data (process-sprint.php)
      method: POST is used for sending data to be "processed" or "stored" 
    -->
    <form action="process-sprint.php" method="POST">
        <label for="title">Project Name:</label>
        <input type="text" name="sprint_title" id="title" placeholder="Enter sprint title..." required>
        
        <label for="tech">Tech Category:</label>
        <select name="category" id="tech" required>
            <option value="" disabled selected>Select a category</option>
            <option value="AI">Artificial Intelligence</option>
            <option value="Web">Web Systems</option>
            <option value="IoT">Internet of Things</option>
        </select>
        
        <label for="hours">Estimated Hours:</label>
        <input type="number" name="hours" id="hours" min="1" max="100" placeholder="1-100" required>
        
        <button type="submit">Launch to Vault</button>
    </form>
</main>

<?php 
// MODULARITY: Injecting the reusable footer
include 'footer.php'; 
?>
</body>
</html>
