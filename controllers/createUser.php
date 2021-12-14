<?php 

session_start();

$username = "";
$email = "";

$errors = array();

$db = mysqli_connect('localhost','root','','quizmngmt') or die("Could not connect to database");



$username = mysqli_real_escape_string($db, $_POST['UserName']);
$email = mysqli_real_escape_string($db, $_POST['email']);
$college = mysqli_real_escape_string($db, $_POST['college']);
$password = mysqli_real_escape_string($db, $_POST['password']);

$user_check_query = "SELECT * FROM user where username = '$username' or email = '$email' LIMIT 1";

$result = mysqli_query($db,$user_check_query);
$user = mysqli_fetch_assoc($result);

if($user) {
    if($user['username'] === $username) {
        array_push($errors, "Username already exists!");
        echo "<center><h3><script>alert('Sorry This Username is already exists!! Try different Username');</script></h3></center>";
        header("refresh:0;url=/quiz_mngmt/pages/p_register.php");
    }
    if($user['email'] === $email) {array_push($errors, "Email already exist!");}
}

if(count($errors) == 0) {
    $password = md5($password);
    $query = "INSERT INTO user (username,email,college,password) VALUES ('$username','$email','$college','$password')";

    mysqli_query($db,$query);
	echo "<center><h3><script>alert('Congrats.. You have successfully registered !!');</script></h3></center>";
	header('location: P_welcome.php');
    $_SESSION['username'] = $username;
    $_SESSION['success'] = "You are loged in";
    header('location: ../pages/p_home.php');
    
}


?>