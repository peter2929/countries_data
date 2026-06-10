# Countries data

In .env set credentials (you can just rename .env.example to .env)

Launch docker compose (might need sudo)
```
docker compose up -d --build
docker compose exec php php artisan key:generate
```

Run migrations
```
docker compose exec php php artisan migrate
```

Open the app
```
http://localhost:8080/
```

Launch tests
```
docker compose exec php php artisan test
```

AI was used to create Docker configuration.
