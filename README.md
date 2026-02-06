# Univ# 🎓 University Course Registration System

# 

# A modern, full-featured web application for managing university course registrations. Built with PHP, MySQL, and vanilla JavaScript with a focus on user experience and clean code architecture.

# 

# !\[Course Registration System](https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge\&logo=php\&logoColor=white)

# !\[MySQL](https://img.shields.io/badge/MySQL-5.7-4479A1?style=for-the-badge\&logo=mysql\&logoColor=white)

# !\[JavaScript](https://img.shields.io/badge/JavaScript-ES6-F7DF1E?style=for-the-badge\&logo=javascript\&logoColor=black)

# !\[HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge\&logo=html5\&logoColor=white)

# !\[CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge\&logo=css3\&logoColor=white)

# 

# \## ✨ Features

# 

# \### 🔐 Authentication \& Security

# \- Secure login system with session management

# \- Password hashing (MD5)

# \- SQL injection prevention

# \- XSS protection with input sanitization

# \- Session-based authorization

# 

# \### 📚 Course Management

# \- \*\*View Available Courses\*\* - Browse all courses with available slots

# \- \*\*Course Registration\*\* - Register for courses with real-time slot updates

# \- \*\*Drop Courses\*\* - Remove unwanted courses with automatic slot recovery

# \- \*\*Search \& Filter\*\* - Find courses quickly using the search functionality

# \- \*\*Duplicate Prevention\*\* - System prevents registering for the same course twice

# 

# \### 📊 Student Dashboard

# \- Personal statistics cards (Registered Courses, Total Credits, etc.)

# \- Real-time course availability tracking

# \- Registration history with timestamps

# \- Intuitive user interface with modern design

# 

# \### 🎨 User Experience

# \- Responsive design (works on mobile, tablet, and desktop)

# \- Smooth animations and transitions

# \- Loading states and progress indicators

# \- Toast notifications for user feedback

# \- Confirmation dialogs for critical actions

# \- Live search with instant results

# 

# \## 🚀 Demo

# 

# \*\*Test Credentials:\*\*

# \- Student ID: `STD001`

# \- Password: `student123`

# 

# \## 📸 Screenshots

# 

# \### Login Page

# Clean, modern login interface with form validation

# 

# \### Dashboard

# Comprehensive student dashboard with course statistics and management

# 

# \### Course Registration

# Real-time course registration with availability tracking

# 

# \## 🛠️ Technology Stack

# 

# \*\*Frontend:\*\*

# \- HTML5

# \- CSS3 (with modern features: Grid, Flexbox, Animations)

# \- Vanilla JavaScript (ES6+)

# \- Font Awesome Icons

# 

# \*\*Backend:\*\*

# \- PHP 8.2

# \- MySQL 5.7+

# 

# \*\*Server:\*\*

# \- Apache (via XAMPP)

# 

# \## 📋 Prerequisites

# 

# \- XAMPP (or similar LAMP/WAMP stack)

# \- PHP 8.0 or higher

# \- MySQL 5.7 or higher

# \- Modern web browser

# 

# \## 💻 Installation

# 

# \### 1. Clone the Repository

# 

# ```bash

# git clone https://github.com/Neric-Wizard/course-registration-system.git

# cd course-registration-system

# ```

# 

# \### 2. Set Up XAMPP

# 

# \- Install XAMPP from \[https://www.apachefriends.org](https://www.apachefriends.org)

# \- Start Apache and MySQL services

# 

# \### 3. Move Files to htdocs

# 

# Move the project folder to your XAMPP htdocs directory:

# ```

# C:\\xampp\\htdocs\\course-registration\\  (Windows)

# /Applications/XAMPP/htdocs/course-registration/  (Mac)

# /opt/lampp/htdocs/course-registration/  (Linux)

# ```

# 

# \### 4. Create Database

# 

# \- Open phpMyAdmin: `http://localhost/phpmyadmin`

# \- Create a new database named `course\_registration\_db`

# \- Import the SQL file or run this SQL:

# 

# ```sql

# CREATE DATABASE course\_registration\_db;

# USE course\_registration\_db;

# 

# -- Students Table

# CREATE TABLE students (

# &nbsp;   student\_id VARCHAR(20) PRIMARY KEY,

# &nbsp;   student\_name VARCHAR(100) NOT NULL,

# &nbsp;   email VARCHAR(100) NOT NULL UNIQUE,

# &nbsp;   password VARCHAR(255) NOT NULL,

# &nbsp;   department VARCHAR(100),

# &nbsp;   created\_at TIMESTAMP DEFAULT CURRENT\_TIMESTAMP

# );

# 

# -- Courses Table

# CREATE TABLE courses (

# &nbsp;   course\_id INT AUTO\_INCREMENT PRIMARY KEY,

# &nbsp;   course\_code VARCHAR(20) NOT NULL UNIQUE,

# &nbsp;   course\_name VARCHAR(100) NOT NULL,

# &nbsp;   credits INT NOT NULL,

# &nbsp;   instructor VARCHAR(100),

# &nbsp;   available\_slots INT NOT NULL,

# &nbsp;   total\_slots INT NOT NULL,

# &nbsp;   semester VARCHAR(20),

# &nbsp;   created\_at TIMESTAMP DEFAULT CURRENT\_TIMESTAMP

# );

# 

# -- Registrations Table

# CREATE TABLE registrations (

# &nbsp;   registration\_id INT AUTO\_INCREMENT PRIMARY KEY,

# &nbsp;   student\_id VARCHAR(20) NOT NULL,

# &nbsp;   course\_id INT NOT NULL,

