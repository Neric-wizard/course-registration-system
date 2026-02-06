<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: index.html");
    exit();
}

// Include database connection
require_once 'db_connection.php';

// Get student info from session
$student_id = $_SESSION['student_id'];
$student_name = $_SESSION['student_name'];
$department = $_SESSION['department'];

// Get available courses
$courses_sql = "SELECT * FROM courses WHERE available_slots > 0 ORDER BY course_code";
$courses_result = $conn->query($courses_sql);

// Get student's registered courses
$registered_sql = "SELECT c.*, r.registration_date 
                   FROM registrations r 
                   JOIN courses c ON r.course_id = c.course_id 
                   WHERE r.student_id = '$student_id' AND r.status = 'active'
                   ORDER BY c.course_code";
$registered_result = $conn->query($registered_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - Course Registration</title>
    <link rel="stylesheet" href="dashboard_style.css">
</head>
<body>
    <div class="dashboard-container">
        <!-- Header -->
        <header class="dashboard-header">
            <div class="header-content">
                <h1>Course Registration System</h1>
                <div class="user-info">
                    <span>Welcome, <strong><?php echo htmlspecialchars($student_name); ?></strong></span>
                    <span class="separator">|</span>
                    <span><?php echo htmlspecialchars($student_id); ?></span>
                    <span class="separator">|</span>
                    <a href="logout.php" class="logout-btn">Logout</a>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="dashboard-main">
            <!-- Student Info Card -->
            <div class="info-card">
                <h2>Student Information</h2>
                <div class="info-grid">
                    <div class="info-item">
                        <span class="label">Student ID:</span>
                        <span class="value"><?php echo htmlspecialchars($student_id); ?></span>
                    </div>
                    <div class="info-item">
                        <span class="label">Name:</span>
                        <span class="value"><?php echo htmlspecialchars($student_name); ?></span>
                    </div>
                    <div class="info-item">
                        <span class="label">Department:</span>
                        <span class="value"><?php echo htmlspecialchars($department); ?></span>
                    </div>
                </div>
            </div>

            <!-- Registered Courses -->
            <div class="section">
                <h2>My Registered Courses</h2>
                <?php if ($registered_result->num_rows > 0): ?>
                    <div class="table-container">
                        <table class="courses-table">
                            <thead>
                                <tr>
                                    <th>Course Code</th>
                                    <th>Course Name</th>
                                    <th>Credits</th>
                                    <th>Instructor</th>
                                    <th>Registration Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($course = $registered_result->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($course['course_code']); ?></td>
                                    <td><?php echo htmlspecialchars($course['course_name']); ?></td>
                                    <td><?php echo htmlspecialchars($course['credits']); ?></td>
                                    <td><?php echo htmlspecialchars($course['instructor']); ?></td>
                                    <td><?php echo date('M d, Y', strtotime($course['registration_date'])); ?></td>
                                    <td>
                                        <a href="drop_course.php?course_id=<?php echo $course['course_id']; ?>" 
                                           class="btn btn-danger"
                                           onclick="return confirm('Are you sure you want to drop this course?')">
                                           Drop
                                        </a>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p class="no-data">You have not registered for any courses yet.</p>
                <?php endif; ?>
            </div>

            <!-- Available Courses -->
            <div class="section">
                <h2>Available Courses</h2>
                <?php if ($courses_result->num_rows > 0): ?>
                    <div class="table-container">
                        <table class="courses-table">
                            <thead>
                                <tr>
                                    <th>Course Code</th>
                                    <th>Course Name</th>
                                    <th>Credits</th>
                                    <th>Instructor</th>
                                    <th>Available Slots</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($course = $courses_result->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($course['course_code']); ?></td>
                                    <td><?php echo htmlspecialchars($course['course_name']); ?></td>
                                    <td><?php echo htmlspecialchars($course['credits']); ?></td>
                                    <td><?php echo htmlspecialchars($course['instructor']); ?></td>
                                    <td><?php echo $course['available_slots'] . '/' . $course['total_slots']; ?></td>
                                    <td>
                                        <a href="register_course.php?course_id=<?php echo $course['course_id']; ?>" 
                                           class="btn btn-primary">
                                           Register
                                        </a>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p class="no-data">No courses available at the moment.</p>
                <?php endif; ?>
            </div>
        </main>
    </div>
</body>
</html>

<?php $conn->close(); ?>