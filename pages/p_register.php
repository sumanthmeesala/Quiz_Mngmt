<?php
    $existError = "username exists";
?>

<!DOCTYPE html>
<html lang = "en">
    <head>
        <title>Register-Quiz</title>
        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width:device-width, initial scale = 1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <link rel = "stylesheet" type = "text/css" href = "../css/register.css">
        <style type = "text/css">
            body {
                width : 100%;
                background : url('https://i.pinimg.com/originals/96/47/25/964725be8d25e328ff5cb44f9c37d31e.jpg');
                background-repeat : no-repeat;
                background-position : center;
                background-attachment : fixed;
                background-size : cover;
            }
        </style>
        <body>
            <div class = "container-fluid">
                <div class = "row">
                    <div class = "col-md-4 col-sm-4 col-xs-12"></div>
                    <div class = "col-md-4 col-sm-4 col-xs-12">
                        <form class="form-container" action="../controllers/createuser.php" method="POST">
                            <div class="form-group">
                                <h1 class = "text-center">Online Quiz System Register</h1>
                                <label for="UserName">UserName</label>
                                <input type="text" class="form-control" name="UserName" placeholder="Enter Your UserName">
                                <!-- <?php if(isset($existError)) { echo "<br><p class = 'alert alert-danger'>".$existError."</p>"; } ?> -->
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Enter Your Email">
                            </div>
                            <div class="form-group">
                                <label for="college">College</label>
                                <input type="text" class="form-control" name="college" placeholder="Enter Your college name">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Enter Your Password">
                            </div>
                            <button type = "submit" class = "btn btn-success btn-block">Register</button>
                            <h4 class = "text-warning">Already have an account? <a href = "p_login.php"> Login</a></h4>
                        <form>
                    </div>
                </div>
            </div>
        </body>
    </head>
</html>