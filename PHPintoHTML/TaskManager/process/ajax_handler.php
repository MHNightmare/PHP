<?php
include_once("../bootstrap/init.php");
//cheking if the request is ajax
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {
    if(isset($_POST['action']) && $_POST['action'] == 'add_folder') {
    //adding folder
        $new_folder_id = add_folder($_POST['folder_name']);
        echo $new_folder_id ;
     }
    //adding task
     elseif(isset($_POST['action']) && $_POST['action'] == 'add_task') {
        // var_dump($_POST);
        if(isset($_POST['folder_id'])) {
                $folder_id = $_POST['folder_id'];
            };

        $new_task_id = add_task($_POST['task_name'], $folder_id);
        echo $new_task_id ;
     }
     //switching task is_done
     elseif(isset($_POST['action']) && $_POST['action'] == 'is_done_swich'){
        $task_id= $_POST['task_name'];
        toggle_swich($task_id);
     }
     //in progress switch
     elseif(isset($_POST['action']) && $_POST['action'] == 'in-progress'){
        $task_id= $_POST['task_name'];
        toggle_status($task_id);
     
     }
}
else
{
    die('the request is not valid');
};