<?php $flash = $flash ?? null; ?>

<?php if (!empty($flash)): ?>
    <div class="alert alert-info">
        <?= htmlspecialchars($flash) ?>
    </div>
<?php endif; ?>
