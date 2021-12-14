<?php
    session_start();

if(isset($_POST['login_user'])) {
    $errors = array();

    $db = mysqli_connect('localhost','root','','quizmngmt') or die("could not connect to data base");

    $username = mysqli_real_escape_string($db,$_POST['username']);
    $password = mysqli_real_escape_string($db,$_POST['password']);

    if(empty($username)) {
        array_push($errors,"Username is required");
        echo "<script>alert('UserName is required')</script>";
        header('refresh:0;url=/quiz_mngmt/pages/p_login.php');
    }
    if(empty($password)) {
        array_push($errors,"Password is required");
        echo "<script>alert('Password is required')</script>";
        header('refresh:0;url=/quiz_mngmt/pages/p_login.php');
    }

    if(count($errors) == 0) {
        $password = md5($password);
        $get_query = "SELECT * FROM user WHERE username = '$username' AND password = '$password' ";
        $result = mysqli_query($db,$get_query);

        if(mysqli_num_rows($result)) {
            $_SESSION['username'] = $username;
            header('location: /Quiz_mngmt/pages/p_home.php');
        }
        else {
            array_push($errors,"Wrong userName/Password Try again");
            echo '<h2><script>alert("Wrong Credentials! Try again!")</script></h2>';
            header('refresh:0;url=/quiz_mngmt/pages/p_login.php');
        }
    }
}

?>