<?php
session_start();
require_once 'include/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$userId = $_SESSION['user_id'];
$courseId = isset($_POST['course_id']) ? intval($_POST['course_id']) : 0;
$hours = isset($_POST['hours']) ? intval($_POST['hours']) : 0;

if ($hours <= 0) {
    $message = "Кількість годин повинна бути більше нуля.";
    header("Location: profile.php?message=" . urlencode($message));
    exit;
}

// Перевірка, чи користувач вже купив цей курс
$query = "SELECT * FROM Users_Courses WHERE UserID = '$userId' AND CourseID = '$courseId'";
$result = $mysql->query($query);

if ($result->num_rows > 0) {
    // Якщо запис існує, оновлюємо кількість годин
    $existing = $result->fetch_assoc();
    $newHours = $existing['BoughtHours'] + $hours;
    $updateQuery = "UPDATE Users_Courses SET BoughtHours = '$newHours' WHERE UserID = '$userId' AND CourseID = '$courseId'";
    if ($mysql->query($updateQuery)) {
        $message = "Додано $hours годин до вашого курсу!";
    } else {
        $message = "Помилка при оновленні курсу: " . $mysql->error;
    }
} else {
    // Якщо запис не існує, створюємо новий
    $insertQuery = "INSERT INTO Users_Courses (UserID, CourseID, BoughtHours) VALUES ('$userId', '$courseId', '$hours')";
    if ($mysql->query($insertQuery)) {
        $message = "Курс успішно придбано з $hours годинами!";
    } else {
        $message = "Помилка при купівлі курсу: " . $mysql->error;
    }
}

$mysql->close();

header("Location: profile.php?message=" . urlencode($message));
exit;
?>
