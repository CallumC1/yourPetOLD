<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'] . "/yourpet/src/handlers/authentication.php");

if (is_authed()){
    unset($_SESSION["user_data"]);
    header("Location: /yourpet/src/pages/dashboard.php");
} else {
    echo("Error: No session found.");
    sleep(2);
    header("Location: /yourpet/src/pages/dashboard.php");
}