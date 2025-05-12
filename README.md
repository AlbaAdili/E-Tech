# E-Tech
## Prerequisites
Before trying to run the project, please make sure you have the following installed on your machine: 
## XAMPP Setup
If you prefer an all-in-one solution and want to avoid installing Apache, PHP, and MySQL separately, you can use XAMPP, which includes all these components bundled together.
XAMPP is a free and open-source cross-platform web server solution stack package. Download XAMPP from [apachefriends.org](https://www.apachefriends.org/index.html).
### Composer
Composer is a dependency manager for PHP. Install it globally by following the instructions on [getcomposer.org](https://getcomposer.org/).
### Laravel
Ensure you have Laravel installed with a minimum version of 10. You can install Laravel globally using Composer:
`composer global require laravel/installer`

# Getting started
Build the project with the following steps:
1. Clone the repository
2. Open the project in your IDE (Visual Studio Code recommended)
3. Configure the database connection in the `.env` file (check the [Database](#database) section below for more info)
4. Run the `php artisan migrate` command in terminal to migrate the tables to the database
5. Run the `php artisan serve` command in terminal to start the project

# Database 
MySQL serves as a database for this project. Prior to configuring the database connection you have to create a database. The database connection can be configured in the `.env` file, with the appropriate values for the following properties:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```
Make sure to replace the placeholders `your_database_name`, `your_database_username`, and `your_database_password` with your actual database information.  

In case your database does not have a password, you can just leave its property as follows: 
```
DB_PASSWORD=
```

# Tests
To successfully execute the unit and integration tests implemented in the project, follow these steps:
1. Open the terminal
2. Run the `php artisan test` command
By executing the above command, you will be able to run the tests and ensure the proper functioning of the tested components.
