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

$course_check = "SELECT * FROM courses WHERE course_id = $course_id AND available_slots > 0";
$result = $conn->query($course_check);

if ($result->num_rows == 0) {
    $_SESSION['error'] = "Course not available or no slots remaining!";
    header("Location: dashboard.php");
    exit();
}

$registration_check = "SELECT * FROM registrations 
                      WHERE student_id = '$student_id' 
                      AND course_id = $course_id 
                      AND status = 'active'";
$reg_result = $conn->query($registration_check);

if ($reg_result->num_rows > 0) {
    $_SESSION['error'] = "You are already registered for this course!";
    header("Location: dashboard.php");
    exit();
}

$conn->begin_transaction();

try {
    $insert_sql = "INSERT INTO registrations (student_id, course_id, status) 
                   VALUES ('$student_id', $course_id, 'active')";
    
    if (!$conn->query($insert_sql)) {
        throw new Exception("Failed to register for course");
    }
    
    $update_sql = "UPDATE courses SET available_slots = available_slots - 1 
                   WHERE course_id = $course_id";
    
    if (!$conn->query($update_sql)) {
        throw new Exception("Failed to update course slots");
    }
    
    $conn->commit();
    $_SESSION['success'] = "Successfully registered for the course!";
    
} catch (Exception $e) {
    $conn->rollback();
    $_SESSION['error'] = "Registration failed: " . $e->getMessage();
}

$conn->close();
header("Location: dashboard.php");
exit();
?>