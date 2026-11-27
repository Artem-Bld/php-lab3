<?php
// register.php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $bgColor = $_POST['bg_color'] ?? '#ffffff';
    $textColor = $_POST['text_color'] ?? '#000000';

    $stmt = $pdo->prepare("INSERT INTO users (username, password, bg_color, text_color) VALUES (?, ?, ?, ?)");
    try {
        $stmt->execute([$username, $password, $bgColor, $textColor]);
        echo "Регистрация успешна! <a href='login.php'>Войти</a>";
    } catch (Exception $e) {
        echo "Ошибка: Имя уже занято.";
    }
}
?>
<!DOCTYPE html>
<html>
<body>
    <h2>Регистрация</h2>
    <form method="POST">
        Логин: <input type="text" name="username" required><br><br>
        Пароль: <input type="password" name="password" required><br><br>
        Цвет фона: <input type="color" name="bg_color" value="#ffffff"><br><br>
        Цвет текста: <input type="color" name="text_color" value="#000000"><br><br>
        <button type="submit">Зарегистрироваться</button>
    </form>
</body>
</html>