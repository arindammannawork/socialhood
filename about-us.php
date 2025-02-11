<?php
session_start();
?>
<?php
include './components/navbar.php'; //previously made footer part
?>

<!-- <div class="navbar">
    <ul>
        <li>
            <img class="logo" src="logo\logo.png">
        </li>
        <li class="nav-item">
            <a href="feed.php" style="text-decoration: none">Feed</a>
        </li>
        <li class="nav-item">
            <a href="account.php" style="text-decoration: none">Account</a>
        </li>
        <li class="nav-item">
            <a href="/" style="text-decoration: none;">Login</a>
        </li>
    </ul>
</div> -->
<div class="seperate_header"></div>
<div class="about-us">
    <center><img class="about-us-logo" src="logo/logo.png" alt="logo"></center>
    <h2>About Us</h2>
    <p>Social Hood is a social networking site where users can share their posts, images, and chat with each
        other.
        It was created to provide a seamless experience to people who want to connect with others and share
        their experiences.</p>
    <p>We believe that social media can be used to bring people together and create positive changes in the
        world. Social Hood is a platform that empowers people to express themselves and share their ideas with a
        wider audience.</p>
    <p>Our team is committed to creating a safe and inclusive environment for all users. We take privacy and
        security seriously and have implemented measures to protect user data. Social Hood is a place where
        everyone
        is welcome and encouraged to be themselves.</p>
    <p>Thank you for being a part of our community. We look forward to seeing what you create and share on
        Social Hood.</p>
</div>

<?php
include './components/footer.php'; //previously made footer part
?>