<?php
/**
 * Day 4: Logout Script
 * This script destroys the session and redirects the user to the gateway.
 */

session_start();
session_unset();
session_destroy();

header("Location: login.php");
exit;
