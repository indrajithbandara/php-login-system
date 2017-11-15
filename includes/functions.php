<?php 
require 'core/db.php';

//Testing input on forms
function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

// Random string
function rand_str($length) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";  
    $size = strlen( $chars );
    $str = "";
    for( $i = 0; $i < $length; $i++ ) {
        $str .= $chars[ rand( 0, $size - 1 ) ];
    }
    return $str;
}

// Router
function Redirect($url, $permanent = false) {
    header('Location: ' . $url, true, $permanent ? 301 : 302);
    exit();
}

// Gets the user after their logged in
function getUser(){
    global $conn;
    try{
        if (isset($_SESSION['user_id']) ) {
            $records = $conn->prepare('SELECT user_id,user_name,first_name,last_name,email FROM users WHERE user_id=:user_id');
            $records->bindParam(':user_id', $_SESSION['user_id'] );
            $records->execute();
            $results = $records->fetch(PDO::FETCH_ASSOC);
            $user = NULL;
            if(count($results) > 0) {
                return $results;
            }
        }  
    }catch(PDOException $e) {
        die("User counld not be found: " . $e->getMessage());
    }
}

// Checks if the given login information returns any results
function checkLogin(){
    global $conn;
    try{
        $records = $conn->prepare('SELECT user_id,email,password FROM users WHERE email=:email');
        $records->bindParam(':email', $_POST['email']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);
        return $results;
    }catch(PDOException $e) {
        return [];
    }
}

// create user
function createUser($post){
    global $conn;
    try{
        $sql = "INSERT INTO users (first_name, last_name, user_name, email, password) VALUES (:fname, :lname, :uname, :email, :password)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':fname', $post['first_name']);
        $stmt->bindParam(':lname', $post['last_name']);
        $stmt->bindParam(':uname', $post['user_name']);
        $stmt->bindParam(':email', $post['email']);
        $stmt->bindParam(':password', password_hash($post['password'], PASSWORD_BCRYPT));
        $stmt->execute();
        return 1;
    }catch(PDOException $e) {
        die('Something went wrong when creating account:' . $e->getMessage());
    }
}

// If user is already logged in, redirect to index page.
function checkSession(){
    if(isset($_SESSION['user_id']) ) {
        Redirect('index.php', false);
    }
}