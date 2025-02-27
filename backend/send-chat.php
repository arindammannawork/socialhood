<?php
// include("../db/connection.php");

// if ($_SERVER["REQUEST_METHOD"] == "POST")
// {
//     $from_username = trim($_POST["from_username"]);
//     $to_username = trim($_POST["to_username"]);
//     $message = trim($_POST["message"]);

//     if (!empty($from_username) && !empty($to_username) && !empty($message))
//     {
//         $sql = "INSERT INTO chat (from_username, to_username, message, sent_at) VALUES (?, ?, ?, NOW())";
//         $stmt = mysqli_prepare($connection, $sql);
//         mysqli_stmt_bind_param($stmt, "sss", $from_username, $to_username, $message);
//         $success = mysqli_stmt_execute($stmt);

//         echo json_encode(["success" => $success]);
//     } else
//     {
//         echo json_encode(["success" => false]);
//     }
// }
?>