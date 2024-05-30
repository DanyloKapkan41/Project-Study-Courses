<?php
session_start();
require_once 'include/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$courseId = (int)$_POST['course_id'];

$query = "DELETE FROM Courses WHERE CourseID = '$courseId'";

if ($mysql->query($query)) {
    $message = "Курс успішно видалено!";
} else {
    $message = "Помилка при видаленні курсу: " . $mysql->error;
}

$mysql->close();

header("Location: admin.php?message=" . urlencode($message));
exit;
?>
