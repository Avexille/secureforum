<?php require('partials/head.php') ?>
<?php require('partials/nav.php') ?>

<title><?= $thread['title'] ?> - SecureForum</title>
<link rel="stylesheet" href="/views/styles/thread.style.css">

    <div class="content-container">
        <h2 class="thread_title"><?= $thread['title'] ?></h2>
        <div class="thread_content"><?= $thread['content'] ?></div>

        <div class="comments-section">
            <h3>Comments</h3>
            <?php if (count($comments) > 0): ?>
                <?php foreach ($comments as $comment): ?>
                    <div class="comment">
                        <div class="comment-text"><?= nl2br($comment['content']) ?></div>
                        <div class="comment-date" style="font-size: 12px; color: #555;"><?= ($comment['created_at']) ?></div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No comments yet. Be the first to comment!</p>
            <?php endif; ?>
        </div>

        <div class="comment-form">
            <h3>Add a Comment</h3>
            <?php if (!empty($error_message)): ?>
                <div class="error-message"><?= ($error_message) ?></div>
            <?php endif; ?>
            <form action="thread?id=<?= $thread['thread_id'] ?>" method="post">
                <textarea name="content" placeholder="Your comment" rows="5" required></textarea>
                <input type="hidden" name="id" value="<?php echo $thread['thread_id']; ?>" />
                <button type="submit">Submit Comment</button>
            </form>
        </div>

        <a href="/" class="back-link">Back to Threads</a>
    </div>

    <?php require('partials/footer.php') ?>