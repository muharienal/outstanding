# Laravel V9 Starter With VELZON Dashboard

## Install

```bash
git clone https://github.com/b0rnt0ber00t/laravel-v9-starter-velzon.git
cd laravel-v9-starter-velzon
composer install && yarn
cp .env.example .env
php artisan key:generate
```

## Database Config

```text
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=root
```

## Migrate Database

```bash
php artisan migrate:fresh --seed
```

## Feature

-   General Setting
-   User Management
-   Menu Management
-   Route Management
-   Role Management
-   Permission Management

## Start Serve

```bash
php artisan serve
```

## Default User Login

```text
Username: superadmin@gmail.com
Password: password
Role: Super Admin

Username: user@gmail.com
Password: password
Role: User
```
