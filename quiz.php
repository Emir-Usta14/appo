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

<div class="welcome">
Welcome <?php echo $_SESSION["username"]; ?>
</div>

<form action="results.php" method="POST">

<?php
$count = 1;

foreach($questions as $q){
?>

<div class="question-box">

<div class="question">
<?php echo $count . ". " . $q["question"]; ?>
</div>

<div class="answers">

<label class="answer-option">
<input type="radio" name="q<?php echo $count; ?>" value="A" required>
A. <?php echo $q["A"]; ?>
</label>

<label class="answer-option">
<input type="radio" name="q<?php echo $count; ?>" value="B">
B. <?php echo $q["B"]; ?>
</label>

<label class="answer-option">
<input type="radio" name="q<?php echo $count; ?>" value="C">
C. <?php echo $q["C"]; ?>
</label>

<label class="answer-option">
<input type="radio" name="q<?php echo $count; ?>" value="D">
D. <?php echo $q["D"]; ?>
</label>

</div>

<input
type="hidden"
name="correct<?php echo $count; ?>"
value="<?php echo $q["answer"]; ?>"
>

</div>

<?php
$count++;
}
?>

<button class="submit-btn" type="submit">
Submit Quiz
</button>

</form>

</div>

</body>
</html>
