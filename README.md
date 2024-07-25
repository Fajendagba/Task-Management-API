# Task Management API

## Overview
This Task Management API is built using Laravel, providing a robust API for managing tasks with user authentication. The system includes endpoints for task creation, updating, deletion, and listing, all protected by Laravel Sanctum for secure access.

## Features
- User Registration and Authentication
- Task Management: Create, Update, Delete, List, and View Tasks
- API Documentation

## Installation

1. **Clone the repository:**
    ```sh
    git clone https://github.com/yourusername/task-management-api.git
    cd task-management-api
    ```

2. **Install dependencies:**
    ```sh
    composer install
    ```

3. **Create a `.env` file:**
    ```sh
    cp .env.example .env
    ```

4. **Generate application key:**
    ```sh
    php artisan key:generate
    ```

5. **Set up your database credentials in the `.env` file:**
    ```dotenv
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
    ```

6. **Run database migrations:**
    ```sh
    php artisan migrate
    ```

7. **Start the development server:**
    ```sh
    php artisan serve
    ```

## Postman Collection
You can find the Postman collection for testing the API (https://elements.getpostman.com/redirect?entityId=18182167-dab8b14a-6f60-4f1a-a447-7c473c2a5288&entityType=collection).

## Testing
To run the tests, use the following command:
```sh
php artisan test


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
