<?php require('partials/head.php') ?>
<?php require('partials/nav.php') ?>

<title>SecureForum</title>
<link rel="stylesheet" href="/views/styles/index.style.css">

<div class="threads-container">
    <h2>Existing Threads</h2>
    <?php if (count($threads) > 0): ?>
        <?php foreach ($threads as $thread): ?>
            <div class="thread">
                <div class="thread-title">
                    <a href="thread?thread_id=<?= htmlspecialchars($thread['thread_id']) ?>">
                        <?= htmlspecialchars($thread['title']) ?>
                    </a>
                </div>
                <div class="thread-content"><?= htmlspecialchars($thread['content']) ?></div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No threads available.</p>
    <?php endif; ?>
</div>

<?php require('partials/footer.php') ?>