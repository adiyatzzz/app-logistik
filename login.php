<?php
include('class/init.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Warehouse - Login</title>
</head>

<body>
    <div class="login-content">
        <div class="login-form d-flex justify-content-center flex-column">
            <div class="login-icon d-flex justify-content-center">
                <img src="assets/img/padlock.png" width="50">
            </div>
            <form action="" method="post">
                <div class="form-group">
                    <input type="text" name="username" id="username" placeholder="Username">
                </div>
                <div class="form-group">
                    <input type="password" name="password" id="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <input type="email" name="email" id="email" placeholder="Email">
                </div>
                <div class="form-group d-flex flex-column">
                    <button type="submit" class="login-btn">Login</button>
                    <button type="button" class="register-btn">Register</button>
                </div>
            </form>
        </div>
    </div>

    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/myscript.js"></script>
</body>

</html>