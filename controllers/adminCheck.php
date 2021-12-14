<?php
session_start();

if(isset($_POST['admin_login'])) {
    $errors = array();

    $db = mysqli_connect('localhost','root','','quizmngmt') or die("could not connect to data base");

    $username = mysqli_real_escape_string($db,$_POST['username']);
    $password = mysqli_real_escape_string($db,$_POST['password']);

    if(empty($username)) {
        array_push($errors,"Username is required");
    }
    if(empty($password)) {
        array_push($errors,"Password is required");
    }

    if(count($errors) == 0) {
        $get_query = "SELECT * FROM admin WHERE admin_username = '$username' AND password = '$password' ";
        $result = mysqli_query($db,$get_query);

        if(mysqli_num_rows($result)) {
            $_SESSION['admin_username'] = $username;
            header('location: /Quiz_mngmt/pages/p_dashboard.php?a=1');
        }
        else {
            array_push($errors,"Wrong userName/Password Try again");
            echo "<h2><script>alert('Wrong userName/Password Try again')</script></h2>";
            header('refresh:0;url=/quiz_mngmt/pages/p_admin.php');
        }
    }
}

?>