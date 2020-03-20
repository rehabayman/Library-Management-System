# Library Management System

It is a Web Application for automating the book leasing and management process of Libraries. It is implemented in Laravel and has two views the admin and user views.


# Installation

1. Install **Laravel 6.x**
2. Clone the Project
3. Run the Following Commands
	```bash
		composer install
		npm install
		cp .env.example .env
		php artisan key:generate
	```
4. Create an empty database with **the same name found in .env file** [*Initially it's named laravel - you can leave it as it is*], then run the following:
5. In the .env file fill in the `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` options to match the credentials of the database you just created. This will allow us to run migrations in the next step.
6. Run the following:
```bash
	php artisan migrate
```

## Usage

Run the following command to launch the app
```bash
php artisan serve
```

## Admin Features 

1. CRUD Operations on Users / Admins.
2. CRUD Operations on Books.
3. CRUD Operations on Book Categories.
4. Activate/Deactivate Users.
5. View a Profit Chart.

## User Features

1. Update his Profile Data.
2. Lease Books.
3. View Books.
	a. Order by: rate / latest.
	b. Search by: title / author.
	c. Filter by Category 
4. Rate Books.
5. Add / Remove Books from his Favorites.
6. Add / Delete Comments on Books.


## Authors

1. [Mohamed Adham](https://github.com/mohamedadham)
2. [Mohamed Tarek](https://github.com/M-tarek93)
3. [Rehab Ayman](https://github.com/rehabayman)
4. [Mohamed Zakaria](https://github.com/Mohamed-Zkaria)
5. [Nouran M.Yehia](https://github.com/Nouran-yehia)
