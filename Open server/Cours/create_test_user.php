<?php
require_once 'include/db.php';

// Дані користувача
$nickname = 'Тестовий користувач';
$login = 'testuser';
$password = password_hash('password', PASSWORD_BCRYPT); // Хешування пароля

// Запит для вставки користувача
$query = "INSERT INTO Users (Nickname, Login, Password) VALUES ('$nickname', '$login', '$password')";

if ($mysql->query($query)) {
    echo "Користувач успішно створений!";
} else {
    echo "Помилка при створенні користувача: " . $mysql->error;
}

$mysql->close();
?>
