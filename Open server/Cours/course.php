<?php
require_once 'include/db.php';
session_start();

if (!isset($_GET['id'])) {
    echo "Не вказаний ID курсу.";
    exit;
}

$courseId = (int)$_GET['id'];

$query = "
    SELECT c.CourseName, t.Name, t.Surname, t.Patrion, t.Phone, t.Adress as InstructorAddress, 
           t.HourlyRate, c.CourseHours, c.StartDate, c.EndDate, c.Adress as CourseAddress, 
           t.PhotoPath, c.Description,
           GROUP_CONCAT(CONCAT(s.ClassDate, ' ', s.StartTime, '-', s.EndTime) SEPARATOR ', ') as Schedule
    FROM Courses c
    JOIN Teachers t ON c.TeacherId = t.TeacherId
    LEFT JOIN Schedules s ON c.CourseID = s.CourseId
    WHERE c.CourseID = $courseId
    GROUP BY c.CourseID
";

$result = $mysql->query($query);

if (!$result) {
    echo "Помилка виконання запиту: " . $mysql->error;
    exit;
}

$course = $result->fetch_assoc();

$mysql->close();

if (!$course) {
    echo "Курс не знайдено.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Деталі курсу</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include 'include/header.php'; ?>
    <main>
        <section class="course-detail">
            <div class="course-info">
                <div class="course-image">
                    <img id="course-image" src="<?php echo $course['PhotoPath']; ?>" alt="Фото викладача">
                </div>
                <div class="course-text">
                    <h2><?php echo $course['CourseName']; ?></h2>
                    <p><strong>Викладач:</strong> <?php echo $course['Name'] . ' ' . $course['Surname'] . ' ' . $course['Patrion']; ?></p>
                    <p><strong>Телефон:</strong> <?php echo $course['Phone']; ?></p>
                    <p><strong>Адреса викладача:</strong> <?php echo $course['InstructorAddress']; ?></p>
                    <p><strong>Вартість одного заняття:</strong> <?php echo $course['HourlyRate']; ?></p>
                    <p><strong>Кількість годин:</strong> <?php echo $course['CourseHours']; ?></p>
                    <p><strong>Дата початку:</strong> <?php echo $course['StartDate']; ?></p>
                    <p><strong>Дата завершення:</strong> <?php echo $course['EndDate']; ?></p>
                    <p><strong>Адреса курсу:</strong> <?php echo $course['CourseAddress']; ?></p>
                    <p><strong>Розклад:</strong> <?php echo $course['Schedule']; ?></p>
                </div>
            </div>
            <div class="course-description">
                <h3>Детальний опис курсу</h3>
                <p><?php echo $course['Description']; ?></p>
            </div>
        </section>
    </main>
    <?php include 'include/footer.php'; ?>
</body>
</html>
