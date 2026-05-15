
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
    <title>Quiz Time</title>

    <style>

        body{
            background:#000;
            color:white;
            font-family:Arial;
            margin:0;
            padding:0;
        }

        .container{
            width:80%;
            max-width:900px;
            margin:auto;
            padding:40px 20px;
        }

        h1{
            text-align:center;
            font-size:55px;
            margin-bottom:10px;
        }

        .welcome{
            text-align:center;
            font-size:22px;
            margin-bottom:40px;
        }

        .question-box{
            background:#111;
            border-radius:20px;
            padding:30px;
            margin-bottom:35px;
        }

        .question{
            font-size:28px;
            font-weight:bold;
            margin-bottom:25px;
        }

        .answers{
            display:flex;
            flex-direction:column;
            gap:18px;
        }

        .answer-option{
            display:flex;
            align-items:center;
            gap:15px;
            font-size:22px;
        }

        input[type="radio"]{
            transform:scale(1.5);
        }

        .submit-btn{
            display:block;
            margin:40px auto;
            padding:18px 50px;
            border:none;
            border-radius:12px;
            background:#2e8b57;
            color:white;
            font-size:24px;
            cursor:pointer;
        }

        .submit-btn:hover{
            background:#256f47;
        }

    </style>
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
                    <input type="radio" name="q<?php echo $count; ?>" value="A">
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