# &nbsp;   registration\_date TIMESTAMP DEFAULT CURRENT\_TIMESTAMP,

# &nbsp;   status VARCHAR(20) DEFAULT 'active',

# &nbsp;   FOREIGN KEY (student\_id) REFERENCES students(student\_id) ON DELETE CASCADE,

# &nbsp;   FOREIGN KEY (course\_id) REFERENCES courses(course\_id) ON DELETE CASCADE,

# &nbsp;   UNIQUE KEY unique\_registration (student\_id, course\_id)

# );

# 

# -- Insert Sample Data

# INSERT INTO students (student\_id, student\_name, email, password, department) VALUES 

# ('STD001', 'Njeck Neric', 'njeckneric507@gmail', MD5('student123'), 'Computer Engineering'),

# ('STD002', 'Jane Smith', 'jane.smith@university.edu', MD5('student123'), 'Computer Engineering');

# 

# INSERT INTO courses (course\_code, course\_name, credits, instructor, available\_slots, total\_slots, semester) VALUES 

# ('CSC101', 'Introduction to Programming', 3, 'Dr. Anderson', 30, 30, 'Fall 2024'),

# ('CSC102', 'Data Structures', 4, 'Prof. Williams', 25, 30, 'Fall 2024'),

# ('MTH101', 'Calculus I', 3, 'Dr. Johnson', 40, 40, 'Fall 2024'),

# ('PHY101', 'Physics for Engineers', 4, 'Prof. Brown', 35, 35, 'Fall 2024'),

# ('ENG101', 'Technical Writing', 2, 'Dr. Davis', 20, 25, 'Fall 2024');

# ```

# 

# \### 5. Configure Database Connection

# 

# Edit `db\_connection.php` if needed (default XAMPP settings):

# 

# ```php

# $host = 'localhost';

# $username = 'root';

# $password = '';  // Empty for default XAMPP

# $database = 'course\_registration\_db';

# ```

# 

# \### 6. Access the Application

# 

# Open your browser and navigate to:

# ```

# http://localhost/course-registration/index.html

# ```

# 

# \## 📁 Project Structure

# 

# ```

# course-registration/

# ├── index.html                 # Login page

# ├── style.css                  # Login page styles

# ├── dashboard.php              # Student dashboard

# ├── dashboard\_style.css        # Dashboard styles

# ├── login.php                  # Login authentication

# ├── logout.php                 # Logout handler

# ├── db\_connection.php          # Database connection

# ├── register\_course.php        # Course registration logic

# ├── drop\_course.php           # Course dropping logic

# └── README.md                 # Documentation

# ```

# 

# \## 🔒 Security Features

# 

# \- \*\*Session Management:\*\* Secure session handling for user authentication

# \- \*\*SQL Injection Prevention:\*\* Using `mysqli\_real\_escape\_string()`

# \- \*\*XSS Protection:\*\* Using `htmlspecialchars()` for all output

# \- \*\*Password Hashing:\*\* MD5 hashing for passwords

# \- \*\*Authorization Checks:\*\* Page access restricted to logged-in users only

# \- \*\*Input Validation:\*\* Both client-side and server-side validation

# 

# \## 🎯 Key Functionalities

# 

# \### User Authentication

# ```php

# // Validates credentials and creates session

# session\_start();

# $\_SESSION\['logged\_in'] = true;

# $\_SESSION\['student\_id'] = $student\_id;

# ```

# 

# \### Transaction Management

# ```php

# // Ensures data integrity during registration

# $conn->begin\_transaction();

# try {

# &nbsp;   // Insert registration

# &nbsp;   // Update available slots

# &nbsp;   $conn->commit();

# } catch (Exception $e) {

# &nbsp;   $conn->rollback();

# }

# ```

# 

# \### Real-time Search

# ```javascript

# // Client-side course filtering

# function filterCourses() {

# &nbsp;   // Instant search through course list

# &nbsp;   // No page reload required

# }

# ```

# 

# \## 🚧 Future Enhancements

# 

# \- \[ ] Admin panel for course and student management

# \- \[ ] Email notifications for registration confirmations

# \- \[ ] Course prerequisites system

# \- \[ ] Maximum credit limit enforcement

# \- \[ ] Grade management

# \- \[ ] Student profile editing

# \- \[ ] Advanced filtering (by department, credits, etc.)

# \- \[ ] Course reviews and ratings

# \- \[ ] Export functionality (PDF reports)

# \- \[ ] Multi-language support

# 

# \## 🤝 Contributing

# 

# Contributions are welcome! Please feel free to submit a Pull Request.

# 

# 1\. Fork the project

# 2\. Create your feature branch (`git checkout -b feature/AmazingFeature`)

# 3\. Commit your changes (`git commit -m 'Add some AmazingFeature'`)

# 4\. Push to the branch (`git push origin feature/AmazingFeature`)

# 5\. Open a Pull Request

# 

# \## 📝 License

# 

# This project is licensed under the MIT License - see the \[LICENSE](LICENSE) file for details.

# 

# \## 👨‍💻 Author

# 

# \*\*Njeck Neric\*\*

# \- GitHub: \[@Neric-Wizard](https://github.com/Neric-Wizard)

# \- LinkedIn: \[Njeck Neric](https://linkedin.com/in/njeckneric)

# \- Email: njeckneric507@gmail.com

# 

# \## 🙏 Acknowledgments

# 

# \- Font Awesome for icons

# \- XAMPP for local development environment

# \- Inspiration from modern course management systems

# 

# \## 📞 Support

# 

# For support, email njeckneric507@gmail.com or open an issue in the GitHub repository.

# 

# ---

# 

# ⭐ Star this repository if you found it helpful!ersity Course Registration System

