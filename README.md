# jukebox
Single page application assignment for school.


Make sure you setup the .env file correclty with a database.

Install js packages:
```
$ npm install
```
Install composer project dependencies.
```
$ composer install
```

Migrate/seed the database:
```
$ php artisan migrate

//use '--seed' if you want dummy data
$ php artisan migrate --seed
```

Make sure the application is run via a vhost.