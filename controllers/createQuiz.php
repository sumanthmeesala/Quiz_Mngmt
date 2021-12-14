<?php 

session_start();

$username = "";
$email = "";

$errors = array();

$db = mysqli_connect('localhost','root','','quizmngmt') or die("Could not connect to database");


$quizname = mysqli_real_escape_string($db, $_POST['qu_name']);
$totalMarks = mysqli_real_escape_string($db, $_POST['t_marks']);
$starttime = mysqli_real_escape_string($db, $_POST['s_time']);
$endtime = mysqli_real_escape_string($db, $_POST['e_time']);
$timeduration = mysqli_real_escape_string($db, $_POST['t_duration']);
$tot_qstns = mysqli_real_escape_string($db, $_POST['total_questions']);

if($quiz) {
    if($quiz['q_name'] === $quizname) {array_push($errors, "Quiz already exists!");}
}

if(count($errors) == 0) {
    $query = "INSERT INTO quiz(q_name,tot_marks, strat_time, end_time, time_limit, total_questions) VALUES ('$quizname','$totalMarks','$starttime', '$endtime', '$timeduration', '$tot_qstns')";

    mysqli_query($db,$query);
    $_SESSION['success'] = "Quiz added successfully";
    echo 'Quiz Added successfully';
    header('location: ../pages/p_dashboard.php?t_q='.$tot_qstns.'&q_id='.mysqli_insert_id($db).'');
    
}


?>