<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'yourPet');

function connect_to_database() {

    /* @ is used to suppress warnings  -> https://www.php.net/manual/en/mysqli.connect-error.php */
    mysqli_report(MYSQLI_REPORT_OFF);

    $conn = @new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    
    if ($conn->connect_error) {
        // Log the error instead of displaying it to the user to prevent credential leaks.
        error_log("Connection failed: " . $conn->connect_error);
        die("Internal server error. Please try again later.");
    }

    return $conn;
};
