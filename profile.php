<?php
    session_start();

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
        <link rel="stylesheet" href="css/profile.css">
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
                        <a href="upload.php" class="link-white"><i class="icon-upload"></i><span>UPLOAD</span></a>
                    ';
                    
                    if ($_SESSION['id'] == (int)$_GET['id'])
                    {
                        echo '<a href="profile.php?id='.$_SESSION['id'].'" id="active" class="link-white"><i class="icon-user"></i><span>'.strtoupper($_SESSION['username']).'</span></a>';
                    }
                    else
                    {
                        echo '<a href="profile.php?id='.$_SESSION['id'].'" class="link-white"><i class="icon-user"></i><span>'.strtoupper($_SESSION['username']).'</span></a>';
                    }

                    echo '<a href="logout.php" class="link-white"><i class="icon-off"></i><span>LOG OUT</span></a>';
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
            <?php
                $connect = @new mysqli($host, $db_user, $db_password, $db_name);
                if ($connect->connect_errno != 0)
                {
                    echo "Error: ".$connect->connect_errno;
                }
                else
                {
                    require_once('follow.php');
                    $data = @$connect->query("SELECT * FROM users WHERE id=".(int)$_GET['id'])->fetch_assoc();
                    $count = @$connect->query("SELECT COUNT(*) AS total FROM followers WHERE followed_id=".(int)$_GET['id'])->fetch_assoc();

                    echo '
                        <div id="profile-baner">
                            <img src="baner.jpg" width="100%">
                        </div>

                        <div id="profile-avatar">
                            <img src="avatar.jpg" width="64">
                            <span>
                                <h4>
                                    '.$data['username'];

                                    if ($data['verified'] === "yes")
                                    {
                                        echo ' <i class="icon-ok-circled"></i>';
                                    }

                    echo '
                                </h4>';
                                
                                if ($count['total'] == 1)
                                {
                                    echo $count['total'].' follower';
                                }
                                else
                                {
                                    echo $count['total'].' followers';
                                }
                                
                    echo '</span>';

                    if (isset($_SESSION['logged']))
                    {
                        echo follow($data['id'], $_SESSION['id']);
                    }

                    echo'
                        </div>
                    ';

                    $query = @$connect->query("SELECT v.id, v.user_id, v.thumbnail, v.title, u.username, v.views, v.date FROM users AS u INNER JOIN videos AS v ON u.id=v.user_id WHERE v.user_id=".(int)$_GET['id']." ORDER BY v.id DESC");
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