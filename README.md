set up server by running `docker-compose up -d --build site`

- **nginx** - `:80`
- **mysql** - `:3306`
- **php** - `:9000`

to fill DB with test data run `php artisan migrate --seed` 

/api/documentation - Swagger API documentation