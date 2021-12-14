<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<?php 
     $con = new mysqli('localhost','root','','quizmngmt') or die("Could not connect to database".mysqli_error($con));
     $db = mysqli_connect('localhost','root','','quizmngmt') or die("Could not connect to database");

?>
<?php 
    $qid=@$_GET['qid'];
    $qno = @$_GET['qNum'];
    $totalqns = @$_GET['totalqns'];
    $lmt = 1;
    $result =mysqli_query($con,"SELECT * FROM question WHERE quiz_id=".$qid." LIMIT ".$qno.",".$lmt." ");
    echo '<div class="panel" style="margin:5%"> 
    <form action = "p_quiz.php?q=res&option_id='.$optionid.'&tqns='.$totalqns.'&qnsid='.$qid.'" method="">';
    while($row = mysqli_fetch_array($result)) {
        $qns=$row['q_name'];
        $q_id=$row['question_id'];
        echo '<div class="form-group">
                <label>'.$q_id.'.'.$qns.'</label>
            </div>';
        $q=mysqli_query($con,"SELECT * FROM options WHERE question_id='$q_id'" );
        while($row=mysqli_fetch_array($q) ) {
            $option=$row['option_name'];
            $optionid=$row['option_id'];
            echo'<div class="form-check">
                    <input class="form-check-input" type="radio" name="answer" value="'.$optionid.'"/>
                    <label class="form-check-label">'.$option.'</label>
                </div>';
        }
    }
    echo '</form>';
    echo'<br/><button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span>&nbsp;Submit</button></form></div>';
?>

<?php if(@$_GET['q']== 'res') {
    $optnid = @$_GET['option_id'];
    $qndid = @$_GET['qnsid'];
    $a = mysqli_query($con,"SELECT * FROM answer WHERE question_id='$qndid'");
}

?>