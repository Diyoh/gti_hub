<?php
// 1. DATA INITIALIZATION (The Server-Side Logic)
$innovatorName = "Eyong Justine";
$isLead = true; // Boolean for role-based logic
$innovationScore = 92;
$techStack = [
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

include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GTI-Hub Nexus</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<main>
    <section id="profile-summary">
        <h1>Welcome to the Nexus, <?php echo $innovatorName; ?></h1>
        
        <?php if ($isLead): ?>
            <p><span class="badge">Project Lead</span></p>
        <?php endif; ?>
        
        <p>Innovation Score: <strong><?php echo $innovationScore; ?></strong></p>
        <p>Sprints Launched: <strong><?php echo $totalSprints; ?></strong></p>
    </section>

    <section id="skills-matrix">
        <h2>Technical Baseline</h2>
        <ul>
            <?php foreach ($techStack as $skill): ?>
                <li><?php echo htmlspecialchars($skill); ?></li>
            <?php endforeach; ?>
        </ul>
    </section>
</main>

<?php 
// 3. MODULARITY: Injecting the reusable footer
include 'footer.php'; 
?>
</body>
</html>
