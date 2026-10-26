<?php
require_once __DIR__ . '/Config/Koneksi.php';
require_once __DIR__ . '/Includes/Auth_check.php';

$id = filter_var($_GET['id'] ?? $_POST['id'] ?? null, FILTER_VALIDATE_INT);

if ($id) {
    $stmt = $pdo->prepare("DELETE FROM games WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: index.php?msg=deleted");
    exit;
}

header("Location: index.php");
exit;
