<?php
session_start();
require_once 'include/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$courseName = $mysql->real_escape_string($_POST['course_name']);
$teacherId = (int)$_POST['teacher_id'];
$courseHours = (int)$_POST['course_hours'];
$startDate = $mysql->real_escape_string($_POST['start_date']);
$endDate = $mysql->real_escape_string($_POST['end_date']);
$courseAddress = $mysql->real_escape_string($_POST['course_address']);

$query = "INSERT INTO Courses (CourseName, TeacherId, CourseHours, StartDate, EndDate, Adress) VALUES ('$courseName', '$teacherId', '$courseHours', '$startDate', '$endDate', '$courseAddress')";

if ($mysql->query($query)) {
    $message = "Курс успішно додано!";
} else {
    $message = "Помилка при додаванні курсу: " . $mysql->error;
}

$mysql->close();

header("Location: admin.php?message=" . urlencode($message));
exit;
?>
