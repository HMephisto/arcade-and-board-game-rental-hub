<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// If user session is not found, force redirect to login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
