# Laravel Test Project

This is a Laravel-based test project. Follow the instructions below to get the project up and running locally.

## Requirements

Before you begin, ensure you have the following installed on your machine:

- PHP (>= 8.2)
- Composer
- Laravel Installer
- Database MySQL

## Setup Instructions

1. **Clone the repository**

   First, clone the repository to your local machine.

   ```bash
   git clone https://github.com/hasanhasanzadeh/project-test.git
   cd project-test
   composer install
   cp .env.example .env
   php artisan key:generate
   php artisan migrate --seed
   php artisan schedule:run
   php artisan serve
   npm install && npm run dev
   
   mobile : 0911111111111
   password: 12345678
   
