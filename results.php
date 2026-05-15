<?php
session_start();
include "db.php";

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

$score = 0;

if (
    isset($_POST["answers"]) &&
    isset($_POST["correct_answers"])
) {

    foreach ($_POST["answers"] as $index => $answer) {

        if (
            isset($_POST["correct_answers"][$index]) &&
            $answer == $_POST["correct_answers"][$index]
        ) {
            $score++;
        }
    }
}

$username = $_SESSION["username"];

$stmt = $conn->prepare("
    INSERT INTO scores (username, score)
    VALUES (?, ?)
");

$stmt->bind_param("si", $username, $score);

$stmt->execute();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Results</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

<h1>Your Score</h1>

<div class="question-box">

<h2>
You scored <?php echo $score; ?>/10
</h2>

</div>

<br><br>

<a href="quiz.php">
<button class="submit-btn">
Play Again
</button>
</a>

<br><br>

<a href="leaderboard.php">
<button class="submit-btn">
Leaderboard
</button>
</a>

<br><br>

<a href="logout.php">
<button class="submit-btn">
Logout
</button>
</a>

</div>

</body>
</html>
