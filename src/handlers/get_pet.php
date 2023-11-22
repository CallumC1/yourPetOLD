<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . "/yourpet/src/handlers/connect_db.php");

function get_pet_by_id($pet_id){
    $conn = connect_to_database();

    $sql = "SELECT * FROM pets WHERE pet_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $pet_id);
    $row = $stmt->execute();
    $result = $stmt->get_result();
    $pet = $result->fetch_assoc();

    $stmt->close();
    $conn->close();
    return $pet;
}

?>
