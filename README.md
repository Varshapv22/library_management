<h1>Laravel Library Management System</h1>

composer create-project --prefer-dist laravel/laravel library-management  (laravel 9 version)

<h2>Default Authentication</h2>
composer require laravel/breeze --dev
php artisan breeze:install
npm run dev
php artisan migrate

<h2>Controllers</h2>
php artisan make:controller BookController
php artisan make:controller AdminController

<h2>Seeding Admin Credentials</h2>
php artisan make:seeder BookSeeder
php artisan db:seed

<h2>creating tables</h2>
php artisan make:migration create_books_table

<h2>Rolemiddleware creation</h2>
php artisan make:middleware RoleMiddleware

<h2>Model crreation</h2>
php artisan make:model Book

<h2>creating job for csv file upload</h2>
php artisan make:job ProcessBookCsv

<h2>Mail configuration</h2>
php artisan make:mail OverdueNotification

 composer require maatwebsite/excel:^3.1 
