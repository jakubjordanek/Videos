<?php
    session_start();

    if (!isset($_SESSION['logged']))
    {
        header("Location: index.php");
        exit();
    }

    require_once("connect.php");
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
        <link rel="stylesheet" href="css/fontello.css">
        <link rel="stylesheet" href="css/default.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/upload.css">
    </head>
    <body>
        <div id="sidebar">
            <h1></h1>
            
            <?php
                if (isset($_SESSION['logged']))
                {
                    echo '
                        <a href="index.php" class="link-white"><i class="icon-home"></i><span>HOME</span></a>
                        <a href="following.php" class="link-white"><i class="icon-videocam"></i><span>FOLLOWING</span></a>
                        <a href="upload.php" id="active" class="link-white"><i class="icon-upload"></i><span>UPLOAD</span></a>
                        <a href="profile.php?id='.$_SESSION['id'].'" class="link-white"><i class="icon-user"></i><span>'.strtoupper($_SESSION['username']).'</span></a>
                        <a href="logout.php" class="link-white"><i class="icon-off"></i><span>LOG OUT</span></a>
                    ';
                }
                else
                {
                    echo '
                        <a href="index.php" class="link-white"><i class="icon-home"></i><span>HOME</span></a>
                        <a href="signin.php" class="link-white"><i class="icon-user"></i><span>SIGN IN</span></a>
                    ';
                }
            ?>
        </div>

        <div id="content">
            <div id="header">
                <h1>UPLOAD</h1>
            </div>

            <?php
                $connect = @new mysqli($host, $db_user, $db_password, $db_name);
                if ($connect->connect_errno != 0)
                {
                    echo "Error: ".$connect->connect_errno;
                }
                else
                {
                    $connect->close();
                }
            ?>
        </div>

        <div style="clear: both;"></div>

        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>