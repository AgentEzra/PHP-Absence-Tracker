# PHP Absence Tracker

A web-based absence management system built with pure PHP for tracking attendance and managing absences in educational or workplace environments.

## 🚀 Status: Ongoing Development

> Currently under active development with core features implemented.

## ✨ Features

### ✅ **Implemented**
- **User Authentication**
  - Registration system
  - Login/Logout functionality
  - Forgot password with reset
  - Session-based security

- **Dashboard**
  - Role-based views (Admin/Teacher/Student)
  - Quick statistics overview
  - Recent activity display

- **Admin Panel**
  - CRUD operations for users
  - Manage all attendance records
  - System configuration

- **Absence Management**
  - Request absence with reasons
  - View personal absence history
  - Filter by date range

- **Data Export**
  - Export attendance data to CSV
  - Printable reports

### 🔧 **Planned Features**
- Email notifications for approvals
- Advanced reporting with charts
- Bulk absence approval/rejection
- Calendar view integration
- Mobile-responsive improvements

## 🛠️ Technology Stack

- **Backend:** PHP (Pure, no framework)
- **Database:** MySQL
- **Frontend:** HTML, CSS, JavaScript, Bootstrap
- **Server:** Apache/XAMPP
- **Version Control:** Git/GitHub

## 📁 Project Structure
```
/absence-tracker/
├── assets/          # CSS, JS, Images
├── includes/        # Configurations & Functions
├── admin/           # Admin Panel
├── teacher/         # Teacher Panel
├── student/         # Student Panel
├── auth/            # Authentication pages
├── reports/         # Export & Reports
└── index.php        # Main entry point
```

## 🚦 Getting Started

### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache web server
- XAMPP/WAMP/LAMP stack

### Installation
1. Clone the repository:
   ```bash
   git clone https://github.com/AgentEzra/php-absence-tracker.git
   ```
2. Import database:
   - Navigate to `database/` folder
   - Import `absence_tracker.sql` to MySQL
3. Configure database connection:
   - Edit `includes/config.php`
   - Update database credentials
4. Access the application:
   - Open browser to `http://localhost/absence-tracker`

## 👥 User Roles

1. **Administrator**
   - Full system control
   - Manage all users
   - Generate system reports

2. **Teacher/Manager**
   - Approve/Reject absence requests
   - View team/department attendance
   - Export attendance data

3. **Student/Employee**
   - Request absences
   - View personal attendance
   - Check attendance percentage

## 📊 Database Schema
Key tables include:
- `users` - User accounts and profiles
- `attendance` - Daily attendance records
- `absence_requests` - Absence applications
- `courses/departments` - Organizational units

## 🔐 Security Features
- Password hashing (bcrypt)
- SQL injection prevention (prepared statements)
- XSS protection
- Session management
- Role-based access control

## 📈 Export Features
- Export to CSV format
- Filter by:
  - Date range
  - User/Department
  - Attendance status
- Printable attendance sheets

## 🤝 Contributing
1. Fork the repository
2. Create a feature branch
3. Commit your changes
4. Push to the branch
5. Open a Pull Request

## 📝 License
This project is open-source and available for educational purposes.

## 👨‍💻 Author
**AgentEzra**  
GitHub: [@AgentEzra](https://github.com/AgentEzra)

## 📞 Support
For issues, questions, or suggestions:
- Open an issue on GitHub
- Check the wiki for documentation

---

*Last Updated: December 13, 2025*  
*Project Status: Actively maintained*
