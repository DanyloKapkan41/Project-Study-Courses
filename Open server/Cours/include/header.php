<?php
session_start();
?>
<header>
    <nav>
        <ul>
            <li><a href="index.php">Головна</a></li>
            <li><a href="about.php">Про нас</a></li>
            <?php if (isset($_SESSION['user_id'])): ?>
                <?php if ($_SESSION['role'] === 'admin'): ?>
                    <li><a href="admin.php">Адмін панель</a></li>
                <?php endif; ?>
                <li><a href="profile.php">Профіль</a></li>
                <li><a href="logout.php">Вийти</a></li>
            <?php else: ?>
                <li><a href="register.php">Реєстрація</a></li>
                <li><a href="login.php">Вхід</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>