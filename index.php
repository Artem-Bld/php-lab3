<?php
// index.php
require 'db.php';
require 'vendor/autoload.php'; // Подключаем Composer
session_start();

// Автоматическая авторизация через Cookies, если сессия пуста
if (!isset($_SESSION['user_id']) && isset($_COOKIE['user_id'])) {
    $_SESSION['user_id'] = $_COOKIE['user_id'];
}

// Если не авторизован - на страницу входа
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Получаем данные пользователя
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

// Применяем настройки из Cookies (если есть) или из БД
$bg = $_COOKIE['bg_color'] ?? $user['bg_color'];
$text = $_COOKIE['text_color'] ?? $user['text_color'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Личный кабинет</title>
</head>
<body style="background-color: <?= htmlspecialchars($bg) ?>; color: <?= htmlspecialchars($text) ?>;">
    <h1>Привет, <?= htmlspecialchars($user['username']) ?>!</h1>
    <p>Это твоя главная страница. Настройки применены.</p>
    
    <ul>
        <li><a href="settings.php">Изменить настройки</a></li>
        <li><a href="logout.php">Выйти</a></li>
    </ul>
</body>
</html>