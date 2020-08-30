## How to run this app?

1. Download this package to your computer and save in directory.
1. Make sure you have installed composer and laravel.
1. Run Apache and Mysql database in your Xampp controll panel.
1. Run script from directory (sql/script.sql) in Mysql database.
1. Find ".env.example" file then duplicate it and rename to ".env". 
1. Open ".env" file and change settings to
    DB_DATABASE=articles
    DB_USERNAME=article_user
    DB_PASSWORD=1234
1. Open directory with your project and type: "php artisan migrate" and then run "php artisan serve" in your command line.
1. Then open URL "localhost:8000" in your browser.

## How to use this app?

If you want to add some articles you need to have an account. You can simply create one by typing your name, email and password. Then feel free to create and edit your articles. Every features are available for you in navigation bar. App is fully responsive.

## Database
Structure of database is saved in database/migrations directory.