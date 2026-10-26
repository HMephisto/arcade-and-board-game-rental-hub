<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Preserve current language preference even after logging out
$lang = $_SESSION['lang'] ?? 'id';

// Unset all session variables
$_SESSION = [];

// Destroy session cookie if present
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Destroy session storage
session_destroy();

// Start clean session just to persist language selection
session_start();
$_SESSION['lang'] = $lang;

header("Location: login.php?msg=logged_out");
exit;
