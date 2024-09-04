<?php require('partials/head.php') ?>
<?php require('partials/nav.php') ?>

<link rel="stylesheet" href="/views/styles/dashboard.style.css">

<div class="welcome">
    <?php echo "<h2>Welcome, " . htmlspecialchars($_SESSION['username']) . "! 🥳</h2>"; ?>
</div>

<!-- SSRF demo -->
<?php
if (isset($_GET['image_url'])) {
    $image_url = $_GET['image_url'];

    // Directly fetch the image content from the user-provided URL
    $image_content = file_get_contents($image_url);

    if ($image_content !== false) {
        $base64_image = base64_encode($image_content);
        $mime_type = getimagesizefromstring($image_content)['mime'];

        // Display the image in an img tag on the same page
        echo "<div style='text-align: center; margin-top: 20px;'>
                <img src='data:$mime_type;base64,$base64_image' alt='Fetched Image' style='max-width: 100%; height: auto; border: 1px solid #ccc; padding: 10px;'>
              </div>";
    } else {
        echo "<p style='color:red; text-align: center;'>Error: Could not fetch the image.</p>";
    }
} else {
    echo '<form method="GET" style="text-align: center; margin-top: 20px;">
            <label for="image_url">Enter Image URL:</label>
            <input type="text" id="image_url" name="image_url" required style="width: 300px;">
            <input type="submit" value="Fetch Image">
          </form>';
}
?>

<div class="thread-form">
    <h3>Create a new thread</h3>
    <form method="POST">
        <label for="title">Thread title:</label><br>
        <input type="text" id="title" name="title" required><br><br>

        <label for="content">Content of your thread:</label><br>
        <textarea id="content" name="content" rows="5" cols="50" required></textarea><br><br>

        <button type="submit">Submit thread</button>
    </form>
</div>

<div class="logout">
    <form action="logout" method="post" style="display:inline;">
        <button type="submit">Logout</button>
    </form>
</div>


<?php require('partials/footer.php') ?>