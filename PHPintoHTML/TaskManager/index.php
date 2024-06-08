<?php
include_once("bootstrap/const.php");
include_once(BASE_PATH."bootstrap/init.php");
if(isset($_GET['logout'])) {
    logout();
}
//var_dump($_SESSION['user']);
if(!is_loggedin()) {
        header("location: ".site_url("auth.php"));
}


if(isset($_GET["delete_folder"]) && is_numeric($_GET["delete_folder"])){
    $affected_rows= delete_folder($_GET["delete_folder"]);
}
if(isset($_GET["delete_task"]) && is_numeric($_GET["delete_task"])){
    $affected_rows= delete_task($_GET["delete_task"]);
}
$folders=  get_folders();
$tasks=  get_tasks();

include_once(BASE_PATH."tpl/tpl-index.php");

?>