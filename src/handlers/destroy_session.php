<?php
session_start();
session_destroy();
header("Location: /userauthphp/pages/index.php");
