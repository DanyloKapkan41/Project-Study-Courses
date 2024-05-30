<?php
session_start();
require_once 'include/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $mysql->real_escape_string($_POST['login']);
    $password = $_POST['password'];

    $query = "SELECT * FROM Users WHERE Login = '$login'";
    $result = $mysql->query($query);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['Password'])) {
            $_SESSION['user_id'] = $user['UserID'];
            $_SESSION['nickname'] = $user['Nickname'];
            $_SESSION['role'] = $user['Role'];
            header("Location: index.php");
            exit;
        } else {
            $message = "Неправильний логін або пароль.";
        }
    } else {
        $message = "Неправильний логін або пароль.";
    }

    $mysql->close();

    header("Location: login.php?message=" . urlencode($message));
    exit;
}
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вхід</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include 'include/header.php'; ?>
    <main>
        <section class="login">
            <h2>Вхід користувача</h2>
            <form action="login.php" method="POST">
                <label for="login">Логін:</label>
                <input type="text" id="login" name="login" required>
                <label for="password">Пароль:</label>
                <input type="password" id="password" name="password" required>
                <button type="submit">Увійти</button>
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
