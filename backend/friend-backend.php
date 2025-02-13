<?php
include("../db/connection.php");
include("../back/env.php");

$username = trim($_POST['username']); // Sender
$friend_username = trim($_POST['friend_username']); // Receiver
$redirect = $_POST['redirect'] ?? "account.php?username=" . $username;

function alert_message($message, $location)
{
    echo '<script>';
    echo 'alert("' . $message . '");';
    echo 'window.location="' . $location . '";';
    echo '</script>';
}

// ✅ FIX: Use prepared statements to prevent SQL injection
$check_sql = "SELECT * FROM friends 
              WHERE (username = ? AND friend_username = ?) 
              OR (username = ? AND friend_username = ?)";

$stmt = mysqli_prepare($connection, $check_sql);
mysqli_stmt_bind_param($stmt, "ssss", $username, $friend_username, $friend_username, $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0)
{
    alert_message("Friend request already sent or users are already friends.", $home_page . $redirect);
    exit();
}

// ✅ FIX: Use prepared statements for inserting data
$sql = "INSERT INTO friends (username, friend_username, status) VALUES (?, ?, 'pending')";
$stmt = mysqli_prepare($connection, $sql);
mysqli_stmt_bind_param($stmt, "ss", $username, $friend_username);

if (mysqli_stmt_execute($stmt))
{
    alert_message("Friend request sent successfully!", $home_page . $redirect);
} else
{
    alert_message("Error sending friend request.", $home_page . $redirect);
}

// mysqli_close($connection);
?>