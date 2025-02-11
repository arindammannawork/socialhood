<?php
include("back/env.php");

// starting session only when $_session is set
session_start();
// including root database connection file
include("db/connection.php");

?>
<?php
include './components/navbar.php'; //previously made footer part
?>

<main class="main">




    <div class="feed-page-body">
        <div class="feed-page-head">
            <h2>Feed</h2>
        </div>

        <?php if (isset($_SESSION['username']) && isset($_SESSION['id'])): ?>
            <div class="feed-posting-box">
                <form action="post.php?redirect=feed.php" method="post" enctype="multipart/form-data">
                    <textarea name="post" id="post" wrap="hard"
                        placeholder="Whats in your mind? <?php echo $_SESSION['username']; ?>"
                        class="feed-post-box-textarea"></textarea>
                    <input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['id']; ?>">
                    <input type="hidden" name="username" id="username" value="<?php echo $_SESSION['username']; ?>">
                    <input type="hidden" name="redirect" id="redirect" value="<?php echo "feed.php"; ?>">
                    <input type="file" name="postimage" accept=".jpg, .png, .jpeg" class="postimage">
                    <button type="submit" class="post-btn">Post</button>
                </form>
            </div>
        <?php endif; ?>

        <div class="feeds">
            <?php
            // Posts fetching query which orders rows returned by query in descendin form (Old post -> New post)
            $postsql = "SELECT `msg`, `image`, `uid`, `dop` FROM `posts` ORDER BY `dop` DESC;";
            // executing query
            $postresult = mysqli_query($connection, $postsql);
            // counting number of rows return by query and only show post box
            // if number posts are greater than zero
            
            if (mysqli_num_rows($postresult) > 0)
            {


                // fetching rows returned by query
                $postrows = mysqli_fetch_all($postresult);

                foreach ($postrows as $postrow)
                {
                    // getting usernames for every posts as usernames are not stored in same table
                    $usrsql = "SELECT `username`, `fname`,`profile_pic` FROM `users` WHERE `id` = " . $postrow[2] . ";";
                    $usrresult = mysqli_query($connection, $usrsql);
                    $usrrow = mysqli_fetch_assoc($usrresult);

                    if ($postrow[1] == NULL)
                    {
                        $profile_pic = $usrrow['profile_pic'];
                        if ($profile_pic != NULL)
                        {
                            # code...
                            $profile_pic_path = 'uploads/' . $profile_pic;
                        } else
                        {
                            # code...
                            $profile_pic_path = 'https://api.dicebear.com/6.x/initials/png?seed=' . $fname . '&size=128';
                        }
                        echo '<div class="feed-post-display-box">
                                    <div class="feed-post-display-box-head">
                                        <ul>
                                            <li>
                                            <a href="account.php?username=' . $usrrow['username'] . '" style="text-decoration: none;"><img src="' . $profile_pic_path . '" alt="profile" class="account-profpic"></a>
                                            </li>
                                            <li style="padding-left: 10px; padding-right: 10px;">
                                                <a href="account.php?username=' . $usrrow['username'] . '" style="text-decoration: none;">' . $usrrow['fname'] . '</a>
                                            </li>
                                            <li style="vertical-align:baseline;">
                                            <small>shared a post in the feed on </small>
                                                <small>' . $postrow[3] . '</small>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="feed-post-display-box-message">
                                        ' . str_replace("\n", "<br>", $postrow[0]) . '
                                    </div>
                                </div>';
                    } else
                    {
                        echo '<div class="feed-post-display-box">
                                    <div class="feed-post-display-box-head">
                                        <ul>
                                            <li>
                                            <a href="account.php?username=' . $usrrow['username'] . '" style="text-decoration: none;"><img src="https://api.dicebear.com/6.x/initials/png?seed=' . $usrrow['fname'] . '&size=128" alt="profile" class="account-profpic"></a>
                                            </li>
                                            <li style="padding-left: 10px; padding-right: 10px;">
                                                <a href="account.php?username=' . $usrrow['username'] . '" style="text-decoration: none;">' . $usrrow['fname'] . '</a>
                                            </li>
                                            <li style="vertical-align:baseline;">
                                            <small>shared a post in the feed on </small>
                                                <small>' . $postrow[3] . '</small>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="feed-post-display-box-message">
                                        ' . str_replace("\n", "<br>", $postrow[0]) . '
                                    </div>
                                    <div class="feed-post-display-box-image">
                                    <a href="#">   <img src="uploads/' . $postrow[1] . '" alt="' . $postrow[1] . '" style="width: 100%; object-fit:contain; margin-bottom: 20px; border-radius: 5px">
                                    </a></div>
                                </div>';
                    }
                }
            } else
            {
                echo '<p>Posts Not found</p>';
            }
            ?>
        </div>
    </div>


</main>

<?php
include './components/footer.php'; //previously made footer part
?>