<?php
?>
    </main>

    <footer class="app-footer">
        <div>&copy; <?= date('Y'); ?> <?= htmlspecialchars($t['app_name'] ?? 'Arcade & Board Game Rental Hub'); ?> </div>
    </footer>
    <script>
        // Clean up flash query parameters so refreshing the page does not re-trigger notifications
        if (window.location.search.includes('msg=')) {
            const cleanUrl = new URL(window.location);
            cleanUrl.searchParams.delete('msg');
            const searchStr = cleanUrl.searchParams.toString();
            window.history.replaceState({}, document.title, cleanUrl.pathname + (searchStr ? '?' + searchStr : ''));
        }
    </script>
</body>
</html>
