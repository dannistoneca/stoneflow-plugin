<div class="stoneflow-client-panel">
    <h2>📁 Your Service Files</h2>

    <?php if (!empty($files)): ?>
        <ul class="stoneflow-file-list">
            <?php foreach ($files as $file): ?>
                <li>
                    <a href="<?= esc_url($file['url']) ?>" target="_blank"><?= esc_html($file['name']) ?></a>
                    <span class="stoneflow-file-meta">Added: <?= esc_html($file['date']) ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No files have been added for your services yet.</p>
    <?php endif; ?>
</div>
