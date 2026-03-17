<?php
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
    <style>
        body { font-family: sans-serif; line-height: 1.6; max-width: 800px; margin: 20px auto; padding: 20px; }
        form { display: flex; flex-direction: column; max-width: 400px; gap: 15px; background: #f9f9f9; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        label { font-weight: bold; margin-bottom: -10px; }
        input, select { padding: 10px; border: 1px solid #ddd; border-radius: 4px; }
        button { background: #687291; color: white; padding: 12px; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; }
        button:hover { background: #565e7a; }
        .badge { background: #687291; color: white; padding: 2px 8px; border-radius: 4px; font-size: 0.8em; }
        .online { color: green; font-weight: bold; }
        footer { margin-top: 50px; border-top: 1px solid #eee; padding-top: 20px; font-size: 0.9em; color: #666; }
    </style>
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
