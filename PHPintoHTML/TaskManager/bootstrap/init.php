<?php
session_start();
include_once("const.php");
include_once(BASE_PATH."bootstrap/config.php");
include_once(BASE_PATH."vendor/autoload.php");

$pdo = new PDO("mysql:dbname=$data_base->db;host=$data_base->host", $data_base->user, $data_base->pass);

include_once(BASE_PATH."libs/functions.php");
include_once(BASE_PATH."libs/auth_function.php");
include_once(BASE_PATH."assets/img/gravatar.php");