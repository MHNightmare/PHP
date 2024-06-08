<?php
include_once("/xampp/htdocs/TaskManager/bootstrap/init.php");

// Assuming get_user() returns an object with an 'email' property
$user = isset($_SESSION['user']) ? get_user() : null;
$email = $user ? $user->email : "";

$default = "https://www.somewhere.com/homestar.jpg";
$grav_url = "https://www.gravatar.com/avatar/" . md5(strtolower(trim($email))) . "?d=" . urlencode($default);
?>
