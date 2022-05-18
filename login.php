<?php
    session_start();

    if ((!isset($_POST['email'])) && (!isset($_POST['password'])))
    {
        header("Location: signin.php");
        exit();
    }

    require_once('connect.php');
    $connect = @new mysqli($host, $db_user, $db_password, $db_name);

    if ($connect->connect_errno != 0)
    {
        echo "Error: ".$connect->connect_errno;
    }
    else
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $email = htmlentities($email, ENT_QUOTES, "UTF-8");

        if ($result = @$connect->query(sprintf("SELECT * FROM users WHERE email='%s'", mysqli_real_escape_string($connect, $email))))
        {
            if ($result->num_rows > 0)
            {
                $data = $result->fetch_assoc();

                if (password_verify($password, $data['password']))
                {
                    $_SESSION['logged'] = true;

                    $_SESSION['id'] = $data['id'];
                    $_SESSION['username'] = $data['username'];

                    $result->free_result();
                    header("Location: index.php");
                }
                else
                {
                    header("Location: signin.php");
                }
            }
            else
            {
                header("Location: signin.php");
            }
        }

        $connect->close();
    }
?>