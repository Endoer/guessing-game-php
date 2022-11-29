<?php

const MIN_ANSWER = 1;
const MAX_ANSWER = 100;

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $_SESSION = [
        'actual_number' => rand(MIN_ANSWER, MAX_ANSWER),
        'attempts' => ceil(log(MAX_ANSWER - MIN_ANSWER + 1, 2)),
        'attempts_log' => [],
    ];
}

$actual_number = $_SESSION['actual_number'];
$message = '';
$game_over = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $answer = $_POST['answer'];
    if (!is_numeric($answer)) {
        $message = 'Введите число';
    } elseif ($answer < MIN_ANSWER || $answer > MAX_ANSWER) {
        $message = 'Число должно быть в диапазоне от ' . MIN_ANSWER . ' до ' . MAX_ANSWER;
    }
    else {
        $_SESSION['attempts']--;
        $_SESSION['attempts_log'][] = $answer;
        if ($_SESSION['attempts'] == 0) {
            $formatted_attempts_log = "<hr>К сожалению, вы проиграли! Моё число {$actual_number}. Вспомните бинарный поиск и возвращайтесь";
            $game_over = true;
        } elseif ($answer == $actual_number) {
            $formatted_attempts_log = '<hr>Поздравляю вы угадали моё число!';
            $game_over = true;
        }
    }
}
if(!$game_over) {
    $formatted_attempts_log = "<hr>Я только что загадал новое число";
    foreach ($_SESSION['attempts_log'] as $attempt) {
        if ($attempt < $actual_number) {
            $formatted_attempts_log = "<hr>{$attempt} моё число больше" . $formatted_attempts_log;
        } elseif ($attempt > $actual_number) {
            $formatted_attempts_log = "<hr>{$attempt} моё число меньше" . $formatted_attempts_log;
        } else {
            $formatted_attempts_log = "<hr>Моё число {$attempt}. Поздравляю вы угадали" . $formatted_attempts_log;
        }
    }
}
