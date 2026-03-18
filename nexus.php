<?php
// 1. DATA INITIALIZATION (The Server-Side Logic)
$innovatorName = "Arrey Brown";
$isLead = true; // Boolean for role-based logic
$innovationScore = 92;
$techStack = [
    "HTML5 Semantic Markup",
    "CSS3 Layout Engines",
    "Server-Side PHP",
    "Git Version Control"
];

// 2. MODULARITY: Injecting the reusable header
include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GTI-Hub Nexus</title>
    <style>
        body { font-family: sans-serif; line-height: 1.6; max-width: 800px; margin: 20px auto; padding: 20px; }
        .badge { background: #687291; color: white; padding: 2px 8px; border-radius: 4px; font-size: 0.8em; display: inline-block; }
        .online { color: green; font-weight: bold; }
        header nav ul { list-style: none; padding: 0; display: flex; gap: 15px; }
        header .logo { font-size: 1.5rem; font-weight: bold; color: #333; }
        section { margin-bottom: 30px; }
        h1, h2 { color: #2c3e50; }
        footer { margin-top: 50px; border-top: 1px solid #eee; padding-top: 20px; font-size: 0.9em; color: #666; }
    </style>
</head>
<body>
<main>
    <section id="profile-summary">
        <h1>Welcome to the Nexus, <?php echo $innovatorName; ?></h1>
        
        <?php if ($isLead): ?>
            <p><span class="badge">Project Lead</span></p>
        <?php endif; ?>
        
        <p>Innovation Score: <strong><?php echo $innovationScore; ?></strong></p>
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
