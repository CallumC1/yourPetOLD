<?php
session_start();


if($_SERVER["REQUEST_METHOD"] == "POST") {

    $pet_name = $_POST["pet_name"];
    $pet_type = $_POST["pet_type"];
    $pet_breed = $_POST["pet_breed"];
    $pet_age_str = $_POST["pet_age"];
    // Needs to be changed dynamicly
    $user_id = $_SESSION["user_data"]["user_id"];
    echo($user_id);

    // Type Validation

    try {
        $pet_age = intval($pet_age_str);
    } catch (Exception $e) {
        header("Location: /yourpet/src/pages/add_pet.php?msg=error-age-int");
        die();
    }

    require("./connect_db.php");
    $conn = connect_to_database();


    $query = "INSERT INTO pets (pet_name, pet_type, pet_breed, pet_age, FK_user_id) VALUES (?,?,?,?,?)";
    $stmt = $conn->prepare( $query );
    $stmt->bind_param("sssii", $pet_name, $pet_type, $pet_breed, $pet_age, $user_id);

    if( $stmt->execute() ) {
        header("Location: /yourpet/src/pages/dashboard.php?msg=add-pet-success");
        $stmt->close();

    } else {
        echo ("Opps! There was an error executing the statement.");
    }


    $conn->close();
}
