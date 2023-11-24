<?php
include($_SERVER['DOCUMENT_ROOT'] . "/yourpet/src/handlers/authentication.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- TailwindCSS -->
    <link href="/yourPet/dist/output.css" rel="stylesheet">
    <title>Your Pet</title>
</head>
<body>
<nav class="flex items-center justify-between w-full h-20 px-5 bg-[#275457] ">
    <h1 class="text-white text-xl font-bold">Your Pet</h1>
    <ul class="flex gap-4 text-lg font-semibold text-white">
        <li><a href="./index.php">Home</a></li>
        <li><a href="./about.php">About</a></li>

        <?php if(!is_authed()): ?>
            <li><a href="./login.php">Login</a></li>
            <li><a href="./signup.php">Signup</a></li>
        <?php else: ?>
            <li><a href="./dashboard.php">My Account</a></li>
        <?php endif; ?>
    </ul>
</nav>