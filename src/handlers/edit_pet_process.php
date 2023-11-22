<?php
session_start();


if($_SERVER["REQUEST_METHOD"] == "POST") {

    $pet_name = $_POST["pet_name"];
    $pet_type = $_POST["pet_type"];
    $pet_breed = $_POST["pet_breed"];
    $pet_age_str = $_POST["pet_age"];
    $pet_id = $_POST["pet_id"];

    // Needs to be changed dynamicly.
    $user_id = $_SESSION["user_data"]["user_id"];

    // Check user owns the pet or if the user is an admin.

    if (!($user_id === $pet_id) && ($_SESSION["user_data"]["user_roles"] != "admin")) {
        die("You do not own this pet.");
    }

    // Type Validation

    try {
        $pet_age = intval($pet_age_str);
    } catch (Exception $e) {
        header("Location: /yourpet/src/pages/edit_pet.php?msg=error-age-int");
        die();
    }


    require("./connect_db.php");
    $conn = connect_to_database();

    $query = "UPDATE pets SET pet_name=?, pet_type=?, pet_breed=?, pet_age=? WHERE pet_id=?";
    $stmt = $conn->prepare( $query );
    $stmt->bind_param("sssii", $pet_name, $pet_type, $pet_breed, $pet_age, $pet_id);

    if( $stmt->execute() ) {
        header("Location: /yourpet/src/pages/dashboard.php?msg=edit-pet-success");
        $stmt->close();
    } else {
        echo ("Opps! There was an error executing the statement.");
    }


    $conn->close();
}
