# To do list RESTful API

## Description:

This Laravel 11 project serves RESTful API for managing a list of tasks (to-do list). The API provides functionality to add, view (one task/ All Tasks With Filters), edit, and delete tasks, as well as assign tasks to users. Each task have a title, description, due date, and status (e.g.,
"Pending", "Blocked", "In Progress", "Completed"), JWT, role-based access control, only users with the "admin" role can manage users, phpunit for unit testing, only one test case implemented inside the tests folder. It is designed to Software Developer Role - Test Assignment -
Backend.

### Installation:

Clone the repository: `git clone git@github.com:mfoq/To-do-list.git`

Navigate to the project directory

Install dependencies: `composer install`

Copy .env.example to .env

Generate application key: php artisan key:generate

Set up your database connection in the .env file.

Run migrations: `php artisan migrate`

Seed the database: `php artisan db:seed`


### Usage:

Serve the application: `php artisan serve`

Access the application in your browser at http://localhost:8000

To run the tests:

`./vendor/bin/phpunit`

### Postman Collections endpoints :
Auth collection => `https://documenter.getpostman.com/view/24865549/2sA3QqfCV2` 

Task collection => `https://documenter.getpostman.com/view/24865549/2sA3QqfCV4` 

User collection => `https://documenter.getpostman.com/view/24865549/2sA3QqfCV5` 

### Author:

Mahmood Alfoqahaa

### Contact:

mahmood_alfoqahaa@yahoo.com
