<?php
require_once 'include/db.php';
session_start();

// Перевірка чи користувач залогінений
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Отримання інформації про користувача
$userID = $_SESSION['user_id'];
$query = $mysql->prepare("SELECT Nickname, Login FROM Users WHERE UserID = ?");
$query->bind_param('i', $userID);
$query->execute();
$result = $query->get_result();
$user = $result->fetch_assoc();

// Отримання курсів користувача
$coursesQuery = $mysql->prepare("
    SELECT c.CourseName, uc.BoughtHours 
    FROM Users_Courses uc 
    JOIN Courses c ON uc.CourseID = c.CourseID 
    WHERE uc.UserID = ?");
$coursesQuery->bind_param('i', $userID);
$coursesQuery->execute();
$coursesResult = $coursesQuery->get_result();
$userCourses = [];
while ($row = $coursesResult->fetch_assoc()) {
    $userCourses[] = $row;
}

// Отримання списку всіх курсів для покупки
$allCoursesQuery = $mysql->query("SELECT CourseID, CourseName FROM Courses");
$allCourses = $allCoursesQuery->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Профіль користувача</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include 'include/header.php'; ?>
    <main>
        <section class="profile">
            <div class="profile-info">
                <h2>Профіль користувача</h2>
                <p><strong>Нікнейм:</strong> <?php echo htmlspecialchars($user['Nickname']); ?></p>
                <p><strong>Логін:</strong> <?php echo htmlspecialchars($user['Login']); ?></p>
            </div>
            <div class="profile-courses">
                <h3>Ваші курси</h3>
                <ul>
                    <?php foreach ($userCourses as $course): ?>
                        <li><?php echo htmlspecialchars($course['CourseName']); ?> - <?php echo htmlspecialchars($course['BoughtHours']); ?> годин(и)</li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="course-purchase">
                <h3>Купити курс</h3>
                <form action="buy_course.php" method="post">
                    <label for="course">Курс:</label>
                    <select name="course_id" id="course">
                        <?php foreach ($allCourses as $course): ?>
                            <option value="<?php echo htmlspecialchars($course['CourseID']); ?>"><?php echo htmlspecialchars($course['CourseName']); ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="hours">Кількість годин:</label>
                    <input type="number" name="hours" id="hours" min="1" required>
                    <button type="submit">Купити курс</button>
                </form>
            </div>
        </section>
    </main>
    <?php include 'include/footer.php'; ?>
</body>
</html>
