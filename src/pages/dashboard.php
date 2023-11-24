<?php 
session_start();
include($_SERVER['DOCUMENT_ROOT'] . "/yourpet/src/components/header.php");

include_once($_SERVER['DOCUMENT_ROOT'] . "/yourpet/src/handlers/authentication.php");

if (!is_authed()):
?>


<div class="flex flex-col items-center mt-5 gap-3">
    <p>You are not authenticated, please log in or sign up.</p>
    <a href='/yourpet/src/pages/login.php' class='bg-green-500 px-3 py-2 w-32 text-center'>Log in</a>
</div>


<?php
    die();
    endif;
$user_role = $_SESSION["user_data"]["user_roles"];

if ($user_role === "user") {
    include($_SERVER['DOCUMENT_ROOT'] . "/yourpet/src/pages/user_dashboard.php");
} elseif ($user_role === "admin") {
    include($_SERVER['DOCUMENT_ROOT'] . "/yourpet/src/pages/admin_dashboard.php");
}
?>

</body>
</html>
