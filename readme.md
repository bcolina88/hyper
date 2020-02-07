# Trip-App

## Installation

#### Dependencies:

* Composer
* PHP >= 5.6

- Clone the repository and run `composer install` once installed.

- Create database with the name `trip-app` and collation `utf8_general_ci`

- Create the .env file, you can see the .env.example file now add your db credential in it.

```bash
  DB_DATABASE= ?
  DB_USERNAME= ?
  DB_PASSWORD= ?
 ```

- Set the application key.

 ```bash
 $ php artisan key:generate
 ```
 
 - Generate autoload files classes.

 ```bash
 $ composer dump-autoload
 ```

- Run artisan migrate and seeder.

 ```bash
 $ php artisan migrate:refresh --seed
 ```
 
- Run application.

```bash
 $ php artisan serve
 ```
 
 GraphQL : [http://127.0.0.1:8000/graphiql] o [http://localhost:8000/graphiql]