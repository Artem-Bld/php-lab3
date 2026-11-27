<?php
// settings.php
require 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bg = $_POST['bg_color'];
    $text = $_POST['text_color'];

    // Обновляем БД
    $stmt = $pdo->prepare("UPDATE users SET bg_color = ?, text_color = ? WHERE id = ?");
    $stmt->execute([$bg, $text, $_SESSION['user_id']]);

    // Обновляем Cookies
    setcookie('bg_color', $bg, time() + (86400 * 30), "/");
    setcookie('text_color', $text, time() + (86400 * 30), "/");

    header("Location: index.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();
?>
<!DOCTYPE html>
<html>
<body>
    <h2>Настройки</h2>
    <form method="POST">
        Цвет фона: <input type="color" name="bg_color" value="<?= $user['bg_color'] ?>"><br><br>
        Цвет текста: <input type="color" name="text_color" value="<?= $user['text_color'] ?>"><br><br>
        <button type="submit">Сохранить</button>
    </form>
    <br><a href="index.php">Назад</a>
</body>
</html>