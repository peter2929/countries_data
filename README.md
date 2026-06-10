# Countries data

In .env set credentials (you can just rename .env.example to .env)

Launch docker compose (might need sudo)
```
docker compose up -d --build
```

Run migrations
```
docker compose exec php php artisan migrate
```

Open the app
```
http://localhost:8080/
```

