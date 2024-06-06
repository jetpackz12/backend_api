
# Install Composer Dependencies

```
composer install
```

# Set Up Environment Variables

```
cp .env.example .env
```

# Generate an Application Key

```
php artisan key:generate
```

# Set Up the Database

```
php artisan migrate
```

# Serve the Application

```
php artisan serve --host=10.0.0.224 --port=6969
```
