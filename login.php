<?php
session_start();
include "db.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    $sql = "
        SELECT *
        FROM users
        WHERE username='$username'
        AND password='$password'
    ";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        $user = $result->fetch_assoc();

        $_SESSION["username"] = $user["username"];
        $_SESSION["is_admin"] = $user["is_admin"];

        header("Location: quiz.php");
        exit();

    } else {

        $error = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

<h1>Sign In</h1>

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
Sign In
</button>

</form>

<p style="color:red;">
<?php echo $error; ?>
</p>

<br>

<a href="signup.php">
<button type="button">
Create Account
</button>
</a>

</div>

</body>
</html>
