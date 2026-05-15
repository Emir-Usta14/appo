<?php
session_start();
include "db.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    $check = $conn->query("
        SELECT *
        FROM users
        WHERE username='$username'
    ");

    if ($check->num_rows > 0) {

        $error = "Username already exists";

    } else {

        $conn->query("
            INSERT INTO users(username,password,is_admin)
            VALUES('$username','$password',0)
        ");

        header("Location: login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

<h1>Create Account</h1>

<form method="POST">

<input
type="text"
name="username"
placeholder="Username"
required
>

<br><br>

<input
type="password"
name="password"
placeholder="Password"
required
>

<br><br>

<button type="submit">
Create Account
</button>

</form>

<p style="color:red;">
<?php echo $error; ?>
</p>

<br>

<a href="login.php">
<button type="button">
Back To Login
</button>
</a>

</div>

</body>
</html>
