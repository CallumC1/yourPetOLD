<?php
session_start();
include("./generate_csrf.php");
generate_csrf();

// Session already started from csrf.
session_regenerate_id(true);


if($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("Token validation failed (CSRF)");
    }

    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $formData = [
        'first_name' => $first_name,
        'last_name'  => $last_name,
        'email'      => $email,
    ];
    $_SESSION['signup_form_data'] = $formData;

    if (strlen($password) < 5) {
        echo("Password too short.");
        header("Location: /yourpet/src/pages/signup.php?msg=password-short");
        exit();
    };


    require("./connect_db.php");
    $conn = connect_to_database();
    

    // Check if user email is already in database.
    $sql = "SELECT * FROM users WHERE email = ?";
    $check_stmt = $conn->prepare($sql);
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        echo("User with this email already exists.");
        header("Location: /yourpet/src/pages/signup.php?msg=email-already-exists");
        $check_stmt->close();
        $conn->close();
        exit();
    }

    $check_stmt->close();

    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    $sql = "INSERT INTO users (first_name, last_name, email, password_hash) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssss", $first_name, $last_name, $email, $password_hash);

        if ($stmt->execute()) {
            // Successfully added the user, now redirect back with a message.
            $stmt->close();
            header("Location: /yourpet/src/pages/login.php?msg=signup-success");
        } else {
            echo ("Opps! There was an error executing the statement.");
        };

    } else {
        echo ("Opps! There was an error preparing the statement.");
    };


    $conn->close();
}