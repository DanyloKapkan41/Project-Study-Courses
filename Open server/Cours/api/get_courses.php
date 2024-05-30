<?php
require_once __DIR__ . '/../include/db.php';

$query = "
    SELECT c.CourseID, c.CourseName, t.Name, t.Surname, t.PhotoPath, t.HourlyRate, c.CourseHours, c.StartDate, c.EndDate
    FROM Courses c
    JOIN Teachers t ON c.TeacherId = t.TeacherId
";

$result = $mysql->query($query);

$courses = [];
while ($row = $result->fetch_assoc()) {
    $courses[] = $row;
}

$mysql->close();

header('Content-Type: application/json');
echo json_encode($courses);
