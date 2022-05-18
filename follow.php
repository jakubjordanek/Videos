<?php
    function follow ($followed_id, $follower_id)
    {
        global $connect;
        if ($follower_id != $followed_id)
        {
            if (@$connect->query("SELECT * FROM followers WHERE followed_id=".$followed_id." AND follower_id=".$follower_id)->num_rows > 0)
            {
                echo <<< END
                    <form method="POST" id="follow-form">
                        <input type="submit" name="unfollow" value="UNFOLLOW" id="unfollow-button">
                    </form>
                END;
                
                if ($_SERVER['REQUEST_METHOD'] === 'POST')
                {
                    if (isset($_POST['unfollow']))
                    {
                        @$connect->query("DELETE FROM followers WHERE followed_id=".$followed_id." AND follower_id=".$follower_id);
                        header("Refresh:0");
                    }
                }
            }
            else
            {
                echo <<< END
                    <form method="POST" id="follow-form">
                        <input type="submit" name="follow" value="FOLLOW" id="follow-button">
                    </form>
                END;

                if ($_SERVER['REQUEST_METHOD'] === 'POST')
                {
                    if (isset($_POST['follow']))
                    {
                        @$connect->query("INSERT INTO followers VALUES (".$followed_id.", ".$follower_id.")");
                        header("Refresh:0");
                    }
                }
            }
        }
    }
?>