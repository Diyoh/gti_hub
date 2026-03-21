<header>
    <div class="logo">GTI-Hub</div>
    <nav>
        <ul>
            <li><a href="nexus.php">Nexus</a></li>
            <li><a href="sprints.php">Sprints</a></li>
            <li><a href="vault.php">Vault</a></li>
            <?php if (isset($_SESSION['innovator_id'])): ?>
                <li><a href="logout.php" style="color: #e74c3c;">Logout (<?php echo htmlspecialchars($_SESSION['name']); ?>)</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
<hr>
