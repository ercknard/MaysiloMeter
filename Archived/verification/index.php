<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
    session_start();
    require_once('./partials/head.php'); 
    ?>
    <title>Sign Up</title>
    <link rel="stylesheet" href="/style.css">
</head>
<body class="bg-light">
    <?php if(isset($_SESSION["alert-type"])) : ?>
        <div class="container mt-5">
            <div class="alert alert-<?= $_SESSION["alert-type"]; ?>" role="alert">
                <?= $_SESSION["alert-message"]; ?>
            </div>
        </div>
    <?php endif ?>
    <h1 class='mt-5 text-center'>Sign Up</h1>
    <div class="row justify-content-center align-items-center mt-5">
        <form action="./controllers/checkexists.php" method="POST">
            <div class="form-group">
                <label role="button" for="username">Username: </label>
                <input id="username" name="username" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label role="button" for="password">Password: </label>
                <input id="password" name="password" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label role="button" for="contact">Contact #: </label>
                <input id="contact" name="contact" type="number" class="form-control">
            </div>
            <div class="form-group">
                <input class="btn btn-primary btn-block" type="submit" value="Sign Up">
            </div>
        </form>
    </div>
</body>
<?php require_once('./partials/script.php'); ?>
</html>