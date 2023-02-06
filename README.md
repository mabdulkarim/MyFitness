## Simple Fitness tracker API

I built this API to gain deeper knowledge about Laravel-powered APIs and to track my personal fitness progress. Despite the abundance of fitness tracking apps, I wanted to create my own so I could learn more about APIs and customize it to my specific needs.

I will use Laravel as my backend server.

## Requirements

- PHP 8.0+
- Postman or other tools to make requests.
- Composer

## Installation

1. Clone repository
2. Create a MySQL database
3. Fill in the database credentials in the .env.example file and change filename to .env
4. run commands:
    - php artisan migrate
    - php artisan db:seed
    - php artisan serve

To create or manage exercises or workouts, authentication is required. Upon logging in, you will receive a response with a token. A pre-configured account will also be available for use when seeding data. Please see the credentials below.

user credentials:
- email = admin@admin.com
- password = password

## Database structure
![image](https://user-images.githubusercontent.com/69695051/217008437-c41142dc-01dd-4ef3-820c-9b29a9db49a2.png)
