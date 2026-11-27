<?php
// logout.php
session_start();
session_destroy(); // Уничтожаем сессию

// Удаляем Cookies
setcookie('user_id', '', time() - 3600, "/");
setcookie('bg_color', '', time() - 3600, "/");
setcookie('text_color', '', time() - 3600, "/");

header("Location: login.php");
exit;
?>