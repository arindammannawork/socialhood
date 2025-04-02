<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
include("back/env.php");

session_start();
// include("db/connection.php");
// echo "hello";


// Validation before logging the user out
if (isset($_SESSION['username']))
{
    session_unset();
    session_destroy();


    echo '
    <script>
         window.location="' . $home_page . '";
    </script>
    ';
    exit;
} else
{
    echo '
    <script>
        window.location="' . $home_page . '";
    </script>
    ';
    exit;
}
?>