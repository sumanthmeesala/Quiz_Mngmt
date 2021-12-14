<?php 
    session_start();
    $connection = new mysqli('localhost','root','','quizmngmt') or die("Could not connect to database".mysqli_error($con));

    $score = 0;
    $questionId = @$_GET['question_id'];
    foreach($_POST as $questionId => $answerId) {
        $answer = mysqli_fetch_array(mysqli_query($connection, "SELECT answer_id FROM `answer` where question_id=".$questionId.""))['answer_id'];
        if($answer == $answerId) {
            $score++;
        }
    }
    $getQuizId = mysqli_query($connection, "SELECT quiz_id FROM question WHERE question_id=".$questionId."");
    $row = mysqli_fetch_array($getQuizId);
    $quizId = $row[0];
    $username1 = $_SESSION["username"];
    $history = mysqli_query($connection, "INSERT INTO history(username, quiz_id, score) VALUES ('$username1','$quizId','$score');");

    if($row5 = mysqli_fetch_array(mysqli_query($connection,"SELECT total_score FROM rank where username = '$username1'"))) {
        $total_score1 = $row5[0] + $score;
        $r0 = mysqli_query($connection,"UPDATE rank SET total_score = $total_score1 WHERE username = '$username1'");
    }
    else {
        $r1 = mysqli_query($connection, "INSERT INTO rank VALUES('$username1','$score');");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Quiz Management | Quiz</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body class="bg-dark">
    <div class="container mb-4">
        <nav class="navbar navbar-expand-sm mb-2 mt-3 navbar-dark bg-dark sticky-top">
            <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarMenuToggle">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarMenuToggle">
                <a class="navbar-brand text-info font-italic" href="#">Quiz Management</a>
                <h4 class="navbar-text mx-auto text-white">
                    Your Results
                </h4>
            </div>
        </nav>
            <h4 class="navbar-text mx-auto text-success">
                Your Score is: <?php echo $score; ?>
            </h4>
            <div>
                <a href="/quiz_mngmt/pages/p_home.php" class="btn btn-primary btn-md active" role="button" aria-pressed="true">Back to Home</a>
            </div>
    </div>
</body>