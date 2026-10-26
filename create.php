<?php
require_once __DIR__ . '/Config/Koneksi.php';
require_once __DIR__ . '/Includes/Auth_check.php';
require_once __DIR__ . '/Includes/Lang_init.php';

$errors = [];
$values = [
    'title'            => '',
    'category'         => 'Board Game',
    'min_players'      => 1,
    'max_players'      => 4,
    'hourly_rate'      => '',
    'condition_rating' => 'Good',
    'status'           => 'Available',
];

$allowed_categories = ['Board Game', 'Arcade Cabinet', 'Console'];
$allowed_conditions = ['Mint', 'Good', 'Fair', 'Needs Repair'];
$allowed_statuses   = ['Available', 'Rented', 'Maintenance'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Sanitize string inputs
    $title            = trim(htmlspecialchars($_POST['title'] ?? '', ENT_QUOTES, 'UTF-8'));
    $category         = trim($_POST['category'] ?? '');
    $condition_rating = trim($_POST['condition_rating'] ?? '');
    $status           = trim($_POST['status'] ?? '');

    // 2. Validate numeric inputs
    $min_players = filter_var($_POST['min_players'] ?? null, FILTER_VALIDATE_INT);
    $max_players = filter_var($_POST['max_players'] ?? null, FILTER_VALIDATE_INT);
    $hourly_rate = filter_var($_POST['hourly_rate'] ?? null, FILTER_VALIDATE_FLOAT);

    // Keep values for re-rendering form on validation failure
    $values = [
        'title'            => $title,
        'category'         => $category,
        'min_players'      => $_POST['min_players'] ?? '',
        'max_players'      => $_POST['max_players'] ?? '',
        'hourly_rate'      => $_POST['hourly_rate'] ?? '',
        'condition_rating' => $condition_rating,
        'status'           => $status,
    ];

    // 3. Branching business logic validation
    if (empty($title)) {
        $errors[] = $t['err_title_req'];
    }

    if (!in_array($category, $allowed_categories, true)) {
        $errors[] = $t['err_cat_inv'];
    }

    if ($min_players === false || $min_players < 1) {
        $errors[] = $t['err_min_players'];
    }

    if ($max_players === false || $max_players < $min_players) {
        $errors[] = $t['err_max_players'];
    }

    if ($hourly_rate === false || $hourly_rate < 0) {
        $errors[] = $t['err_rate_inv'];
    }

    if (!in_array($condition_rating, $allowed_conditions, true)) {
        $errors[] = $t['err_cond_inv'];
    }

    if (!in_array($status, $allowed_statuses, true)) {
        $errors[] = $t['err_status_inv'];
    }

    // 4. Mutation execution
    if (empty($errors)) {
        $stmt = $pdo->prepare("
            INSERT INTO games (title, category, min_players, max_players, hourly_rate, condition_rating, status)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");

        $stmt->execute([
            $title,
            $category,
            $min_players,
            $max_players,
            $hourly_rate,
            $condition_rating,
            $status,
        ]);

        header("Location: index.php?msg=created");
        exit;
    }
}

$page_title = $t['form_add_title'];
require_once __DIR__ . '/Includes/Header.php';
?>

<div class="page-head">
    <h1 class="page-title"><?= htmlspecialchars($t['form_add_title']); ?></h1>
    <a href="index.php" class="btn-secondary">&larr; <?= htmlspecialchars($t['btn_cancel']); ?></a>
</div>

<?php if (!empty($errors)): ?>
    <div class="arcade-alert alert-danger">
        <div class="alert-content">
            <strong><?= htmlspecialchars($t['err_validation_header']); ?></strong>
            <ul style="margin-top: 0.5rem; margin-left: 1.25rem;">
                <?php foreach ($errors as $err): ?>
                    <li><?= htmlspecialchars($err); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <button type="button" class="btn-alert-close" onclick="this.closest('.arcade-alert').remove();" aria-label="Close">&times;</button>
    </div>
<?php endif; ?>

<div class="content-card">
    <form method="POST" action="create.php">
        <div class="form-group">
            <label class="form-label" for="title"><?= htmlspecialchars($t['lbl_title']); ?> *</label>
            <input type="text" id="title" name="title" class="form-input" required 
                   placeholder="e.g. Catan 3D Edition, Street Fighter 6 Cabinet"
                   value="<?= htmlspecialchars($values['title']); ?>">
        </div>

        <div class="form-grid-2">
            <div class="form-group">
                <label class="form-label" for="category"><?= htmlspecialchars($t['lbl_category']); ?> *</label>
                <select id="category" name="category" class="form-select" required>
                    <option value="Board Game" <?= $values['category'] === 'Board Game' ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($t['cat_board_game']); ?>
                    </option>
                    <option value="Arcade Cabinet" <?= $values['category'] === 'Arcade Cabinet' ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($t['cat_arcade']); ?>
                    </option>
                    <option value="Console" <?= $values['category'] === 'Console' ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($t['cat_console']); ?>
                    </option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label" for="hourly_rate"><?= htmlspecialchars($t['lbl_hourly_rate']); ?> *</label>
                <input type="number" step="500" min="0" id="hourly_rate" name="hourly_rate" class="form-input" required
                       placeholder="e.g. 25000"
                       value="<?= htmlspecialchars($values['hourly_rate']); ?>">
            </div>
        </div>

        <div class="form-grid-2">
            <div class="form-group">
                <label class="form-label" for="min_players"><?= htmlspecialchars($t['lbl_min_players']); ?> *</label>
                <input type="number" min="1" id="min_players" name="min_players" class="form-input" required
                       value="<?= htmlspecialchars($values['min_players']); ?>">
            </div>

            <div class="form-group">
                <label class="form-label" for="max_players"><?= htmlspecialchars($t['lbl_max_players']); ?> *</label>
                <input type="number" min="1" id="max_players" name="max_players" class="form-input" required
                       value="<?= htmlspecialchars($values['max_players']); ?>">
            </div>
        </div>

        <div class="form-grid-2">
            <div class="form-group">
                <label class="form-label" for="condition_rating"><?= htmlspecialchars($t['lbl_condition']); ?> *</label>
                <select id="condition_rating" name="condition_rating" class="form-select" required>
                    <option value="Mint" <?= $values['condition_rating'] === 'Mint' ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($t['cond_mint']); ?>
                    </option>
                    <option value="Good" <?= $values['condition_rating'] === 'Good' ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($t['cond_good']); ?>
                    </option>
                    <option value="Fair" <?= $values['condition_rating'] === 'Fair' ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($t['cond_fair']); ?>
                    </option>
                    <option value="Needs Repair" <?= $values['condition_rating'] === 'Needs Repair' ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($t['cond_repair']); ?>
                    </option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label" for="status"><?= htmlspecialchars($t['lbl_status']); ?> *</label>
                <select id="status" name="status" class="form-select" required>
                    <option value="Available" <?= $values['status'] === 'Available' ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($t['status_available']); ?>
                    </option>
                    <option value="Rented" <?= $values['status'] === 'Rented' ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($t['status_rented']); ?>
                    </option>
                    <option value="Maintenance" <?= $values['status'] === 'Maintenance' ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($t['status_maintenance']); ?>
                    </option>
                </select>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-primary">
                <?= htmlspecialchars($t['btn_save']); ?>
            </button>
            <a href="index.php" class="btn-secondary">
                <?= htmlspecialchars($t['btn_cancel']); ?>
            </a>
        </div>
    </form>
</div>

<?php
require_once __DIR__ . '/Includes/Footer.php';
?>
