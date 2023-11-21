<?php 
function get_user() {
    require($_SERVER['DOCUMENT_ROOT'] . "/yourpet/src/handlers/connect_db.php");
    $conn = connect_to_database();
    
    $userData = $_SESSION["user_data"];
    $userId = $userData["user_id"];
    
    $sql = "SELECT * FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $user_row = $result->fetch_assoc();

    
    $stmt->close();
    $conn->close();
    
    return $user_row;

}
