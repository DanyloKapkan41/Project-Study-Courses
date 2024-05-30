<?php
session_start();
require_once 'include/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$query = "SELECT * FROM Courses";
$result = $mysql->query($query);

$mysql->close();
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Адмін панель</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include 'include/header.php'; ?>
    <main>
        <section class="admin-panel">
            <h2>Адмін панель</h2>
            <?php if (isset($_GET['message'])): ?>
                <p><?php echo htmlspecialchars($_GET['message']); ?></p>
            <?php endif; ?>
            <div class="admin-content">
                <div class="admin-form">
                    <h3>Додати новий курс</h3>
                    <form action="add_course.php" method="POST">
                        <label for="course-name">Назва курсу:</label>
                        <input type="text" id="course-name" name="course_name" required>
                        <label for="teacher-id">ID Викладача:</label>
                        <input type="number" id="teacher-id" name="teacher_id" required>
                        <label for="course-hours">Кількість годин:</label>
                        <input type="number" id="course-hours" name="course_hours" required>
                        <label for="start-date">Дата початку:</label>
                        <input type="date" id="start-date" name="start_date" required>
                        <label for="end-date">Дата завершення:</label>
                        <input type="date" id="end-date" name="end_date" required>
                        <label for="course-address">Адреса курсу:</label>
                        <input type="text" id="course-address" name="course_address" required>
                        <button type="submit">Додати курс</button>
                    </form>
                </div>
                <div class="admin-form">
                    <h3>Видалити курс</h3>
                    <form action="delete_course.php" method="POST">
                        <label for="course-id">ID Курсу:</label>
                        <input type="number" id="course-id" name="course_id" required>
                        <button type="submit">Видалити курс</button>
                    </form>
                </div>
                <div class="course-list">
                    <h3>Список курсів</h3>
                    <ul>
                        <?php while ($course = $result->fetch_assoc()): ?>
                            <li><?php echo htmlspecialchars($course['CourseName']); ?> (ID: <?php echo $course['CourseID']; ?>)</li>
                        <?php endwhile; ?>
                    </ul>
                </div>
            </div>
        </section>
    </main>
    <?php include 'include/footer.php'; ?>
</body>
</html>
