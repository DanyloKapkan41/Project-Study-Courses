<?php
session_start();
require_once 'include/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nickname = $mysql->real_escape_string($_POST['nickname']);
    $login = $mysql->real_escape_string($_POST['login']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $query = "INSERT INTO Users (Nickname, Password, Login) VALUES ('$nickname', '$password', '$login')";

    if ($mysql->query($query)) {
        $message = "Реєстрація успішна!";
    } else {
        $message = "Помилка при реєстрації: " . $mysql->error;
    }

    $mysql->close();

    header("Location: register.php?message=" . urlencode($message));
    exit;
}
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Реєстрація</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include 'include/header.php'; ?>
    <main>
        <section class="registration">
            <h2>Реєстрація користувача</h2>
            <form action="register.php" method="POST">
                <label for="nickname">Нікнейм:</label>
                <input type="text" id="nickname" name="nickname" required>
                <label for="login">Логін:</label>
                <input type="text" id="login" name="login" required>
                <label for="password">Пароль:</label>
                <input type="password" id="password" name="password" required>
                <button type="submit">Зареєструватися</button>
            </form>
            <?php
            if (isset($_GET['message'])) {
                echo '<p>' . htmlspecialchars($_GET['message']) . '</p>';
            }
            ?>
        </section>
    </main>
    <?php include 'include/footer.php'; ?>
</body>
</html>
