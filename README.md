# 🎓 University Course Registration System

A modern, full-featured web application for managing university course registrations. Built with PHP, MySQL, and vanilla JavaScript with a focus on user experience and clean code architecture.

![Course Registration System](https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-5.7-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-ES6-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)
![Docker](https://img.shields.io/badge/Docker-2496ED?style=for-the-badge&logo=docker&logoColor=white)

## ✨ Features

### 🔐 Authentication & Security
- Secure login system with session management
- Password hashing (MD5)
- SQL injection prevention
- XSS protection with input sanitization
- Session-based authorization

### 📚 Course Management
- **View Available Courses** - Browse all courses with available slots
- **Course Registration** - Register for courses with real-time slot updates
- **Drop Courses** - Remove unwanted courses with automatic slot recovery
- **Search & Filter** - Find courses quickly using the search functionality
- **Duplicate Prevention** - System prevents registering for the same course twice

### 📊 Student Dashboard
- Personal statistics cards (Registered Courses, Total Credits, etc.)
- Real-time course availability tracking
- Registration history with timestamps
- Intuitive user interface with modern design

### 🎨 User Experience
- Responsive design (works on mobile, tablet, and desktop)
- Smooth animations and transitions
- Loading states and progress indicators
- Toast notifications for user feedback
- Confirmation dialogs for critical actions
- Live search with instant results

## 🚀 Demo

**Test Credentials:**
- Student ID: `STD001`
- Password: `student123`

## 🛠️ Technology Stack

**Frontend:**
- HTML5
- CSS3 (with modern features: Grid, Flexbox, Animations)
- Vanilla JavaScript (ES6+)
- Font Awesome Icons

**Backend:**
- PHP 8.2
- MySQL 8.0

**DevOps:**
- Docker
- Docker Compose

**Server:**
- Apache (via PHP Docker image)

## 🐳 Docker Deployment (Recommended)

This project is fully containerized with Docker for easy deployment and scalability.

### Prerequisites
- Docker Desktop installed ([Download here](https://www.docker.com/products/docker-desktop))

### Quick Start with Docker

**1. Clone the Repository:**
```bash
git clone https://github.com/Neric-wizard/course-registration-system.git
cd course-registration-system
```

**2. Start the Application:**
```bash
docker-compose up -d
```

**3. Access the Application:**
- **Web Application:** http://localhost:8080/index.html
- **phpMyAdmin:** http://localhost:8081
  - Server: `db`
  - Username: `root`
  - Password: `root_password`

**4. Login:**
- **Student ID:** `STD001`
- **Password:** `student123`

### Docker Architecture

The application runs in 3 Docker containers:

```
┌─────────────────┐     ┌──────────────┐     ┌─────────────────┐
│   Web Server    │────▶│   MySQL DB   │◀────│  phpMyAdmin     │
│  (PHP/Apache)   │     │              │     │                 │
│   Port: 8080    │     │  Port: 3307  │     │   Port: 8081    │
└─────────────────┘     └──────────────┘     └─────────────────┘
```

- **Web Server** (PHP 8.2 + Apache) - Port 8080
- **MySQL Database** (MySQL 8.0) - Port 3307
- **phpMyAdmin** (Database Management) - Port 8081

All containers communicate through a Docker network with persistent data storage.

### Docker Commands

**Start containers:**
```bash
docker-compose up -d
```

**Stop containers:**
```bash
docker-compose down
```

**View logs:**
```bash
docker-compose logs
```

**View specific service logs:**
```bash
docker-compose logs web
docker-compose logs db
```

**Rebuild after code changes:**
```bash
docker-compose up -d --build
```

**Access container shell:**
```bash
docker exec -it course-registration-web bash
```

**Reset database (delete all data):**
```bash
docker-compose down -v
docker-compose up -d
```

### Benefits of Docker Deployment

✅ **Consistent Environment** - Same setup on any machine  
✅ **Easy Setup** - One command to start everything  
✅ **Isolated** - No conflicts with local installations  
✅ **Scalable** - Easy to add more containers  
✅ **Portable** - Deploy anywhere Docker runs  
✅ **Production Ready** - Enterprise-level deployment

## 💻 Traditional Installation (Without Docker)

### Prerequisites
- XAMPP (or similar LAMP/WAMP stack)
- PHP 8.0 or higher
- MySQL 5.7 or higher
- Modern web browser

### Installation Steps

**1. Clone the Repository:**
```bash
git clone https://github.com/Neric-wizard/course-registration-system.git
cd course-registration-system
```

**2. Set Up XAMPP:**
- Install XAMPP from [https://www.apachefriends.org](https://www.apachefriends.org)
- Start Apache and MySQL services

**3. Move Files to htdocs:**
```
C:\xampp\htdocs\course-registration\  (Windows)
/Applications/XAMPP/htdocs/course-registration/  (Mac)
/opt/lampp/htdocs/course-registration/  (Linux)
```

**4. Create Database:**
- Open phpMyAdmin: `http://localhost/phpmyadmin`
- Create a new database named `course_registration_db`
- Run the SQL from `init.sql` file

**5. Configure Database Connection:**

Edit `db_connection.php`:
```php
$host = 'localhost';
$username = 'root';
$password = '';  // Empty for default XAMPP
$database = 'course_registration_db';
```

**6. Access the Application:**
```
http://localhost/course-registration/index.html
```

## 📁 Project Structure

```
course-registration/
├── Dockerfile                 # Docker configuration for PHP/Apache
├── docker-compose.yml         # Multi-container orchestration
├── init.sql                   # Database initialization script
├── .dockerignore             # Docker ignore file
├── index.html                # Login page
├── style.css                 # Login page styles
├── dashboard.php             # Student dashboard
├── dashboard_style.css       # Dashboard styles
├── login.php                 # Login authentication
├── logout.php                # Logout handler
├── db_connection.php         # Database connection
├── register_course.php       # Course registration logic
├── drop_course.php          # Course dropping logic
└── README.md                # Documentation
```

## 🔒 Security Features

- **Session Management:** Secure session handling for user authentication
- **SQL Injection Prevention:** Using `mysqli_real_escape_string()`
- **XSS Protection:** Using `htmlspecialchars()` for all output
- **Password Hashing:** MD5 hashing for passwords
- **Authorization Checks:** Page access restricted to logged-in users only
- **Input Validation:** Both client-side and server-side validation
- **Database Transactions:** Ensures data integrity during operations

## 🎯 Key Functionalities

### User Authentication
```php
// Validates credentials and creates session
session_start();
$_SESSION['logged_in'] = true;
$_SESSION['student_id'] = $student_id;
```

### Transaction Management
```php
// Ensures data integrity during registration
$conn->begin_transaction();
try {
    // Insert registration
    // Update available slots
    $conn->commit();
} catch (Exception $e) {
    $conn->rollback();
}
```

### Real-time Search
```javascript
// Client-side course filtering
function filterCourses() {
    // Instant search through course list
    // No page reload required
}
```

## 🚧 Future Enhancements

- [ ] Admin panel for course and student management
- [ ] Email notifications for registration confirmations
- [ ] Course prerequisites system
- [ ] Maximum credit limit enforcement
- [ ] Grade management system
- [ ] Student profile editing
- [ ] Advanced filtering (by department, credits, etc.)
- [ ] Course reviews and ratings
- [ ] Export functionality (PDF reports)
- [ ] Multi-language support
- [ ] CI/CD pipeline integration
- [ ] Kubernetes deployment

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

1. Fork the project
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 👨‍💻 Author

**Njeck Neric**
- GitHub: [@Neric-wizard](https://github.com/Neric-wizard)
- LinkedIn: [Njeck Neric](https://linkedin.com/in/njeckneric)
- Email: njeckneric507@gmail.com

## 🙏 Acknowledgments

- Font Awesome for icons
- Docker community for containerization best practices
- XAMPP for local development environment
- Inspiration from modern course management systems

## 📞 Support

For support, email njeckneric507@gmail.com or open an issue in the GitHub repository.

---

⭐ **Star this repository if you found it helpful!**

💼 **Open for opportunities** - Feel free to reach out for collaborations or job opportunities!