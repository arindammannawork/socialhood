<?php
// including root connection file
include("../db/connection.php");
include("../back/env.php");

// $username = $_SESSION['username'];

// Data from Post
$username = strtolower(trim($_POST['username']));
$password = trim(string: $_POST['password']);

// Additional data for registration
if (isset($_POST['editAccount']))
{
    $fname = $_POST['fname'];
    $uid = $_POST['id'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
}
// $profile_pic = null;
// $cover_pic = null;
if ($_FILES['profile_pic']['error'] != 4)
{
    $imagename = $_FILES['profile_pic']['name'];
    $imagetmpname = $_FILES['profile_pic']['tmp_name'];

    // assigning new name to the image file
    $imagename = explode(".", $imagename);
    $imageext = strtolower(string: end($imagename));
    $imagename = uniqid() . "." . $imageext;

    $folder = "../uploads/" . $imagename;
    move_uploaded_file($imagetmpname, $folder);
    $profile_pic = $imagename;
}
if ($_FILES['cover_pic']['error'] != 4)
{
    $imagename = $_FILES['cover_pic']['name'];
    $imagetmpname = $_FILES['cover_pic']['tmp_name'];

    // assigning new name to the image file
    $imagename = explode(".", $imagename);
    $imageext = strtolower(string: end($imagename));
    $imagename = uniqid() . "." . $imageext;

    $folder = "uploads/" . $imagename;
    move_uploaded_file($imagetmpname, $folder);
    $cover_pic = $imagename;
}
// function movefile($filename)
// {

// }
// movefile("profile_pic");
// movefile("cover_pic");


// Set redirect if provided
if (isset($_POST['redirect']))
{
    $redirect = $_POST['redirect'];
}


// alerting function
function alert_message($message, $location)
{
    echo '<script language="javascript">';
    echo 'alert("' . $message . '");';
    echo 'window.location="' . $location . '";';
    echo '</script>';
}

// checking if the user is logging in or registering
if (isset($username) && isset($password))
{

    $hashed_pswd = crypt($password, '$1$');

    $sql = "SELECT `id` FROM `users` WHERE `username` = '$username';";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) == 1 && $_SESSION['username'] == $username)
    {
        alert_message("Username already taken. Try another one", $home_page . "edit-account.php");
        exit();
    } else
    {
        echo "Profile Pic: " . $profile_pic . "<br>";
        echo "Cover Pic: " . $cover_pic . "<br>";
        print_r($_POST);
        print_r($_FILES);
        $sql = "UPDATE `users` 
        SET `username` = '$username', 
            `fname` = '$fname', 
            `lname` = '$lname', 
            `email` = '$email', 
            `password` = '$hashed_pswd' ";

        // Add profile/cover pic only if uploaded
        if ($profile_pic)
        {
            $sql .= ", `profile_pic` = '$profile_pic'";
        }
        if ($cover_pic)
        {
            $sql .= ", `cover_pic` = '$cover_pic'";
        }

        $sql .= " WHERE `id` = '$uid'";
        mysqli_query($connection, $sql);
    }

    // start session after verification
    session_start();
    $_SESSION['username'] = $username;
    $_SESSION['status'] = $login;
    $_SESSION['id'] = $uid;

    echo '<script language="javascript">';
    echo 'window.location="' . $home_page . 'account.php?username=' . $username . '";';
    echo '</script>';
}


?>