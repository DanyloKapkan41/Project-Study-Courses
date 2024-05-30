<?php
require_once 'include/db.php';
session_start();
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Навчальні Курси</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <?php include 'include/header.php'; ?>
    <main>
        <section class="about-us">
            <div class="intro-image">
                <img src="img/about-us.jpg" alt="Навчання">
            </div>
            <div class="intro-text">
                <h1>Ласкаво просимо на наш сайт навчальних курсів</h1>
                <p>Ласкаво просимо на наш сайт навчальних курсів! Тут ви знайдете найкращі курси для вашого розвитку, щоб розкрити свій потенціал і досягти нових висот. Незалежно від вашої сфери інтересів або рівня знань, ми пропонуємо різноманітні програми, які відповідатимуть вашим потребам та амбіціям. Долучайтеся до нашої спільноти і розпочніть захопливу подорож до саморозвитку вже сьогодні!</p>
                <p>Приєднуйтесь до нашого сайту, щоб отримати доступ до найактуальніших знань та найефективніших методик навчання. Наші курси розроблені професіоналами з відповідною експертизою, які гарантують якість і практичну цінність кожного уроку. Ми прагнемо створювати навчальні матеріали, які стимулюють ваш інтелект і розширюють ваші горизонти. Наші учні отримують не лише знання, а й підтримку та співпрацю з іншими студентами з усього світу. Приєднуйтеся до нас сьогодні, і разом ми зробимо вашу навчальну подорож найцікавішою та найпродуктивнішою!</p>
            </div>
        </section>
        <section class="courses">
            <h2>Наші курси</h2>
            <div class="courses-list" id="courses-list"></div>
        </section>
    </main>
    <?php include 'include/footer.php'; ?>
    <script src="java/scripts.js"></script>
</body>
</html>
