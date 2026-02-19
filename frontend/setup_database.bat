@echo off
echo Setting up PropHive Database...
echo.

echo 1. Creating .env file...
if not exist .env (
    copy .env.example .env
    echo .env file created successfully!
) else (
    echo .env file already exists.
)
echo.

echo 2. Generating application key...
php artisan key:generate
echo.

echo 3. Running database migrations...
php artisan migrate
echo.

echo 4. Seeding database with sample data...
php artisan db:seed
echo.

echo 5. Clearing caches...
php artisan config:clear
php artisan cache:clear
php artisan view:clear
echo.

echo Database setup completed successfully!
echo.
echo Default admin credentials:
echo Email: admin@prophive.com
echo Password: password
echo.
pause 