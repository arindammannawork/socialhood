<?php
include("back/env.php");

// starting session only when $_session is set
session_start();
include("db/connection.php");

// getting GET parameters
if (isset($_GET['search']))
{
    $username = $_GET['search'];

    // including root database connection file

    $sql = "SELECT `id`,`username`, `fname`, `lname`, `email` FROM `users` WHERE `username` LIKE '%$username%'OR `fname` LIKE '%$username%' OR `lname` LIKE '%$username%';";
    // die($sql);
    $result = mysqli_query($connection, $sql);
    // print_r($result);
    // die();
    // if(mysqli_num_rows($result)>=1){
    //     // fetching and storing records in variables
    //     // while(){

    //     // }
    //     $row = mysqli_fetch_assoc($result);
    //     $username_row=$row['username'];
    //     $user_id = $row['id'];
    //     $fname = $row['fname'];
    //     $lname = $row['lname'];
    //     $email = $row['email'];
    // }
}

?>

<?php
include './components/navbar.php'; //previously made footer part
?>
<main class="main">

    <?php if (isset($_GET['search'])): ?>
        <?php if (mysqli_num_rows($result) >= 1): ?>
            <?php while ($row = mysqli_fetch_assoc($result))
            {
                $username_row = $row['username'];
                $user_id = $row['id'];
                $fname = $row['fname'];
                $lname = $row['lname'];
                $email = $row['email'];
                ?>
                <a href="account.php?username=<?php echo $username_row; ?>">
                    <div class=" user-profile">
                        <img class="user-avatar" src="https://api.dicebear.com/6.x/initials/png?seed=<?php echo $fname ?>&size=128"
                            alt=" User 1">
                        <div class="user-info">
                            <div class="user-username">
                                <?php echo $username_row; ?>
                            </div>
                            <div class="user-name"><?php echo $fname . ' ' . $lname; ?></div>
                        </div>
                    </div>
                </a>
            <?php } ?>
        <?php endif; ?>
        <?php if (mysqli_num_rows($result) == 0)
        {
            readfile('error/user_not_found.html');
        } ?>
    <?php endif; ?>
    <?php if (isset($_GET['username']))
    { ?>
        <?php
        if (isset($_GET['tab']))
        {
            $tab = $_GET['tab'];
        } else
        {
            $tab = "feed";
        }
        $username = $_GET['username'];
        $sql = "SELECT `id`,`username`, `fname`, `lname`, `email`,`profile_pic`,`cover_pic` FROM `users` WHERE `username` ='$username';";
        $result = mysqli_query($connection, $sql);
        $row = mysqli_fetch_array($result);
        $username_row = $row['username'];
        $user_id = $row['id'];
        $fname = $row['fname'];
        $lname = $row['lname'];
        $email = $row['email'];
        $profile_pic = $row['profile_pic'];
        $cover_pic = $row['cover_pic'];
        ?>
        <div class="account">
            <div class="account-body">
                <div class="account-banner" style="background-image: url('logo/banner2.jpg');">
                    <div class="account-img">
                        <ul>

                            <li>
                                <?php
                                if ($profile_pic == null)
                                {
                                    # code...
                            

                                    ?>
                                    <img src="https://api.dicebear.com/6.x/initials/png?seed=<?php echo $fname ?>&size=128"
                                        alt="profile" class="account-profpic">
                                    <?php
                                } else
                                { ?>
                                    <img src="uploads/<?php echo $profile_pic; ?>" alt="profile" class="account-profpic">
                                    <?php
                                }
                                ?>
                            </li>
                            <li style="padding-left: 10px;">

                                <div class="message-buttons-name">
                                    <?php
                                    echo "<b>$fname</b>";
                                    echo "<small>@$username_row</small><br>";
                                    ?>
                                    <?php if (isset($_SESSION['username']) and ($username != $_SESSION['username'])): ?>
                                        <form action="message.php" method="GET">
                                            <input type="hidden" name="recp2" value="<?php echo $user_id; ?>">
                                            <button class="message-btn mobile-btn">Send message</button>
                                        </form>
                                    <?php endif; ?>
                                </div>

                            </li>
                            <li>
                                <?php if (isset($_SESSION['username']) and ($username != $_SESSION['username'])): ?>
                                    <form action="message.php" method="GET">
                                        <input type="hidden" name="recp2" value="<?php echo $user_id; ?>">
                                        <button class="message-btn desktop-btn">Send message</button>
                                    </form>
                                <?php endif; ?>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="account-tabs">
                    <ul>
                        <li class="acc-tabs-item">
                            <?php echo '<a href="account.php?username=' . $username . '&tab=feed" class="acc-tabs-link feed-tab active">Feed</a>'; ?>
                        </li>
                        <li class="acc-tabs-item">
                            <?php echo '<a href="account.php?username=' . $username . '&tab=info" class="acc-tabs-link info-tab">Info</a>'; ?>
                        </li>
                        <li class="acc-tabs-item">
                            <?php echo '<a href="account.php?username=' . $username . '&tab=photo" class="acc-tabs-link photo-tab">Photo</a>'; ?>
                        </li>
                        <li class="acc-tabs-item">
                            <?php echo '<a href="account.php?username=' . $username . '&tab=friends" class="acc-tabs-link friends-tab">Friends</a>'; ?>
                        </li>
                        <li class="acc-tabs-item">
                            <?php echo '<a href="account.php?username=' . $username . '&tab=friend_requests" class="acc-tabs-link friend_requests-tab">Frinde Requests</a>'; ?>
                        </li>
                    </ul>
                </div>

                <div class="acc-tabs-page">
                    <!-- Account tabs (Feed, Info, etc) This peice of code gives the logic to display
            various account feed to as per users login status -->

                    <!-- By default feed account tab will be shown to any user -->
                    <?php if (isset($tab) && $tab == "feed"): ?>
                        <!-- Logic to show users feed/posts: This peice of code fetches the posts
                    from Post table in database for that particular user.
                    If user have multiple posts created then the fetching operation (SQL query) will
                    return multiple rows and the post boxes will recursively created for every posts -->
                        <div class="acc-feed">
                            <p>Welcome to <?php echo $fname ?>'s feed...</p>

                            <!-- Feed posting box logic: This box will only be visible to the user
                        who is logged in and present on his/her account page only -->

                            <?php if (isset($_SESSION['username']) && $_SESSION['username'] == $username): ?>
                                <div class="feed-post-box">
                                    <form action="post.php?redirect=feed.php" method="post" enctype="multipart/form-data">
                                        <textarea name="post" id="post" wrap="hard"
                                            placeholder="Whats in your mind? <?php echo $fname; ?>"
                                            class="feed-post-box-textarea"></textarea>
                                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                        <input type="hidden" name="username" value="<?php echo $username; ?>">
                                        <input type="file" name="postimage" accept=".jpg, .png, .jpeg" class="postimage">
                                        <button type="submit" class="post-btn" style="cursor: pointer;">Post</button>
                                    </form>
                                </div>
                            <?php endif; ?>
                            <!-- Logic for Displaying users post in the form of Post box -->
                            <?php
                            /*post fetching query: this query fetches all the rows where uid is users id.
                        all the posts (rows) are iterated with help of foreach loop*/
                            $postsql = "SELECT `msg`, `image`, `pid`, `dop` FROM `posts` WHERE `uid` = " . $user_id . " ORDER BY `dop` DESC;";
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
                                    if ($postrow[1] == NULL)
                                    {
                                        echo '<div class="feed-post-display-box">
                                            <div class="feed-post-display-box-head">
                                                <ul>
                                                    <li>
                                                    <a href="account.php?username=' . $username . '" style="text-decoration: none;"><img src="https://api.dicebear.com/6.x/initials/png?seed=' . $fname . '&size=128" alt="profile" class="account-profpic"></a>
                                                    </li>
                                                    <li style="padding-left: 10px; padding-right: 10px;">
                                                        <a href="account.php?username=' . $username . '" style="text-decoration: none;">' . $fname . '</a>
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
                                                    <a href="account.php?username=' . $username . '" style="text-decoration: none;"><img src="https://api.dicebear.com/6.x/initials/png?seed=' . $fname . '&size=128" alt="profile" class="account-profpic"></a>
                                                    </li>
                                                    <li style="padding-left: 10px; padding-right: 10px;">
                                                        <a href="account.php?username=' . $username . '" style="text-decoration: none;">' . $fname . '</a>
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
                                                <img src="uploads/' . $postrow[1] . '" alt="' . $postrow[1] . '" style="width: 100%; object-fit:contain; margin-bottom: 20px; border-radius: 5px">
                                            </div>
                                        </div>';
                                    }
                                }
                            } else
                            {
                                echo '<p>Posts Not found</p>';
                            }
                            ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($tab == "info"): ?>
                        <div class="acc-info">
                            <p>Get to know <?php echo $fname ?> more...</p>
                            <div class="acc-info-content">
                                <h3 class="acc-info-content-head">Basic</h3>
                                <ul class="acc-info-content-lst">
                                    <li>
                                        <ul class="acc-info-content-list">
                                            <li class="acc-info-content-list">
                                                <p>Name :</p>
                                            </li>
                                            <li class="acc-info-content-list">
                                                <?php
                                                echo "$fname";
                                                ?>
                                            </li>
                                        </ul>
                                    </li>

                                    <li>
                                        <ul class="acc-info-content-list">
                                            <li class="acc-info-content-list">
                                                <p>Last Name :</p>
                                            </li>
                                            <li class="acc-info-content-list">
                                                <?php
                                                echo "$lname";
                                                ?>
                                            </li>
                                        </ul>
                                    </li>

                                    <li>
                                        <ul class="acc-info-content-list">
                                            <li class="acc-info-content-list">
                                                <p>Username :</p>
                                            </li>
                                            <li class="acc-info-content-list">
                                                <?php
                                                echo "$username";
                                                ?>
                                            </li>
                                        </ul>
                                    </li>

                                    <li>
                                        <ul class="acc-info-content-list">
                                            <li class="acc-info-content-list">
                                                <p>Email :</p>
                                            </li>
                                            <li class="acc-info-content-list">
                                                <?php
                                                echo "$email";
                                                ?>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($tab == "photo"): ?>
                        <div class="acc-photo">
                            <p>See photos from <?php echo $fname; ?>...</p>
                            <?php
                            $postsqlimg = "SELECT `image`, `msg`, `dop`, `uid` FROM `posts` WHERE `uid` = " . $user_id . " AND `image` IS NOT NULL ORDER BY `dop` DESC;";
                            $postresultimgs = mysqli_query($connection, $postsqlimg);

                            if (mysqli_num_rows($postresultimgs) > 0)
                            {
                                while ($postrow = mysqli_fetch_assoc($postresultimgs))
                                {
                                    echo '<div class="feed-post-display-box">
                        <div class="feed-post-display-box-head">
                            <ul>
                                <li>
                                <a href="account.php?username=' . $username . '" style="text-decoration: none;"><img src="https://api.dicebear.com/6.x/initials/png?seed=' . $fname . '&size=128" alt="profile" class="account-profpic"></a>
                                </li>
                                <li style="padding-left: 10px; padding-right: 10px;">
                                    <a href="account.php?username=' . $username . '" style="text-decoration: none;">' . $fname . '</a>
                                </li>
                                <li style="vertical-align:baseline;">
                                <small>shared a post in the feed on </small>
                                    <small>' . $postrow['dop'] . '</small>
                                </li>
                            </ul>
                        </div>
                        <div class="feed-post-display-box-message">
                            ' . str_replace("\n", "<br>", $postrow['msg']) . '
                        </div>
                        <div class="feed-post-display-box-image">
                        <a href="#">  <img src="uploads/' . $postrow['image'] . '" alt="' . $postrow['image'] . '" style="width: 100%; object-fit:contain; margin-bottom: 20px; border-radius: 5px">
                        </a></div>
                    </div>';
                                }
                            } else
                            {
                                echo '<p>Posts Not found</p>';
                            }
                            ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php } ?>

</main>
<script>
    // l    et current_url = window.location.href;
    if (current_url.indexOf("info") != -1) {
        document.querySelector('.acc-tabs-link.active').classList.remove('active');
        document.querySelector('.info-tab').classList.add('active');
    } else if (current_url.indexOf("photo") != -1) {
        document.querySelector('.acc-tabs-link.active').classList.remove('active');
        document.querySelector('.photo-tab').classList.add('active');
    } else if (current_url.indexOf("feed") != -1) {
        document.querySelector('.acc-tabs-link.active').classList.remove('active');
        document.querySelector('.feed-tab').classList.add('active');
    } else if (current_url.indexOf("friends") != -1) {
        document.querySelector('.acc-tabs-link.active').classList.remove('active');
        document.querySelector('.friends-tab').classList.add('active');
    } else if (current_url.indexOf("friend_requests") != -1) {
        document.querySelector('.acc-tabs-link.active').classList.remove('active');
        document.querySelector('.friend_requests-tab').classList.add('active');
    }
</script>

<?php
if (!(isset($_GET['search'])) && !(isset($_GET['username'])))
{
    readfile("back/search.php");
}
?>

<?php
include './components/footer.php'; //previously made footer part
?>