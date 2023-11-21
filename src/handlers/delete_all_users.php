<?php

// Only for testing, will be removed.

require("./connect_db.php");
$conn = connect_to_database();

$sql = "DELETE FROM users";
$stmt = $conn->prepare($sql);
$stmt->execute();

$resetID = "ALTER TABLE users AUTO_INCREMENT = 1";

$resetIDstmt = $conn->prepare($resetID);
$resetIDstmt->execute();

header("Location: /userauthphp/pages/index.php");