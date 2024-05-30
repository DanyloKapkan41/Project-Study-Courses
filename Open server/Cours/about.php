<?php
session_start();
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Про нас</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include 'include/header.php'; ?>
    <main>
        <section class="about-us">
            <h2>Про нас</h2>
            <div class="about-content">
                <div class="about-image">
                    <img src="img/about-us.jpg" alt="Про нас">
                </div>
                <div class="about-text">
                    <p>Ласкаво просимо до нашого навчального центру! Ми пропонуємо різноманітні курси для вашого особистого та професійного розвитку. Наші досвідчені викладачі допоможуть вам опанувати нові знання та навички, необхідні для успіху в сучасному світі.</p>
                    <p>Ми прагнемо забезпечити високу якість навчання, використовуючи сучасні методи та технології. Наші курси розроблені таким чином, щоб відповідати потребам і очікуванням кожного студента.</p>
                    <p>Приєднуйтесь до нашої спільноти та розвивайте свої таланти разом з нами. Ми впевнені, що наші курси допоможуть вам досягти нових висот у вашій кар'єрі та особистому житті.</p>
                    <p>Контактуйте з нами для отримання додаткової інформації або запису на курси. Ми завжди раді допомогти вам!</p>
                </div>
            </div>
        </section>
    </main>
    <?php include 'include/footer.php'; ?>
</body>
</html>
