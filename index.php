<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="pl-PL">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>YourVideo</title>

        <meta name="author" content="Jakub Jordanek">
        <meta name="description" content="">
        <meta name="keywords" content="">

        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/fontello.css">
        <link rel="stylesheet" href="css/default.css">
        <link rel="stylesheet" href="css/main.css">
    </head>
    <body>
        <div id="sidebar">
            <h1></h1>

            <?php
                if (isset($_SESSION['logged']))
                {
                    echo '
                        <a href="index.php" id="active" class="link-white"><i class="icon-home"></i><span>HOME</span></a>
                        <a href="following.php" class="link-white"><i class="icon-videocam"></i><span>FOLLOWING</span></a>
                        <a href="upload.php" class="link-white"><i class="icon-upload"></i><span>UPLOAD</span></a>
                        <a href="profile.php?id='.$_SESSION['id'].'" class="link-white"><i class="icon-user"></i><span>'.strtoupper($_SESSION['username']).'</span></a>
                        <a href="logout.php" class="link-white"><i class="icon-off"></i><span>LOG OUT</span></a>
                    ';
                }
                else
                {
                    echo '
                        <a href="index.php" id="active" class="link-white"><i class="icon-home"></i><span>HOME</span></a>
                        <a href="signin.php" class="link-white"><i class="icon-user"></i><span>SIGN IN</span></a>
                    ';
                }
            ?>
        </div>

        <div id="content">
            <div id="header">
                <h1>HOME</h1>
            </div>

            <?php
                require_once("connect.php");
                $connect = @new mysqli($host, $db_user, $db_password, $db_name);

                if ($connect->connect_errno != 0)
                {
                    echo "Error: ".$connect->connect_errno;
                }
                else
                {
                    $query = @$connect->query("SELECT v.id, v.user_id, v.title, v.thumbnail, u.username, u.verified, v.views, v.date FROM videos AS v INNER JOIN users AS u ON v.user_id=u.id ORDER BY v.id DESC");
                    while ($data = $query->fetch_array())
                    {
                        echo '
                            <div class="video">
                                <a href="video.php?id='.$data['id'].'" class="link-video">
                                    <img src="videos/'.$data['thumbnail'].'" width="300">
                                </a>
                                
                                <span>
                                    <a href="video.php?id='.$data['id'].'" class="link-white">
                                        <h4>'.$data['title'].'</h4>
                                    </a>
                                    
                                    <a href="profile.php?id='.$data['user_id'].'" class="link-white">
                                        '.$data['username'].'
                                    </a> 
                        ';
                                    
                        if ($data['verified'] === "yes")
                        {
                            echo '<i class="icon-ok-circled"></i>';
                        }
                                    
                        echo '
                                    &bull; '.$data['views'].' views &bull; '.date("m/d/Y", strtotime($data['date'])).'
                                </span>
                            </div>
                        ';
                    }

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