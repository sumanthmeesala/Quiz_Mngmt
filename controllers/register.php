
<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        include 'welcome.php';
    } else if($_SERVER['REQUEST_METHOD'] === 'GET') {
        include 'pages/p_register.php';
    }
?>
