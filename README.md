# Laravel Task Manager

A role-based task management application built with **Laravel**, **PostgreSQL**, **Blade**, and **Laravel Sanctum**.

The project provides a web interface for managing tasks, user authentication, role-based access, task assignments, task relationships, and a RESTful API.

The application was built with a layered architecture to keep routing, validation, authorization, business logic, and persistence separated.

---

## Features

### Authentication

- User registration
- User login
- User logout
- Session-based authentication for the web application
- API authentication using Laravel Sanctum
- Password hashing using Laravel's built-in password hashing support
- CSRF protection for web forms

### Task Management

- Create tasks
- View tasks
- Delete tasks
- Task descriptions
- Task priorities
- Task statuses
- Due dates
- Parent tasks and subtasks

### User Roles

The application currently supports two roles:

- **Admin**
- **Member**

#### Member

Members can:

- View their tasks
- Create their own tasks
- View tasks assigned to them
- Delete tasks when authorized

#### Admin

Admins can:

- Access the admin task interface
- Create tasks
- Assign tasks to members
- View their own created tasks
- View assigned tasks

# Installation

## 1. Clone the repository

```bash
git clone https://github.com/Amirreza-Mahdavi/laravel-task-manager.git
```

Move into the project:

```bash
cd laravel-task-manager
```

---

## 2. Install PHP dependencies

```bash
composer install
```

---

## 4. Create the environment file

```bash
cp .env.example .env
```

Generate the Laravel application key:

```bash
php artisan key:generate
```

---

# Database Configuration

The project uses PostgreSQL.

Create a PostgreSQL database, for example:

```text
task_manager
```

Then configure your `.env` file:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=task_manager
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

Update the credentials to match your local PostgreSQL installation.

---

# Run Migrations

After configuring the database:

```bash
php artisan migrate
```

This creates the required database tables.

---

# Creating Roles and Users

The application uses roles such as:

```text
admin
member
```

Start Tinker:

```bash
php artisan tinker
```

Create the roles:

```php
$adminRole = App\Models\Role::create([
    'name' => 'admin',
]);

$memberRole = App\Models\Role::create([
    'name' => 'member',
]);
```

Create an admins:

```php
$admin = App\Models\User::create([
    'role_id' => $adminRole->id,
    'name' => 'Admin',
    'email' => 'admin@example.com',
    'password' => 'password123',
]);
```

Create a member:

```php
$member = App\Models\User::create([
    'role_id' => $memberRole->id,
    'name' => 'John Member',
    'email' => 'member@example.com',
    'password' => 'password123',
]);
```

---

# Running the Application

Start the Laravel development server:

```bash
php artisan serve
```

The application will normally be available at:

```text
http://127.0.0.1:8000
```

---
