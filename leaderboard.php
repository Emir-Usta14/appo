
<?php
include "db.php";

$result = $conn->query("
    SELECT username, MAX(score) AS best_score
    FROM scores
    GROUP BY username
    ORDER BY best_score DESC
    LIMIT 10
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Leaderboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

<h1>Leaderboard</h1>

<table>

<tr>
<th>Rank</th>
<th>Username</th>
<th>Best Score</th>
</tr>

<?php
$rank = 1;

while($row = $result->fetch_assoc()){
?>

<tr>
<td><?php echo $rank; ?></td>
<td><?php echo $row["username"]; ?></td>
<td><?php echo $row["best_score"]; ?>/10</td>
</tr>

<?php
$rank++;
}
?>

</table>

<br>

<a href="index.php">
<button>
Return Home
</button>
</a>

</div>

</body>
</html>
