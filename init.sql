CREATE DATABASE IF NOT EXISTS course_registration_db;
USE course_registration_db;

CREATE TABLE IF NOT EXISTS students (
    student_id VARCHAR(20) PRIMARY KEY,
    student_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    department VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS courses (
    course_id INT AUTO_INCREMENT PRIMARY KEY,
    course_code VARCHAR(20) NOT NULL UNIQUE,
    course_name VARCHAR(100) NOT NULL,
    credits INT NOT NULL,
    instructor VARCHAR(100),
    available_slots INT NOT NULL,
    total_slots INT NOT NULL,
    semester VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS registrations (
    registration_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id VARCHAR(20) NOT NULL,
    course_id INT NOT NULL,
    registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status VARCHAR(20) DEFAULT 'active',
    FOREIGN KEY (student_id) REFERENCES students(student_id) ON DELETE CASCADE,
    FOREIGN KEY (course_id) REFERENCES courses(course_id) ON DELETE CASCADE,
    UNIQUE KEY unique_registration (student_id, course_id)
);

INSERT INTO students (student_id, student_name, email, password, department) VALUES 
('STD001', 'John Doe', 'john.doe@university.edu', MD5('student123'), 'Computer Engineering'),
('STD002', 'Jane Smith', 'jane.smith@university.edu', MD5('student123'), 'Computer Engineering')
ON DUPLICATE KEY UPDATE student_id=student_id;

INSERT INTO courses (course_code, course_name, credits, instructor, available_slots, total_slots, semester) VALUES 
('CSC101', 'Introduction to Programming', 3, 'Dr. Anderson', 30, 30, 'Fall 2024'),
('CSC102', 'Data Structures', 4, 'Prof. Williams', 25, 30, 'Fall 2024'),
('MTH101', 'Calculus I', 3, 'Dr. Johnson', 40, 40, 'Fall 2024'),
('PHY101', 'Physics for Engineers', 4, 'Prof. Brown', 35, 35, 'Fall 2024'),
('ENG101', 'Technical Writing', 2, 'Dr. Davis', 20, 25, 'Fall 2024')
ON DUPLICATE KEY UPDATE course_code=course_code;