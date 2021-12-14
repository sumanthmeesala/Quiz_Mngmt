<?php 
    session_start();
    if(!isset($_SESSION['username'])) {
        header('location: /Quiz_mngmt/pages/p_login.php');
    }

    $con = new mysqli('localhost','root','','quizmngmt') or die("Could not connect to database".mysqli_error($con));
    $db = mysqli_connect('localhost','root','','quizmngmt') or die("Could not connect to database");
?>


<DOCTYPE html>
<html lang = "en">
    <head>
        <meta name = "viewport" content = "width:device-width, initial-scale=1.0">
        <link rel = "stylesheet" type= "text/css" href = "../css/home.css"> 
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
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
        <title>Onlie Quiz | Welcome</title>
    </head>
    <body>
        <nav class = "navbar navbar-expand-sm navbar-dark bg-dark">
            <a href = "p_home.php" class = "navbar-brand">Online Quiz System</a>
            <button class = "navbar-toggler" data-toggle="collapse" data-target="#navbarMenu">
                <span class = "navbar-toggler-icon"></span>
            </button>
                <div class="collapse navbar-collapse" id="navbarMenu">
                        <ul class="navbar-nav">
                        <li class="nav-item">
                            <?php if(@$_GET['q']==0) ?><a href="p_home.php?q=0" class="nav-link"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbsp;Home</a>
                        </li>
                        <li class="nav-item">
                            <?php if(@$_GET['q']==2) ?><a href="p_home.php?q=2" class="nav-link"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>&nbsp;History</a>
                        </li>
                        <li class="nav-item">
                            <?php if(@$_GET['q']==1) ?><a href="p_home.php?q=1" class="nav-link"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span>&nbsp;Ranking</a>
                        </li>
                        <li class="nav-item">
                            <?php if(@$_GET['q']==24) ?><a href="p_home.php?q=24" class="nav-link"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;Profile</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav navbar-right">
                        <li class = "nav-item">
                            <a href = "/Quiz_mngmt/controllers/logout.php" class = "nav-link"><span class="glyphicon glyphicon-log-out"></span>Logout</a>
                        </li>
                    </ul>
                </div>
        </nav>
        <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php if(@$_GET['q'] == 0) {
                    $username1 = $_SESSION["username"];
                    $result = mysqli_query($con,"SELECT * FROM quiz ORDER BY strat_time DESC") or die('error');
                    echo '<div class="panel"><div class="table-responsive"><table class="table table-striped title1">
                    <tr style="color:blue"><td><center><b>S.N.</b></center></td><td><center><b>Title</b></center></td><td><center><b>Total Marks</b></center></td><td><center><b>Start Time</center></b></center></td><td><center><b>End Time</center></b></center></td><td><center><b>Time Limit</center></b></td><td><center><b>Action</b></center></td></tr>';
                    $i = 1;
                    while($row = mysqli_fetch_array($result)) {
                        $quizid = $row['q_id'];
                        $totalquestions = $row['total_questions'];
                        $title = $row['q_name'];
                        $tot_mar = $row['tot_marks'];
                        $start_time = $row['strat_time'];
                        $end_time = $row['end_time'];
                        $time_limit = $row['time_limit'];
                        $q12=mysqli_query($con,"SELECT score FROM history WHERE username='$username1' AND quiz_id='$quizid'")or die('Error98');
                        $rowcount=mysqli_num_rows($q12);
                        $row = mysqli_fetch_array($q12);
                        $score = $row[0];
                        if($rowcount == 0){
                            echo '<tr><td><center>'.$i++.'</center></td><td><center>'.$title.'</center></td><td><center>'.$tot_mar.'</center></td><td><center>'.$start_time.'</center></td><td><center>'.$end_time.'</center></td><td><center>'.$time_limit.'</center></td><center><td><a class="btn btn-primary" href="p_quiz.php?qid='.$quizid.'&qNum=0&totalqns='.$totalquestions.'" role="button"><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>&nbsp;Click to Start</a></td></center></tr>';
                        }
                        else {
                            echo '<tr><td><center>'.$i++.'</center></td><td><center>'.$title.'</center></td><td><center>'.$tot_mar.'</center></td><td><center>'.$start_time.'</center></td><td><center>'.$end_time.'</center></td><td><center>'.$time_limit.'</center></td><center><td><a class="btn btn-danger disabled" href="p_quiz.php?qid='.$quizid.'&qNum=0&totalqns='.$totalquestions.'" role="button"><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>&nbsp;Quiz Completed!</a></td></center></tr>';
                        }
                    }

                } 

                echo '</table></div></div>'
                ?>

                <?php if(@$_GET['q'] == 1) {
                    echo '<div class="panel title"><div class="table-responsive">
                    <table class="table table-striped title1">
                    <tr style="color:red"><td><center><b>Rank</b></center></td><td><center><b>Name</b></center></td><td><center><b>Email</b></center></td><td><center><b>Score</b></center></td></tr>';
                    $username3 = $_SESSION['username'];
                    $users = mysqli_query($con,"SELECT * FROM rank ORDER BY total_score desc");
                    $i = 1;
                    while($row = mysqli_fetch_array($users)) {
                        $uname = $row['username'];
                        $totscore = $row['total_score'];
                        $us = mysqli_query($con, "SELECT username,email FROM user WHERE username = '$uname'");
                        $row2 = mysqli_fetch_array($us);
                        $unm = $row2[0];
                        $umail = $row2[1];
                        echo '<tr><td><center><b>'.$i++.'</b></center></td><td><center><b>'.$unm.'</b></center></td><td><center><b>'.$umail.'</b></center></td><td><center><b>'.$totscore.'</b></center></td></tr>';
                    }
                    echo '</table></div>';
                }
                ?>
                
                <?php if(@$_GET['q'] == 2) 
                {
                    echo  '<div class="panel title">
                    <table class="table table-striped title1" >
                    <tr style="color:green;"><td><center><b>S.N.</b></center></td><td><center><b>Quiz</b></center></td><td><center><b>Total Score</b></center></td><td><center><b>Your Score</b></center></td>';
                    $username1 = $_SESSION["username"];
                    $i = 1;
                    $h1 = mysqli_query($con,"SELECT quiz_id FROM history WHERE username = '$username1'");
                    while($row1 = mysqli_fetch_array($h1)) {
                        $qid = $row1['quiz_id'];
                        $qnm = mysqli_query($con,"SELECT q_name,total_questions FROM quiz WHERE q_id = $qid");
                        while($row2 = mysqli_fetch_array($qnm)) {
                            $qname = $row2['q_name'];
                            $totmarks = $row2['total_questions'];
                            $sce = mysqli_query($con,"SELECT score FROM history WHERE username='$username1' and quiz_id=$qid");
                        $row2 = mysqli_fetch_array($sce);
                        $score = $row2[0];
                        echo '<tr><td><center><b>'.$i++.'</b></center></td><td><center><b>'.$qname.'</b></center></td><td><center><b>'.$totmarks.'</b></center></td><td><center><b>'.$score.'</b></center></td>';
                        }

                    }
                    
                }
                ?>

                <?php if(@$_GET['qu'] == 10 && @$_GET['step']== 2) 
                {
                        $qid=@$_GET['qid'];
                        $sn=@$_GET['n'];
                        $totques=@$_GET['totques'];
                        $result =mysqli_query($con,"SELECT * FROM question WHERE quiz_id=".$qid."");
                        echo '<div class="panel" style="margin:5%">';
                        while($row = mysqli_fetch_array($result)) {
                            $qns=$row['q_name'];
                            $q_id=$row['question_id'];
                            echo '<b>Question &nbsp;'.$sn.'&nbsp;::<br /><br />'.$qns.'</b><br />';
                        }
                        $q=mysqli_query($con,"SELECT * FROM options WHERE question_id='$q_id' " );
                        echo '<form action="update.php?q=quiz&step=2&eid='.$q_id.'&n='.$sn.'&t='.$totalquestions.'&qid='.$qid.'" method="POST"  class="form-horizontal">
                        <br />';
                        while($row=mysqli_fetch_array($q) ) {
                            $option=$row['option_name'];
                            $optionid=$row['option_id'];
                            echo'<input type="radio" name="ans" value="'.$optionid.'">&nbsp;'.$option.'<br /><br />';
                        }
                        echo'<br /><button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span>&nbsp;Submit</button></form></div>';
                    }
                ?>

                <?php if(@$_GET['q'] == 24) {
                    $username4 = $_SESSION["username"];
                    $users = mysqli_query($con,"SELECT * FROM user WHERE username = '$username4'");
                    while($row = mysqli_fetch_array($users)) {
                        $usrname = $row['username'];
                        $mail = $row['email'];
                        $clg = $row['college'];
                        echo '
                                <form class="text-primary">
                                <h1 class="text-success">Hello <i>'.$usrname.'<i></h1>
                                <div class="form-group row">
                                    <label for="staticusername" class="col-md-2 col-form-label">UserName</label>
                                    <div class="col-md-10">
                                        <input type="text" readonly class="form-control-plaintext text-info" id="staticEmail" value="'.$usrname.'">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="text" readonly class="form-control-plaintext text-info" id="staticEmail" value="'.$mail.'">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticclg" class="col-sm-2 col-form-label">College</label>
                                    <div class="col-sm-10">
                                        <input type="text" readonly class="form-control-plaintext text-info" id="staticEmail" value="'.$clg.'">
                                    </div>
                                </div>
                            
                            </form>';
                    }
                }
                ?>

            </div>
        </div>
        </div>
    </body>
</html>