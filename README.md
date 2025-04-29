<p align="center"><a href="https://laravel.com" target="_blank"><img src="[![sms.png](https://i.postimg.cc/5tQ86sqD/sms.png)](https://postimg.cc/jWKD1Q1h)" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>


# 🎓 School Management System

A comprehensive Laravel-based application to manage users, students, classes, fees, exams, and more — tailored for educational institutions.

---

## 🚀 Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/ukamal/schoolmenegementsystem
   cd schoolmenegementsystem
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install && npm run dev
   ```

3. **Set up environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database setup**
   - Configure `.env` with your database details.
   - Run migrations:
     ```bash
     php artisan migrate
     ```

5. **Serve the app**
   ```bash
   php artisan serve
   ```

---

## ⚙️ Requirements

- PHP ^7.3 or ^8.0  
- Laravel ^8.12  
- MySQL database

---

## ✅ Features

- **User Management** (Admin role-based access)
- **Student Management**
  - Registration, Roll generation, Fees (registration/monthly/exam)
- **Employee Management**
- **Profile Settings** (Edit, password change)
- **Academic Setup**
  - Class, Year/Session, Group, Shift
  - Subjects, Assign Subjects, Exam Types
  - Fee Categories & Amounts
  - Designations
- **Product Management** (inventory or educational items)
- **PDF Export Support** (via `niklasravnsborg/laravel-pdf`)
