<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: index.html");
    exit();
}

require_once 'db_connection.php';

if (!isset($_GET['course_id']) || empty($_GET['course_id'])) {
    header("Location: dashboard.php");
    exit();
}

$course_id = intval($_GET['course_id']);
$student_id = $_SESSION['student_id'];

$registration_check = "SELECT * FROM registrations 
                      WHERE student_id = '$student_id' 
                      AND course_id = $course_id 
                      AND status = 'active'";
$result = $conn->query($registration_check);

if ($result->num_rows == 0) {
    $_SESSION['error'] = "You are not registered for this course!";
    header("Location: dashboard.php");
    exit();
}

$conn->begin_transaction();

try {
    $delete_sql = "DELETE FROM registrations 
                   WHERE student_id = '$student_id' 
                   AND course_id = $course_id 
                   AND status = 'active'";
    
    if (!$conn->query($delete_sql)) {
        throw new Exception("Failed to drop course");
    }
    
    $update_sql = "UPDATE courses SET available_slots = available_slots + 1 
                   WHERE course_id = $course_id";
    
    if (!$conn->query($update_sql)) {
        throw new Exception("Failed to update course slots");
    }
    
    $conn->commit();
    $_SESSION['success'] = "Successfully dropped the course!";
    
} catch (Exception $e) {
    $conn->rollback();
    $_SESSION['error'] = "Failed to drop course: " . $e->getMessage();
}

$conn->close();
header("Location: dashboard.php");
exit();
?>
```
