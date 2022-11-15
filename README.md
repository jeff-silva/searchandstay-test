# Search and Stay Test

## Run with Docker
```bash
docker-compose up
```

## Run without Docker
```bash
cp .env.example .env
composer install
php artisan key:generate
php artisan jwt:secret
php artisan app:install
php artisan serve
```

## API Documentation
http://localhost/swagger