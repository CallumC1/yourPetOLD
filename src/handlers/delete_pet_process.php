<?php
session_start();
require($_SERVER['DOCUMENT_ROOT'] . "/yourpet/src/handlers/get_user.php");
require($_SERVER['DOCUMENT_ROOT'] . "/yourpet/src/handlers/get_pet.php");

$user_data = get_user();

$pet = get_pet_by_id($_GET["pet_id"]);

// Check user owns the pet.
$user_id = $user_data["user_id"];
$pet_user_id = $pet["FK_user_id"];


if (!($user_id === $pet_user_id) && ($user_data["user_roles"] != "admin")) {
    die("You do not own this pet.");
}

require_once($_SERVER['DOCUMENT_ROOT'] . "/yourpet/src/handlers/connect_db.php");
$conn = connect_to_database();

$sql = "DELETE FROM pets WHERE pet_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_GET["pet_id"]);

if ($stmt->execute()) {
    $stmt->close();
    $conn->close();
    echo("Deleted pet index " .  $_GET["pet_id"]);
    header("Location: /yourpet/src/pages/dashboard.php?msg=delete-pet-success");

} else {
    $stmt->close();
    $conn->close();
    header("Location: /yourpet/src/pages/dashboard.php?msg=delete-pet-error");
    die("Failed to delete pet index" .  $_GET["pet_id"]);
}


?>