<?php
// login.php
require 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$_POST['username']]);
    $user = $stmt->fetch();

    if ($user && password_verify($_POST['password'], $user['password'])) {

        $_SESSION['user_id'] = $user['id'];
        
        setcookie('user_id', $user['id'], time() + (86400 * 30), "/");
        setcookie('bg_color', $user['bg_color'], time() + (86400 * 30), "/");
        setcookie('text_color', $user['text_color'], time() + (86400 * 30), "/");

        header("Location: index.php");
        exit;
    } else {
        echo "Неверный логин или пароль!";
    }
}
?>
<!DOCTYPE html>
<html>
<body>
    <h2>Вход</h2>
    <form method="POST">
        Логин: <input type="text" name="username" required><br><br>
        Пароль: <input type="password" name="password" required><br><br>
        <button type="submit">Войти</button>
    </form>
    <br><a href="register.php">Регистрация</a>
</body>
</html>