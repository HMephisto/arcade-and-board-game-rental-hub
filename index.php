<?php
require_once __DIR__ . '/Config/Koneksi.php';
require_once __DIR__ . '/Includes/Auth_check.php';
require_once __DIR__ . '/Includes/Lang_init.php';

// Flash notification message
$flash_msg = '';
if (isset($_GET['msg'])) {
    if ($_GET['msg'] === 'created') {
        $flash_msg = $t['msg_created'];
    } elseif ($_GET['msg'] === 'updated') {
        $flash_msg = $t['msg_updated'];
    } elseif ($_GET['msg'] === 'deleted') {
        $flash_msg = $t['msg_deleted'];
    }
}

// Optional filter / search query
$search = trim($_GET['q'] ?? '');
$filter_cat = trim($_GET['category'] ?? '');

$sql = "SELECT * FROM games WHERE 1=1";
$params = [];

if ($search !== '') {
    $sql .= " AND title LIKE ?";
    $params[] = '%' . $search . '%';
}

if ($filter_cat !== '' && in_array($filter_cat, ['Board Game', 'Arcade Cabinet', 'Console'], true)) {
    $sql .= " AND category = ?";
    $params[] = $filter_cat;
}

$sql .= " ORDER BY id DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$games = $stmt->fetchAll();

// Mapping lookups for localization & CSS pills
$catLabels = [
    'Board Game'     => $t['cat_board_game'],
    'Arcade Cabinet' => $t['cat_arcade'],
    'Console'        => $t['cat_console'],
];

$catClasses = [
    'Board Game'     => 'pill-board',
    'Arcade Cabinet' => 'pill-arcade',
    'Console'        => 'pill-console',
];

$condLabels = [
    'Mint'         => $t['cond_mint'],
    'Good'         => $t['cond_good'],
    'Fair'         => $t['cond_fair'],
    'Needs Repair' => $t['cond_repair'],
];

$statusLabels = [
    'Available'   => $t['status_available'],
    'Rented'      => $t['status_rented'],
    'Maintenance' => $t['status_maintenance'],
];

$statusClasses = [
    'Available'   => 'pill-available',
    'Rented'      => 'pill-rented',
    'Maintenance' => 'pill-maintenance',
];

$page_title = $t['dashboard_title'];
require_once __DIR__ . '/Includes/Header.php';
?>

<?php if (!empty($flash_msg)): ?>
    <div class="arcade-alert alert-success">
        <div class="alert-content"><?= htmlspecialchars($flash_msg); ?></div>
        <button type="button" class="btn-alert-close" onclick="this.closest('.arcade-alert').remove();" aria-label="Close">&times;</button>
    </div>
<?php endif; ?>

<div class="page-head">
    <div>
        <h1 class="page-title"><?= htmlspecialchars($t['dashboard_title']); ?></h1>
        <p style="color: var(--text-muted); font-size: 0.88rem; margin-top: 0.25rem;">
            <?= count($games); ?> unit(s) registered
        </p>
    </div>
    <div>
        <a href="create.php" class="btn-primary">
            <?= htmlspecialchars($t['btn_add_new']); ?>
        </a>
    </div>
</div>

<div class="table-container">
    <?php if (empty($games)): ?>
        <div class="empty-state">
            <p><?= htmlspecialchars($t['no_data']); ?></p>
        </div>
    <?php else: ?>
        <table class="arcade-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th><?= htmlspecialchars($t['col_title']); ?></th>
                    <th><?= htmlspecialchars($t['col_category']); ?></th>
                    <th><?= htmlspecialchars($t['col_players']); ?></th>
                    <th><?= htmlspecialchars($t['col_rate']); ?></th>
                    <th><?= htmlspecialchars($t['col_condition']); ?></th>
                    <th><?= htmlspecialchars($t['col_status']); ?></th>
                    <th style="text-align: right;"><?= htmlspecialchars($t['col_actions']); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($games as $idx => $game): ?>
                    <tr>
                        <td style="color: var(--text-dim);"><?= $idx + 1; ?></td>
                        <td>
                            <strong><?= htmlspecialchars($game['title']); ?></strong>
                        </td>
                        <td>
                            <span class="pill <?= $catClasses[$game['category']] ?? ''; ?>">
                                <?= htmlspecialchars($catLabels[$game['category']] ?? $game['category']); ?>
                            </span>
                        </td>
                        <td>
                            <?= htmlspecialchars($game['min_players']); ?> - <?= htmlspecialchars($game['max_players']); ?>
                        </td>
                        <td>
                            Rp <?= number_format($game['hourly_rate'], 0, ',', '.'); ?>
                        </td>
                        <td>
                            <span style="font-size: 0.85rem; color: var(--text-muted);">
                                <?= htmlspecialchars($condLabels[$game['condition_rating']] ?? $game['condition_rating']); ?>
                            </span>
                        </td>
                        <td>
                            <span class="pill <?= $statusClasses[$game['status']] ?? ''; ?>">
                                <?= htmlspecialchars($statusLabels[$game['status']] ?? $game['status']); ?>
                            </span>
                        </td>
                        <td>
                            <div class="action-group" style="justify-content: flex-end;">
                                <a href="edit.php?id=<?= urlencode($game['id']); ?>" class="btn-action btn-action-edit">
                                    <?= htmlspecialchars($t['btn_edit']); ?>
                                </a>
                                <a href="delete.php?id=<?= urlencode($game['id']); ?>" 
                                   class="btn-action btn-action-delete"
                                   onclick="return confirm('<?= htmlspecialchars(addslashes($t['confirm_delete'])); ?>');">
                                    <?= htmlspecialchars($t['btn_delete']); ?>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php
require_once __DIR__ . '/Includes/Footer.php';
?>
