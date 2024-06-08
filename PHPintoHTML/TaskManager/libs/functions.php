<?php
function get_user() {
   $user= $_SESSION['user'];
   $user= get_user_byemail($user->email);
   return $user;   
};
function get_user_byemail($email) {
    global $pdo;
    $sql = "SELECT * from users where email = :email ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([":email"=> $email]);
    $records=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $records['0'] ?? null;
};



function site_url($uri="") {
    return BASE_URL."$uri";
}
//foder functions
function delete_folder($folder_id){
     global $pdo;
     $sql = "delete from folders where id= $folder_id";
     $stmt= $pdo->prepare($sql);
     $stmt->execute();
     delete_tasks($folder_id);
     return $stmt->rowCount();
     //return $stmt->fetchAll(PDO::FETCH_OBJ);
}

function add_folder($foldername){
    $user = get_user();
    $user_id= $user->id;
    global $pdo;
    $sql = "INSERT INTO folders (name , user_id) VALUES (:folder_name , :user_id)" ;
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':folder_name'=> $foldername,':user_id'=> $user_id]);
    return $pdo->lastInsertId();
}

function get_folders() {
    $user = get_user();
    $user_id= $user->id;
    global $pdo;
    $sql = "select * from folders where user_id = $user_id ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
};
// task functions
function get_tasks() {
    $user = get_user();
    $user_id= $user->id;
    $folder_id=$_GET['folder_id'] ?? null ;
    $folder_condition ='';
    if(isset($folder_id)){
        $folder_condition = "and folder_id = $folder_id" ;
    }
    global $pdo;
    $sql = "select * from tasks where user_id = $user_id $folder_condition ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
};

function delete_task($task_id){
    global $pdo;
    $sql = "delete from tasks where id= $task_id";
    $stmt= $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->rowCount();
}
function delete_tasks($folder_id){
    global $pdo;
    $sql = "delete from tasks where folder_id = $folder_id";
    $stmt= $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->rowCount();
}

function add_task($task_name,$task_folder='0'){
    $user = get_user();
    $user_id= $user->id;
    global $pdo;
    $sql = "INSERT INTO tasks (name , user_id , folder_id) VALUES (:task_name , :user_id , :folder_id)" ;
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':task_name'=> $task_name,':user_id'=> $user_id,':folder_id'=> $task_folder]);
    return $pdo->lastInsertId();
}

function toggle_swich($task_id){ 
    $user = get_user();
    $user_id= $user->id;
    global $pdo;
    $sql = "update tasks set is_done = 1- is_done where user_id = :user_id and id = :task_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':task_id'=> $task_id,':user_id'=> $user_id]);
    $ts =get_tasks($task_id);
    foreach($ts as $task){
        if(($task->id==$task_id)&&($task->is_done=='1')) {
            $sql = "update tasks set status = 'done' where user_id = :user_id and id = :task_id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':task_id'=> $task_id,':user_id'=> $user_id]);
        }elseif(($task->id==$task_id)&&($task->is_done=='0')){
            $sql = "update tasks set status = 'pending' where user_id = :user_id and id = :task_id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':task_id'=> $task_id,':user_id'=> $user_id]);
        }
    };
};
//inprogress switch
function toggle_status($task_id){ 
    $user = get_user();
    $user_id= $user->id;
    global $pdo;
    $sql = "update tasks set is_inprogress = 1- is_inprogress where user_id = :user_id and id = :task_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':task_id'=> $task_id,':user_id'=> $user_id]);
    $ts =get_tasks($task_id);
    foreach($ts as $task){
        if(($task->id==$task_id)&&($task->is_inprogress=='1')) {
            $sql = "update tasks set status = 'in progress' where user_id = :user_id and id = :task_id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':task_id'=> $task_id,':user_id'=> $user_id]);
        }elseif(($task->id==$task_id)&&($task->is_inprogress=='0')){
            $sql = "update tasks set status = 'pending' where user_id = :user_id and id = :task_id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':task_id'=> $task_id,':user_id'=> $user_id]);
        }
    };
};

function alert($msg){
   echo "<span class='    '>".$msg."</span>";  
}