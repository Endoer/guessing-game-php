<?php require 'game.php'; ?>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/styles/style.css">
    <link rel="stylesheet" href="/styles/bootstrap_css/bootstrap.css">


</head>

<body>
<div class="gameBlock">
    <form method="post" class ="gameForm">
        <div class="h1" >Игра угадай число</div>
        <div class="form-label" >
            Компьютер загадал число в диапазоне от <?= MIN_ANSWER ?> до <?= MAX_ANSWER ?>
            <p>Осталось попыток: <span><?= $_SESSION['attempts'] ?></span></p>
        </div>
        <div class="inputButton">
            <input class="form-control"  name="answer" autofocus>
            <button class="btn btn-primary" <?= $game_over ? 'disabled' : '' ?>>Проверить</button>
            <a class="btn btn-primary" href="<?= $_SERVER['REQUEST_URI'] ?>" >Заново</a>
        </div>
        <div class="form-label" id="status"><?=$message?><?= $formatted_attempts_log ?></div>
    </form>
</div>
<script src="/scripts/script.js"></script>
</body>

</html>