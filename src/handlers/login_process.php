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

    // Store data to be sent back into the form on redirect.
    $formData = [
        'first_name' => $first_name,
        'last_name'  => $last_name,
        'email'      => $email,
    ];
    $_SESSION['login_form_data'] = $formData;

    require("./connect_db.php");
    $conn = connect_to_database();

    // Select just the password & id & role. Only essential pieces of information.
    $sql = "SELECT password_hash, user_id, user_roles FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // If a user with that name exists, check.
    if ($result->num_rows > 0) {
        
        if (password_verify($password, $row["password_hash"])) {
            echo("Valid Password.");
            session_regenerate_id(true);
            $userData = [
                'user_id' => $row["user_id"],
                'authenticated'  => "true",
                'authenticated_on'  => time(),
                'user_roles'  => $row["user_roles"],
            ];
            $_SESSION['user_data'] = $userData;
            header("Location: /yourpet/src/pages/dashboard.php");
        } else {
            echo("Invalid Password.");
            header("Location: /yourpet/src/pages/login.php?msg=invalid-password");
        }

    } else {
        echo("Invalid username.");
        header("Location: /yourpet/src/pages/login.php?msg=invalid-user");
    }


    $stmt->close();
    $conn->close();

};