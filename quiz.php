<?php
session_start();

if(!isset($_SESSION["username"])){
    header("Location: login.php");
    exit();
}

if(!isset($_SESSION["questions"])){

    $questions = json_decode(file_get_contents("questions.json"), true);

    shuffle($questions);

    $_SESSION["questions"] = array_slice($questions, 0, 10);
}

$questions = $_SESSION["questions"];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Quiz</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

<h1>Quiz Time</h1>

<h2 id="timer">
Time Left: 5:00
</h2>

<form action="results.php" method="POST">

<?php
$count = 1;

foreach($questions as $q){
?>

<div class="question-box">

<h3>
<?php echo $count . ". " . $q["question"]; ?>
</h3>

<?php
foreach($q["options"] as $answer){
?>

<label>

<input
type="radio"
name="question<?php echo $count; ?>"
value="<?php echo $answer; ?>"
required
>

<?php echo $answer; ?>

</label>

<br>

<?php
}
?>

<input
type="hidden"
name="correct<?php echo $count; ?>"
value="<?php echo $q["answer"]; ?>"
>

</div>

<br>

<?php
$count++;
}
?>

<button type="submit" class="submit-btn">
Submit Quiz
</button>

</form>

<br>

<a href="index.php">
<button class="submit-btn">
Exit Quiz
</button>
</a>

</div>

<script>

let time = 300;

const timer = document.getElementById("timer");

const countdown = setInterval(() => {

let minutes = Math.floor(time / 60);
let seconds = time % 60;

if(seconds < 10){
    seconds = "0" + seconds;
}

timer.innerHTML = "Time Left: " + minutes + ":" + seconds;

time--;

if(time < 0){

clearInterval(countdown);

alert("Time is up!");

document.forms[0].submit();
}

}, 1000);

</script>

</body>
</html>
