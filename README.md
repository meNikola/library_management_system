# Library Management System App 'Nikola Kovacevic'

This is my example solution for the `The Unit` job assignment.

## Installation

### Step 1.

Begin by cloning this repository to your machine, and installing all Composer dependencies.

```bash
https://github.com/meNikola/library_management_system.git
cd library_management_system && composer install
php artisan key:generate
copy .env.example .env
```

### Step 2.

Next, create a new database and reference its name and username/password within the project's `.env` file. In the example below. I named the database, `library_management_system`.

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=library_management_system
DB_USERNAME=root
DB_PASSWORD=
```
