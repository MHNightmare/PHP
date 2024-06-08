<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Task manager</title>
  <link rel="stylesheet" href="assets/css/style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="page">
  <div class="pageHeader">
    <div class="title">Dashboard</div>
    <div class="userPanel">
      <a href="<?php echo site_url('?logout') ?>">
        <i class="fa fa-sign-out"></i>
      </a>
      <span class="username"><?php echo get_login_user(); ?></span><img src="<?php echo $grav_url?>" width="40" height="40"/></div>
  </div>
  <div class="main">
    <div class="nav">
      <div class="searchbox">
        <div><i class="fa fa-search"></i>
          <input type="search" placeholder="Search"/>
        </div>
      </div>
      <div class="menu">
        <div class="title">Navigation</div>
        <ul class='folder-list'>
        <li class="<?php echo (!isset($_GET['folder_id']) ?'active': '');?>"> <i class="fa fa-folder"></i>
         <a href="<?php echo site_url() ;?>">All</a> 
        </li>
          <?php foreach($folders as $folder): ?>
            <li class= "<?php echo (isset($_GET['folder_id']) && ($_GET['folder_id'])==$folder->id ?'active': '');?>" >
              <a href="<?php echo site_url() . "?folder_id="; echo $folder->id;?>"><i class="fa fa-folder"></i> <?php echo $folder->name; ?></a>
              <a href="<?php echo site_url() ."?delete_folder="; echo $folder->id;?>" class="remove"  onclick=" return confirm('are you sure to delete <?php echo $folder->name;?> ') "><i class="fa fa-trash-o"></i></a>
            </li>
          <?php endforeach;?>
        </ul>
        <div>
          <input type="text" class='add-new fa fa-search' placeholder="New Folder" id ="add_new_folder">
          <button  id="btn_new_folder"> + </button>
        </div>

        </ul>
      </div>
    </div>
    <div class="view">
      <div class="viewHeader">
        <div class="title">Manage Tasks
        <input type="text" class=' fa fa-search new-task' placeholder="New Task" id ="add_new_task">
        </div>
        <div class="functions">
          <div class="button active">Add New Task</div>
          <div class="button">Completed</div>
          <div class="button inverz"><i class="fa fa-trash-o"></i></div>
        </div>
      </div>
      <div class="content">
        <div class="list">
          <div class="title">Today</div>
          <ul>
          <?php foreach($tasks as $task): ?>
            
            <li class="<?php echo ($task->status !== 'pending') ? 'checked' : ''; ?>">
              <a href="<?php echo site_url() ."?delete_task=" ; echo $task->id;?>" class="remove" onclick=" return confirm('are you sure to delete <?php echo $task->name;?>' )"><i class="fa fa-trash-o"></i></a>
              <i data-taskid="<?php echo $task->id; ?>" class="is-done fa  <?php echo ($task->is_done == '1') ? 'fa-check-square-o' : 'fa fa-square-o'; ?>"></i>
              <span class="in-progress" data-taskid="<?php echo $task->id; ?>"  > <?php echo $task->name; ?></span>
              <div class="info">
                <div class="button <?php echo ($task->status == 'done') ? 'green' : (($task->status == 'in progress') ? 'blue' : '');?>"> <?php echo $task->status; ?></div><span>created at <?php echo $task->created_at;?></span>
              </div>              

            </li>
            <?php endforeach;?>
          </ul>
        </div>
        
      </div>
    </div>
  </div>
</div>
<!-- partial -->
  <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script  src="assets/js/script.js"></script>
  <script>
    
    //add folder via ajax
    $(document).ready(function(){
      //swithing check box
      $('.is-done').click(function(e){
        var task_id = $(this).attr('data-taskid');
        $.ajax({
            url: 'process/ajax_handler.php',
            method: 'post' ,
            data:{
              action: 'is_done_swich',
              task_name : task_id
            },
           success: function(){
           location.reload();}
         });
      });
      //swiching inprogress
      $('.in-progress').click(function(e){
        var task_id = $(this).attr('data-taskid');
        $.ajax({
            url: 'process/ajax_handler.php',
            method: 'post' ,
            data:{
              action: 'in-progress',
              task_name : task_id
            },
          success: function(){
          location.reload();}
         });
      });
      //add new folder
      $('#btn_new_folder').click(function(e){
        var folder_name= $('#add_new_folder');
        $.ajax({
          url: 'process/ajax_handler.php',
          method: 'post' ,
          data:{
            action: 'add_folder',
            folder_name :  folder_name.val()
          },
          success: function(){
          location.reload();
          }
        });
      });
    });
    //add task via ajax
    $('#add_new_task').on('keypress',function(e) {
      if(e.which == 13) {
        $.ajax({
          url: 'process/ajax_handler.php',
          method: 'post' ,
          data:{
            action: 'add_task',
            folder_id: '<?php echo ($_GET['folder_id']) ?? null ;?>' ,
            task_name : $('#add_new_task').val(),
          },
          success: function(id){
            location.reload();
          }
        });
    }
    $('#add_new_task').focus();
});
  </script>

</body>
</html>
