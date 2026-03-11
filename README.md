# Todo List Application

A PHP + MySQL todo list app. Tasks persist permanently across browser reopens.

## Requirements
- PHP 7.4+
- MySQL 5.7+ (via XAMPP, WAMP, MAMP, or Laragon)

## Setup — Database First

### Option A — phpMyAdmin
1. Open http://localhost/phpmyadmin
2. Click **Import** → choose `setup.sql` → click **Go**

### Option B — MySQL CLI
```bash
mysql -u root -p < setup.sql
```

## Configure DB Connection

Open `db.php` and update if needed:
```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'todo_app');
define('DB_USER', 'root');
define('DB_PASS', '');   // your MySQL password
```

## Run Locally

### PHP Built-in Server
```bash
cd todo-app
php -S localhost:8000
```
Open: http://localhost:8000

### XAMPP / WAMP
Copy folder into `htdocs/` or `www/`, start Apache + MySQL, open http://localhost/todo-app

## File Structure
```
todo-app/
├── index.php       # Controller + HTML view
├── TaskManager.php # MySQL CRUD via PDO
├── db.php          # DB connection config
├── setup.sql       # Run once to create DB + table
├── style.css       # Styling
├── app.js          # Inline edit toggle
└── README.md
```
