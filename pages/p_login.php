<?php session_start();
    if(isset($_SESSION['username'])) {
        header('location: /Quiz_mngmt/pages/p_home.php');
    }
?>
<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset = "UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <title>Login-Quiz</title>
        <link rel = "stylesheet" type = "text/css" href = "..\css\login.css">
        <style type = "text/css">
            body {
                width : 100%;
                background : url('https://i.pinimg.com/originals/96/47/25/964725be8d25e328ff5cb44f9c37d31e.jpg');
                background-position : center;
                background-repeat : no-repeat;
                background-attachment: fixed;
                background-size: cover;
            }
        </style>
    </head>
    <body>
		<div class = "container-fluid">
            <div class = "row">
                <div class = "col-md-4 col-sm-4 col-xs-12"></div>
                <div class = "col-ms-4 col-sm-4 col-xs-12">
                <form class = "form-container" action = "../controllers/loginCheck.php" method = "POST">
                    <div class="form-group">
                        <h1 class = "text-center">Online Quiz System Login</h1>
                        <label for="username">UserName</label>
                        <input type="text" class="form-control" name="username" placeholder="Enter Your UserName">
                        </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter Your Password">
                    </div>
                    <div class="pull-right">
                        <label>
                            <p class = ""><a href="#" style = "color:red">forgot password</a></p>
                        </label>
                    </div>
                    <button type="submit" class="btn btn-success btn-block" name = "login_user">Submit</button>
                    <h4 class = "text-warning">Don't have an account? <a href="p_register.php" style = "color:blue">Register</a></h4>
                </form>
                </div>
                <div class = "col-md-4 sol-sm-4 col-xs-12"></div>
            </div>
        </div>
	</body>
</html>