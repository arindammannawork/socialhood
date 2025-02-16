<?php
include("../db/connection.php");

$from_username = $_GET['from_username'];
$to_username = $_GET['to_username'];

$sql = "SELECT from_username, to_username, message, sent_at 
        FROM chat 
        WHERE (from_username = ? AND to_username = ?) 
           OR (from_username = ? AND to_username = ?) 
        ORDER BY sent_at ASC";

$stmt = mysqli_prepare($connection, $sql);
mysqli_stmt_bind_param($stmt, "ssss", $from_username, $to_username, $to_username, $from_username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$chats = [];
while ($row = mysqli_fetch_assoc($result))
{
    $chats[] = $row;
}

header('Content-Type: application/json');
echo json_encode($chats);
?>