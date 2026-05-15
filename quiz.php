<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

$questions = json_decode(file_get_contents("questions.json"), true);

shuffle($questions);

$questions = array_slice($questions, 0, 10);
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

<div id="timer">
Time Left: 5:00
</div>

<br>

<a href="index.php">
<button class="submit-btn">
Exit Quiz
</button>
</a>

<br><br>

<form action="results.php" method="POST">

<?php
foreach ($questions as $index => $q) {
?>

<div class="question-box">

<h2>
<?php echo ($index + 1) . ". " . htmlspecialchars($q["question"]); ?>
</h2>

<label class="option">

<input
type="radio"
name="answers[<?php echo $index; ?>]"
value="A"
required
>

A. <?php echo htmlspecialchars($q["A"]); ?>

</label>

<br>

<label class="option">

<input
type="radio"
name="answers[<?php echo $index; ?>]"
value="B"
>

B. <?php echo htmlspecialchars($q["B"]); ?>

</label>

<br>

<label class="option">

<input
type="radio"
name="answers[<?php echo $index; ?>]"
value="C"
>

C. <?php echo htmlspecialchars($q["C"]); ?>

</label>

<br>

<label class="option">

<input
type="radio"
name="answers[<?php echo $index; ?>]"
value="D"
>

D. <?php echo htmlspecialchars($q["D"]); ?>

</label>

<input
type="hidden"
name="correct_answers[<?php echo $index; ?>]"
value="<?php echo $q["answer"]; ?>"
>

</div>

<br>

<?php
}
?>

<button type="submit" class="submit-btn">
Submit Quiz
</button>

</form>

</div>

<script>

let timeLeft = 300;

const timer = document.getElementById("timer");

const countdown = setInterval(() => {

let minutes = Math.floor(timeLeft / 60);
let seconds = timeLeft % 60;

if(seconds < 10){
    seconds = "0" + seconds;
}

timer.innerHTML =
"Time Left: " + minutes + ":" + seconds;

timeLeft--;

if(timeLeft < 0){

clearInterval(countdown);

alert("Time is up!");

document.forms[0].submit();
}

}, 1000);

</script>

</body>
</html>
