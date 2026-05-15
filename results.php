<?php
session_start();
include "db.php";

if(!isset($_SESSION["username"])){
    header("Location: login.php");
    exit();
}

$score = 0;

for($i = 1; $i <= 10; $i++){

    if(
        isset($_POST["question$i"]) &&
        $_POST["question$i"] == $_POST["correct$i"]
    ){
        $score++;
    }
}

$username = $_SESSION["username"];

$stmt = $conn->prepare("
    INSERT INTO scores (username, score)
    VALUES (?, ?)
");

$stmt->bind_param("si", $username, $score);

$stmt->execute();

unset($_SESSION["questions"]);
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
