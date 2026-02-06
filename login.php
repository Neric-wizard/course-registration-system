<?php
session_start();

// Include database connection
require_once 'db_connection.php';

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Get form data and sanitize
    $student_id = mysqli_real_escape_string($conn, $_POST['student_id']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    // Hash the password using MD5 (matching our database)
    $hashed_password = md5($password);
    
    // Query to check if student exists
    $sql = "SELECT * FROM students WHERE student_id = '$student_id' AND password = '$hashed_password'";
    $result = $conn->query($sql);
    
    if ($result->num_rows == 1) {
        // Login successful
        $student = $result->fetch_assoc();
        
        // Store student info in session
        $_SESSION['student_id'] = $student['student_id'];
        $_SESSION['student_name'] = $student['student_name'];
        $_SESSION['email'] = $student['email'];
        $_SESSION['department'] = $student['department'];
        $_SESSION['logged_in'] = true;
        
        // Redirect to dashboard
        header("Location: dashboard.php");
        exit();
    } else {
        // Login failed
        $_SESSION['error'] = "Invalid Student ID or Password!";
        header("Location: index.html");
        exit();
    }
} else {
    // If someone tries to access this page directly
    header("Location: index.html");
    exit();
}

$conn->close();
?>