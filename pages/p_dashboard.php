<?php session_start(); ?>
<?php 
     $con = new mysqli('localhost','root','','quizmngmt') or die("Could not connect to database".mysqli_error($con));

     $db = mysqli_connect('localhost','root','','quizmngmt') or die("Could not connect to database");
?>

<?php
    if(!(isset($_SESSION['admin_username'])))
    {
        header("location:p_admin.php");
    }
    else
    {
        $name = $_SESSION['admin_username'];
    }
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
        <title>Welcome Admin</title>
    </head>
    <body>
    <nav class = "navbar navbar-expand-sm navbar-dark bg-dark">
            <a href = "p_dashboard.php?a=1" class = "navbar-brand">Online Quiz System</a>
            <button class = "navbar-toggler" data-toggle="collapse" data-target="#navbarMenu">
                <span class = "navbar-toggler-icon"></span>
            </button>
                <div class="collapse navbar-collapse" id="navbarMenu">
                        <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="p_dashboard.php?a=1" class="nav-link"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbsp;Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="p_dashboard.php?a=2" class="nav-link"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;Users</a>
                        </li>
                        <li class="nav-item">
                            <a href="p_dashboard.php?a=5" class="nav-link"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span>&nbsp;Ranking</a>
                        </li>
                        <li class="nav-item">
                            <a href="p_dashboard.php?a=3" class="nav-link"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;Add Quiz</a>
                        </li>
                        <li class="nav-item">
                            <a href="p_dashboard.php?a=4" class="nav-link"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>&nbsp;Remove Quiz</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav navbar-right">
                        <li class = "nav-item">
                            <a href = "/Quiz_mngmt/controllers/logout.php?type=admin" class = "nav-link"><span class="glyphicon glyphicon-log-out"></span>Logout</a>
                        </li>
                    </ul>
                </div>
        </nav>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php if(@$_GET['a'] == 1) {
                        echo '<h3 style="color:green">Welcome Admin!
                            The Quizes You posted are!</h3>';
                        $result = mysqli_query($con,"SELECT * FROM quiz") or die('error');
                        echo '<div class="panel"><div class="table-responsive"><table class="table table-striped title1">
                        <tr style="color:blue"><td><center><b>S.N.</b></center></td><td><center><b>Title</b></center></td><td><center><b>Total Marks</b></center></td><td><center><b>Start Time</center></b></center></td><td><center><b>End Time</center></b></center></td><td><center><b>Time Limit</center></b></td></tr>';
                        while($row = mysqli_fetch_array($result)) {
                            $qid = $row['q_id'];
                            $title = $row['q_name'];
                            $tot_mar = $row['tot_marks'];
                            $start_time = $row['strat_time'];
                            $end_time = $row['end_time'];
                            $time_limit = $row['time_limit'];
                            echo '<tr><td><center>'.$qid.'</center></td><td><center>'.$title.'</center></td><td><center>'.$tot_mar.'</center></td><td><center>'.$start_time.'</center></td><td><center>'.$end_time.'</center></td><td><center>'.$time_limit.'</center></td></tr>';
                        }
                    }
                    ?>
                    
                    <?php if(@$_GET['a'] == 2) {
                        $result = mysqli_query($con,"SELECT * FROM user") or die('error');
                        echo '<div class="panel"><div class="table-responsive"><table class="table table-striped title1">
                        <tr style="color:blue"><td><center><b>UserID</b></center></td><td><center><b>UserName</b></center></td><td><center><b>Email</b></center></td><td><center><b>College</center></b></center><td><center><b>Action</center></b></center></tr>';
                        $id = 1;
                        while($row = mysqli_fetch_array($result)) {
                            $username = $row['username'];
                            $email = $row['email'];
                            $college = $row['college'];
                            echo '<tr><td><center><b>'.$id++.'</b></center></td><td><center><b>'.$username.'</b></center></td><td><center><b>'.$email.'</b></center></td><td><center><b>'.$college.'</b></center></td><td><center><b><a href="p_dashboard.php?delete=3&eid='.$username.'"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></b></center></td></tr>';
                        }
                        echo '</table></div></div>';
                    }
                    ?>

                    <?php if(@$_GET['delete'] == 3) {
                        $eid=@$_GET['eid'];
                        $r5 = mysqli_query($con,"DELETE FROM rank WHERE username = '$eid'") or die('ERROR');
                        $r3 = mysqli_query($con,"DELETE FROM history WHERE username = '$eid'") or die('ERROR');
                        $r1 = mysqli_query($con,"DELETE FROM user WHERE username='$eid' ") or die('Error');
                        header("location: /Quiz_mngmt/pages/p_dashboard.php?a=2");
                    }
                    ?>

                    <?php if(@$_GET['a'] == 3) {
                        echo '<div class = "container-fluid">
                        <div class = "row">
                            <div class = "col-md-4 col-sm-4 col-xs-12"></div>
                            <div class = "col-ms-4 col-sm-4 col-xs-12">
                            <form class = "form-container" action = "../controllers/createQuiz.php?t_q" method = "POST">
                                <div class="form-group">
                                    <h1 class = "text-center">Enter Quiz Details</h1>
                                    <input type="text" class="form-control" name="qu_name" placeholder="Enter Quiz Name">
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control" name="t_marks" placeholder="Enter Total Marks">
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control" name="total_questions" placeholder="Enter Total Questions in Quiz">
                                </div>
                                <div class="form-group">
                                    <input type="datetime-local" class="form-control" name="s_time" placeholder="Enter Quiz Start Time">
                                </div>
                                <div class="form-group">
                                    <input type="datetime-local" class="form-control" name="e_time" placeholder="Enter Quiz end Time">
                                </div>
                                <div class="form-group">
                                    <input type="time" class="form-control" name="t_duration" placeholder="Enter Quiz end Time">
                                </div>
                                
                                <button type="submit" class="btn btn-success btn-block" name = "d_dashboard.php?a=6">Submit</button>
                            </form>
                            </div>
                            <div class = "col-md-4 sol-sm-4 col-xs-12"></div>
                        </div>
                    </div>';
                    }

                    ?>
                    
                    <?php if(@$_GET['a'] == 4) {
                        $result = mysqli_query($con,"SELECT * FROM quiz") or die('error');
                        echo '<div class="panel"><div class="table-responsive"><table class="table table-striped title1">
                        <tr style="color:blue"><td><center><b>S.N.</b></center></td><td><center><b>Title</b></center></td><td><center><b>Total Marks</b></center></td><td><center><b>Start Time</center></b></center></td><td><center><b>End Time</center></b></center></td><td><center><b>Time Limit</center></b></td><td><center><b>Action</b></center></td></tr>';
                        while($row = mysqli_fetch_array($result)) {
                            $qid = $row['q_id'];
                            $title = $row['q_name'];
                            $tot_mar = $row['tot_marks'];
                            $start_time = $row['strat_time'];
                            $end_time = $row['end_time'];
                            $time_limit = $row['time_limit'];
                            echo '<tr><td><center>'.$qid.'</center></td><td><center>'.$title.'</center></td><td><center>'.$tot_mar.'</center></td><td><center>'.$start_time.'</center></td><td><center>'.$end_time.'</center></td><td><center>'.$time_limit.'</center></td><td><center><a href = "p_dashboard.php?qid='.$qid.'" class="pull-right btn sub1" style="margin:0px;background:red;color:black"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Remove</b></span></a></center></td></tr>';
                        }
                    }
                    ?>

                    <?php if(@$_GET['qid']) {
                        $qid = @$_GET['qid'];
                        $r9 = mysqli_query($con,"SELECT * FROM question WHERE quiz_id = '$qid'") or die('ERROR1');
                        while($row = mysqli_fetch_array($r9)) {
                            $qnsid = $row['question_id'];
                            $r9 = mysqli_query($con, "DELETE FROM history WHERE quiz_id = '$qid'") or die('ERROR');
                            $r8 = mysqli_query($con,"DELETE FROM answer WHERE question_id = '$qnsid'") or die('ERROR2');
                            $r7 = mysqli_query($con,"DELETE FROM options WHERE question_id ='$qnsid' ") or die('ERROR');
                            $r2 = mysqli_query($con,"DELETE FROM question WHERE question_id ='$qnsid' ") or die('ERROR3');
                        }
                        $r1 = mysqli_query($con,"DELETE FROM quiz WHERE q_id='$qid' ") or die('Error');
                        header("location: /Quiz_mngmt/pages/p_dashboard.php?a=4");
                    } 
                    ?>

                    <?php if(@$_GET['t_q']) {
                        echo '
                        <div class="row">
                        <span class="title1" style="margin-left:35%;font-size:30px;"><b>Enter Question Details</b></span><br /><br />
                        <div class="col-md-3"></div><div class="col-md-6"><form class="form-horizontal title1" name="form" action="p_dashboard.php?q=addqns"  method="POST">
                        <fieldset>';

                        for($i = 1; $i <= @$_GET['t_q']; $i++) {
                            echo '<b>Question number&nbsp;'.$i.'&nbsp;:</><br /><!-- Text input-->
                                    <div class="form-group">
                                        <label class="col-md-12 control-label" for="qns'.$i.' "></label>  
                                        <div class="col-md-12">
                                            <textarea rows="3" cols="5" name="qns'.$i.'" class="form-control" placeholder="Write question number '.$i.' here..."></textarea>  
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 control-label" for="'.$i.'1"></label>  
                                        <div class="col-md-12">
                                            <input id="'.$i.'1" name="'.$i.'1" placeholder="Enter option a" class="form-control input-md" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 control-label" for="'.$i.'2"></label>  
                                        <div class="col-md-12">
                                            <input id="'.$i.'2" name="'.$i.'2" placeholder="Enter option b" class="form-control input-md" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 control-label" for="'.$i.'3"></label>  
                                        <div class="col-md-12">
                                            <input id="'.$i.'3" name="'.$i.'3" placeholder="Enter option c" class="form-control input-md" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 control-label" for="'.$i.'4"></label>  
                                        <div class="col-md-12">
                                            <input id="'.$i.'4" name="'.$i.'4" placeholder="Enter option d" class="form-control input-md" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 control-label" for="'.$i.'5"></label>  
                                        <div class="col-md-12">
                                            <input id="'.$i.'5" name="'.$i.'5" placeholder="Enter Marks for this Question" class="form-control input-md" type="number">
                                        </div>
                                    </div>
                                    <br />
                                    <b>Correct answer</b>:<br />
                                    <select id="ans'.$i.'" name="ans'.$i.'" placeholder="Choose correct answer " class="form-control input-md" >
                                    <option value="a">Select answer for question '.$i.'</option>
                                    <option value="a"> option a</option>
                                    <option value="b"> option b</option>
                                    <option value="c"> option c</option>
                                    <option value="d"> option d</option> </select><br /><br />'; 
                        }
                        echo '<input type="hidden" name="q_id" value="'.$_GET["q_id"].'">
                             <input type="hidden" name="t_q" value="'.$_GET["t_q"].'">
                            <div class="form-group">
                                <label class="col-md-12 control-label" for=""></label>

                                <div class="col-md-12"> 
                                    <input  type="submit" style="margin-left:45%" class="btn btn-primary" value="Submit" class="btn btn-primary"/>
                                </div>
                              </div>

                        </fieldset>
                        </form></div>';
                        }
                    ?>

                    <?php 
                        if(@$_GET['q'] == 'addqns') {
                            $n=@$_POST['t_q'];
                            $qid = @$_POST['q_id'];

                            for($i = 1; $i <= $n; $i++) {
                                $q_name = $_POST['qns'.$i.''];
                                $q_marks = $_POST[''.$i.'5'];
                                $q3=mysqli_query($con,"INSERT INTO question(quiz_id,q_name,q_marks) VALUES(".$qid.",'".$q_name."' , ".$q_marks.")");
                                $last_id = $con->insert_id;
                                $oaid=uniqid();
                                $obid=uniqid();
                                $ocid=uniqid();
                                $odid=uniqid();
                                $a=$_POST[$i.'1'];
                                $b=$_POST[$i.'2'];
                                $c=$_POST[$i.'3'];
                                $d=$_POST[$i.'4'];

                                $questionId = mysqli_insert_id($con);

                                $qa=mysqli_query($con,"INSERT INTO options VALUES(".$questionId.",'".$oaid."','".$a."')") or die('Error61');
                                $qb=mysqli_query($con,"INSERT INTO options VALUES(".$questionId.",'".$obid."','".$b."')") or die('Error61');
                                $qc=mysqli_query($con,"INSERT INTO options VALUES(".$questionId.",'".$ocid."','".$c."')") or die('Error61');
                                $qd=mysqli_query($con,"INSERT INTO options VALUES(".$questionId.",'".$odid."','".$d."')") or die('Error61');
                                
                                $e=$_POST['ans'.$i];
                                switch($e) {
                                    case 'a': $ansid=$oaid; break;
                                    case 'b': $ansid=$obid; break;
                                    case 'c': $ansid=$ocid; break;
                                    case 'd': $ansid=$odid; break;
                                    default: $ansid=$oaid;
                                }
                                $qans=mysqli_query($con,"INSERT INTO answer VALUES  ('$questionId','$ansid')");
                            }
                            echo "<center><h3><script>alert('Quiz added Successfully');</script></h3></center>";
                            header("refresh:0;url=/quiz_mngmt/pages/p_dashboard.php?a=1");
                        }
                    ?>

                    <?php if(@$_GET['a'] == 5) {
                        echo '<div class="panel title"><div class="table-responsive">
                        <table class="table table-striped title1">
                        <tr style="color:red"><td><center><b>Rank</b></center></td><td><center><b>Name</b></center></td><td><center><b>Email</b></center></td><td><center><b>Score</b></center></td></tr>';
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

                </div>
            </div>
        </div>
    </body>
</html>