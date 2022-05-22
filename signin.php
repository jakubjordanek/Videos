<?php
    session_start();

    if (isset($_SESSION['logged']))
    {
        header('Location: index.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="pl-PL">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>VIDEOS</title>

        <meta name="author" content="Jakub Jordanek">
        <meta name="description" content="">
        <meta name="keywords" content="">

        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/login.css">
        <link rel="stylesheet" href="css/default.css">
    </head>
    <body>
        <div id="login-header">
            <a href="index.php" class="link-logo">VIDEOS</a>
        </div>

        <div id="login-panel">
            <h3>LOG IN</h3>

            <form method="POST" action="login.php">
                <input type="text" placeholder="EMAIL" name="email">
                <input type="password" placeholder="PASSWORD" name="password">
                <input type="submit" value="LOG IN">
                <a href="#" class="link-white">...OR CREATE A NEW ACCOUNT!</a>
            </form>
        </div>

        <div id="login-footer">
            2022 &copy; VIDEOS
        </div>

        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>