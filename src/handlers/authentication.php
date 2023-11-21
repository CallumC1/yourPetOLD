<?php

function is_authed(){
    if (!isset($_SESSION["user_data"]["user_roles"])) {
        // Not authed.
        return false;
    } else {
        // Is authed.
        return true;
    }
}

function is_admin(){
    ($user_role === "admin") ? true : false;
}