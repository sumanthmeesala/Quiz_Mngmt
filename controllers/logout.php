<?php
    session_start();
    session_destroy();
    if($_GET['type'] == 'admin') {
        header('location: /Quiz_mngmt/pages/p_admin.php');
    } else {
        header('location: /Quiz_mngmt/pages/p_login.php');
    }
?>