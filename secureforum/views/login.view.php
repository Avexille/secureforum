<?php require('partials/head.php') ?>
<?php require('partials/nav.php') ?>

<link rel="stylesheet" href="/views/styles/login.style.css">

<div class="login">
    <h2>Login</h2>
    <form action="login" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br><br>
        <label for="password">Password:</label>
        <input type="password" id="pass" name="pass" required>
        <br><br>
        <button type="submit">Login</button>
    </form>
</div>

<?php require('partials/footer.php') ?>