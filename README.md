# Cromwell Test Project

## Tech Stack
- Core PHP
- PostgreSQL
- jQuery / AJAX
- Bootstrap 5
- Apache (XAMPP)

## Requirements
- PHP 8+
- PostgreSQL 17
- Apache Server
- XAMPP

## Setup Steps

### 1. Clone / Copy Project
Place project inside:
D:/xampp/htdocs/cromwell-test

### 2. Enable PostgreSQL extensions in PHP
Open php.ini and enable:

extension=pgsql
extension=pdo_pgsql

Restart Apache.

### 3. Database Setup
Create database:
cromwell_test

Run SQL file:
sql/database.sql

### 4. Update Config
Update config.php with PostgreSQL credentials:

Host: localhost  
Database: cromwell_test  
Username: postgres  
Password: your_password

### 5. Run Project
Open:

http://localhost/cromwell-test/user/login.php

## Features
- User Registration
- Login Authentication
- Session Handling
- Dashboard
- User Listing
- Edit User
- Delete User
- Logout
- REST API Integration
