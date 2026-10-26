<?php
if (!isset($t)) {
    require_once __DIR__ . '/Lang_init.php';
}

// Preserve existing query params when toggling language
$queryParamsId = $_GET;
$queryParamsId['lang'] = 'id';
$langUrlId = '?' . http_build_query($queryParamsId);

$queryParamsEn = $_GET;
$queryParamsEn['lang'] = 'en';
$langUrlEn = '?' . http_build_query($queryParamsEn);

$pageTitle = isset($page_title) ? $page_title . ' | ' . $t['app_name'] : $t['app_name'];
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars($current_lang ?? 'id'); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle); ?></title>
    <link rel="stylesheet" href="Assets/css/style.css?v=<?= filemtime(__DIR__ . '/../Assets/css/style.css'); ?>">
</head>
<body>
    <header class="app-header">
        <div class="header-container">
            <a href="index.php" class="logo-area">
                <?= htmlspecialchars($t['app_name']); ?>
            </a>

            <div class="nav-controls">
                <div class="lang-selector" style="margin-bottom: 0;">
                    <a href="<?= htmlspecialchars($langUrlId); ?>" class="lang-btn <?= ($current_lang ?? 'id') === 'id' ? 'active' : ''; ?>">ID</a>
                    <a href="<?= htmlspecialchars($langUrlEn); ?>" class="lang-btn <?= ($current_lang ?? 'id') === 'en' ? 'active' : ''; ?>">EN</a>
                </div>

                <div class="user-badge">
                    <span><?= htmlspecialchars($t['logged_in_as']); ?></span>
                    <strong><?= htmlspecialchars($_SESSION['full_name'] ?? $_SESSION['username'] ?? 'User'); ?></strong>
                </div>

                <a href="logout.php" class="btn-logout"><?= htmlspecialchars($t['nav_logout']); ?></a>
            </div>
        </div>
    </header>

    <main class="main-wrapper">
