<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        background-color: #f4f4f4;
    }

    .header {
        margin-top: 20px;
        display: flex;
        align-items: center;
    }

    .button {
        background-color: #007BFF;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin: 0 10px;
        text-decoration: none;
    }

    .button:hover {
        background-color: #0056b3;
    }

    .logo {
        font-size: 24px;
        font-weight: bold;
        margin: 0 20px;
        color: #333;
    }
</style>

<div class="header">
    <a href="login" class="button">Login</a>
    <div class="logo">SecureForum</div>
    <a href="home" class="button">Threads</a>
</div>