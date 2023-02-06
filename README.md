## Simple Fitness tracker API

This is a simple personal blog to train my Laravel skills.

It's a CRUD application where you can manage your articles.

## Requirements

- PHP 8.0+
- Nodejs 16.18.0+
- Composer

## Installation

1. Clone repository
2. run commands one after the other:
    - composer install
    - composer update
    - npm install
    - php artisan key:generate
    - php artisan storage:link
3. Create a MySQL database
4. Fill in the database credentials in the .env.example file and change filename to .env
5. run commands:
    - php artisan migrate
    - php artisan db:seed
    - php artisan serve
    - npm run dev

For you to create or manage articles you need to be a logged in user. db:seed command seeds fake data into the database and creates a user.

user credentials:
- email = admin@admin.com
- password = password
