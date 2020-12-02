# Laravel 5.6 + CoreUI Admin Bootstrap Template VueJS


### Installation


1. Install dependencies

````
composer install
````

2. Copy .env file

```
cp .env.example .env
```

3. Modify `DB_*` value in `.env` with your database config.

4. Generate application key:

````
php artisan key:generate
````

5. Generate autoload files classes.

```bash
$ composer dump-autoload
```

6. Migrate
````
php artisan migrate:refresh --seed
````

7. Install Node modules
````
npm install
````

8. Build

````
npm run prod
````

