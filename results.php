<?php
session_start();
include "db.php";

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

$score = 0;

foreach ($_POST as $key => $value) {

    if (strpos($key, "q") === 0) {

        $questionNumber = str_replace("q", "", $key);

        $correct = $_POST["correct" . $questionNumber];

        if ($value == $correct) {
            $score++;
        }
    }
}

$username = $_SESSION["username"];

$conn->query("
    INSERT INTO scores(username,score)
    VALUES('$username','$score')
");
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

<h2>
<?php echo $score; ?>/10
</h2>

<br>

<a href="quiz.php">
<button>
Play Again
</button>
</a>

<a href="leaderboard.php">
<button>
Leaderboard
</button>
</a>

<a href="index.php">
<button>
Home
</button>
</a>

</div>

</body>
</html>
