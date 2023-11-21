<?php 
function generate_csrf(){
    if(!isset($_SESSION["csrf_token"])) {
        $_SESSION["csrf_token"] = bin2hex(random_bytes(32));
    }
}

function add_csrf() {
    echo ("<input type='hidden' name='csrf_token' value='" . (isset($_SESSION['csrf_token']) ? $_SESSION['csrf_token'] : '') . "'>");
}
