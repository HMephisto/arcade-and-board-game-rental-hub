<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$allowed_langs = ['id', 'en'];

if (isset($_GET['lang']) && in_array($_GET['lang'], $allowed_langs, true)) {
    $_SESSION['lang'] = $_GET['lang'];
}

$current_lang = $_SESSION['lang'] ?? 'id';

$lang_file = __DIR__ . '/../lang/' . $current_lang . '.php';
if (!file_exists($lang_file)) {
    $lang_file = __DIR__ . '/../lang/id.php';
    $current_lang = 'id';
}

$t = require $lang_file;
