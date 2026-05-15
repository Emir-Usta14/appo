<?php
session_start();
include "db.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    $check = $conn->prepare("
        SELECT id
        FROM users
        WHERE username = ?
    ");

    $check->bind_param("s", $username);

    $check->execute();

    $result = $check->get_result();

    if ($result->num_rows > 0) {

        $error = "Username already exists";

    } else {

        $stmt = $conn->prepare("
            INSERT INTO users (username, password, is_admin)
            VALUES (?, ?, 0)
        ");

        $stmt->bind_param("ss", $username, $password);

        $stmt->execute();

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

<br>

<div style="color:red; font-size:22px;">
<?php echo $error; ?>
</div>

<br>

<a href="login.php">
<button type="button">
Back To Login
</button>
</a>

</div>

</body>
</html>
