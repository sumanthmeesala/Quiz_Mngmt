<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Quiz Management | Quiz</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <?php 
        $connection = new mysqli('localhost','root','','quizmngmt') or die("Could not connect to database".mysqli_error($con));
        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            $quizId = @$_GET['qid'];
        }
        $qName = mysqli_fetch_array(mysqli_query($connection, "SELECT q_name FROM quiz WHERE q_id=".$quizId.""))['q_name'];
        $questions = mysqli_query($connection, "SELECT * FROM question WHERE quiz_id=".$quizId."");
    ?>
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
                    <?php echo $qName; ?>
                </h4>
            </div>
        </nav>

        <form action="/Quiz_mngmt/controllers/c_result.php?" method="post">
            <div class="row border border-info">
                <?php 
                    for($index = 0; $question = mysqli_fetch_array($questions); $index++) {
                        $options = mysqli_query($connection, 'SELECT * FROM options WHERE question_id='.$question["question_id"].'');
                        echo '
                        <div class="col-9 mt-3 mb-3" id="questionNumber'.$index.'" onblur="alert(\'I am question number - '.($index + 1).' \');">
                            <div class="card bg-dark text-white border-0"
                                    style="min-height: 23rem; max-height: 23rem; overflow-y: auto;">
                                <div class="card-header bg-dark border-0">
                                    <h5 class="float-left">
                                        <span class="text-secondary">Q'.($index + 1).'.</span>
                                        <span>'.$question["q_name"].'</span>
                                    </h5>
                                </div>
                                <div class="card-body border-0" style="min-height: 15rem; max-height: 15rem; overflow-y: auto;">';
                                    while($option = mysqli_fetch_array($options)) {
                                        echo '
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio"
                                                name="'.$question["question_id"].'"
                                                value="'.$option["option_id"].'" />
                                            <label class="form-check-label">'.$option["option_name"].'</label>
                                        </div>';
                                    };
                                echo '
                                </div>
                                <div class="card-footer bg-dark border-0">';
                                    if($index == 0) {
                                        echo '<botton class="btn btn-primary float-left btn-sm mb-2 disabled">Previous Question</botton>';
                                    } else {
                                        echo '<botton class="btn btn-primary float-left btn-sm mb-2" onclick="showQuestion('.($index - 1).')">
                                        Previous Question</botton>';
                                    }
                                    if($index + 1 == mysqli_num_rows($questions)) {
                                        echo '<botton class="btn btn-primary float-right btn-sm mb-2 disabled">Next Question</botton>';
                                    } else {
                                        echo '<botton class="btn btn-primary float-right btn-sm mb-2" onclick="showQuestion('.($index + 1).')">
                                        Next Question</botton>';
                                    }
                                echo '
                                </div>
                            </div>
                        </div>';
                    }
                    
                    echo '
                    <div class="col-3 mt-3 mb-3 border-info border-left border-top-0 border-right-0 border-bottom-0">
                        <div class="card bg-dark text-white border-0">
                            <div class="card-body" style="min-height: 22rem; max-height: 22rem; overflow-y: auto;">';
                                for($index = 0; $index < mysqli_num_rows($questions); $index++) {
                                    echo ' <button type="button" class="btn btn-secondary mb-2" id="btnQuestionNumber'.$index.'"
                                    onclick="showQuestion('.$index.')">'.($index + 1).'</button>';
                                }
                            echo '
                            </div>
                        </div>
                    </div>'

                    ?>
                <div class="col">
                    <div class="card bg-dark border-0 ">
                        <div class="card-footer bg-dark border-info text-right">
                            <div class="text-secondary">
                                <small>DON'T SUBMIT UNLESS YOU FINISH WITH THE QUIZ. SUBMITTED
                                    ANSWERS will be the FINAL ANSWERS.</small>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary btn-sm pl-5 pr-5">Submit Quiz</botton>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <script>
        $('[id^="questionNumber"]').hide();
        $('#questionNumber0').show();
        $('[id^="btnQuestionNumber"]').removeClass('btn-outline-primary');
        $('#btnQuestionNumber0').addClass('btn-outline-primary');

        function showQuestion(questionNumber) {
            $('[id^="questionNumber"]').hide();
            $('#questionNumber' + questionNumber).show();
            $('[id^="btnQuestionNumber"]').removeClass('btn-outline-primary');
            $('#btnQuestionNumber' + questionNumber).addClass('btn-outline-primary');
        }
    </script>
</body>

</html>