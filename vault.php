<?php
/**
 * Day 3: Vault Viewer
 * This script READS data back from the database and displays it in a table.
 */

// 1. DATA CONNECTION
include 'db.php';

// 2. FETCHING ALL SPRINTS
// We query the database and fetch all records ordered by newest first
$stmt = $pdo->query("SELECT * FROM sprints ORDER BY created_at DESC");
$sprints = $stmt->fetchAll();

// 3. UI INITIALIZATION
$pageTitle = "Innovation Vault";
include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GTI-Hub | <?php echo $pageTitle; ?></title>
    <style>
        body { font-family: sans-serif; line-height: 1.6; max-width: 900px; margin: 20px auto; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; background: white; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #687291; color: white; }
        tr:hover { background-color: #f5f5f5; }
        .badge { background: #687291; color: white; padding: 2px 8px; border-radius: 4px; font-size: 0.8em; }
        .online { color: green; font-weight: bold; }
        footer { margin-top: 50px; border-top: 1px solid #eee; padding-top: 20px; font-size: 0.9em; color: #666; }
    </style>
</head>
<body>
<main>
    <h1>Innovation Vault</h1>
    <p>Viewing all archived innovation sprints from the persistence layer.</p>

    <?php if (empty($sprints)): ?>
        <p><em>No sprints found in the vault yet. <a href="sprints.php">Launch one now!</a></em></p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Sprint Title</th>
                    <th>Category</th>
                    <th>Hours</th>
                    <th>Launched At</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sprints as $s): ?>
                    <tr>
                        <td><?php echo $s['id']; ?></td>
                        <td><?php echo htmlspecialchars($s['title']); ?></td>
                        <td><span class="badge"><?php echo htmlspecialchars($s['category']); ?></span></td>
                        <td><?php echo $s['estimated_hours']; ?> hrs</td>
                        <td><?php echo $s['created_at']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
    
    <p style="margin-top: 20px;"><a href="sprints.php">Launch a new sprint</a></p>
</main>

<?php include 'footer.php'; ?>
</body>
</html>
