<?php
session_start();
session_destroy();

$_SESSION['warning'] = "You have been successfully logged out";
header("location: index.php");