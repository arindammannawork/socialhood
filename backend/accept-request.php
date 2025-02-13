<?php
include("../db/connection.php");

if ($_SERVER["REQUEST_METHOD"] === "POST")
{
    $friend_username = trim($_POST['friend_username']); // Person who sent the request
    $username = trim($_POST['username']); // Logged-in user accepting the request

    // Ensure the request exists before updating
    $check_sql = "SELECT * FROM friends WHERE username = ? AND friend_username = ? AND status = 'pending'";
    $stmt = mysqli_prepare($connection, $check_sql);
    mysqli_stmt_bind_param($stmt, "ss", $username, $friend_username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0)
    {
        // Update the request status to 'accepted'
        $update_sql = "UPDATE friends SET status = 'accepted' WHERE username = ? AND friend_username = ?";
        $stmt = mysqli_prepare($connection, $update_sql);
        mysqli_stmt_bind_param($stmt, "ss", $username, $friend_username);

        if (mysqli_stmt_execute($stmt))
        {
            echo json_encode(["success" => true]);
        } else
        {
            echo json_encode(["success" => false, "message" => "Failed to accept friend request."]);
        }
    } else
    {
        echo json_encode(["success" => false, "message" => "No pending request found."]);
    }
}
?>