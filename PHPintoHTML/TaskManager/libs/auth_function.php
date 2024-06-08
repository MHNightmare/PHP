<?php
//user logedin check
function is_loggedin(){
    return(isset($_SESSION["user"]));

}
//register
function register($name, $pass, $email) {
    // email verification
    global $pdo;
    
    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':email' => $email]);
    $existing_user = $stmt->fetch(PDO::FETCH_OBJ);

    if ($existing_user) {
        return "This $email has been used before";
    } else {
        // inserting to DB
        $pass_code = password_hash($pass, PASSWORD_BCRYPT);
        $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :pass)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':name' => $name, ':email' => $email, ':pass' => $pass_code]);

        return $stmt->rowCount() ? "You have successfully registered" : "There is an error";
    }
}


//login
function login($email, $pass){
    $user= get_user_byemail($email);
    if(!$user) {
       alert('user does not exist');
    }
    //user exists...checking password
    elseif(password_verify($pass, $user->password)) { 
        $_SESSION['user']=$user;
        header("location: ".site_url());
    }else{
    
       alert("password is wrong") ;
    }
}
function get_login_user(){
    $user=get_user();
    return $user->name;
}

function logout(){
    unset($_SESSION['user']);
}