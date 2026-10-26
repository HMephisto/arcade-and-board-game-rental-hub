<?php
require_once __DIR__ . '/Config/Koneksi.php';
require_once __DIR__ . '/Includes/Lang_init.php';

// If already logged in, skip login page
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        $error_message = $t['err_login_failed'];
    } else {
        $stmt = $pdo->prepare("SELECT id, username, password, full_name FROM users WHERE username = ? LIMIT 1");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            // Prevent session fixation
            session_regenerate_id(true);

            $_SESSION['user_id']   = $user['id'];
            $_SESSION['username']  = $user['username'];
            $_SESSION['full_name'] = $user['full_name'];

            header("Location: index.php");
            exit;
        } else {
            $error_message = $t['err_login_failed'];
        }
    }
}
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars($current_lang); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($t['login_title']); ?> | <?= htmlspecialchars($t['app_name']); ?></title>
    <link rel="stylesheet" href="Assets/css/style.css?v=<?= filemtime(__DIR__ . '/Assets/css/style.css'); ?>">
</head>
<body>
    <div class="auth-wrapper">
        <div class="arcade-card">
            <!-- Language Selector -->
            <div class="lang-selector">
                <a href="?lang=id" class="lang-btn <?= $current_lang === 'id' ? 'active' : ''; ?>">ID</a>
                <a href="?lang=en" class="lang-btn <?= $current_lang === 'en' ? 'active' : ''; ?>">EN</a>
            </div>

            <!-- Header -->
            <div class="brand-header">
                <h1 class="brand-title">Arcade &amp; Board Game</h1>
            </div>

            <!-- Alerts -->
            <?php if (!empty($error_message)): ?>
                <div class="arcade-alert alert-danger">
                    <div class="alert-content"><?= htmlspecialchars($error_message); ?></div>
                    <button type="button" class="btn-alert-close" onclick="this.closest('.arcade-alert').remove();" aria-label="Close">&times;</button>
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['msg']) && $_GET['msg'] === 'logged_out'): ?>
                <div class="arcade-alert alert-success">
                    <div class="alert-content"><?= htmlspecialchars($t['msg_logged_out']); ?></div>
                    <button type="button" class="btn-alert-close" onclick="this.closest('.arcade-alert').remove();" aria-label="Close">&times;</button>
                </div>
            <?php endif; ?>

            <!-- Login Form -->
            <form method="POST" action="login.php">
                <div class="form-group">
                    <label class="form-label" for="username"><?= htmlspecialchars($t['username']); ?></label>
                    <input type="text" id="username" name="username" class="form-input" required autocomplete="username" placeholder="e.g. admin" value="<?= htmlspecialchars($_POST['username'] ?? ''); ?>">
                </div>

                <div class="form-group">
                    <label class="form-label" for="password"><?= htmlspecialchars($t['password']); ?></label>
                    <input type="password" id="password" name="password" class="form-input" required autocomplete="current-password" placeholder="••••••••">
                </div>

                <button type="submit" class="btn-primary btn-full">
                    <?= htmlspecialchars($t['btn_login']); ?>
                </button>
            </form>

            <div class="demo-credentials">
                Demo Access &bull; Username: <code>admin</code> | Password: <code>password123</code>
            </div>
        </div>
    </div>
    <script>
        // Clean URL query params so notifications do not linger on refresh
        if (window.location.search.includes('msg=')) {
            const cleanUrl = new URL(window.location);
            cleanUrl.searchParams.delete('msg');
            window.history.replaceState({}, document.title, cleanUrl.pathname + (cleanUrl.searchParams.toString() ? '?' + cleanUrl.searchParams.toString() : ''));
        }
    </script>
</body>
</html>