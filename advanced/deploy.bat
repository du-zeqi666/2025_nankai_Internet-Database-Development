@echo off
echo Starting War Memorial Project Deployment...

echo 1. Installing Composer Dependencies...
call composer install

echo 2. Initializing Yii2 Framework (Development Environment)...
call php init --env=Development --overwrite=All

echo 3. Applying Database Migrations...
call php yii migrate --interactive=0

echo 4. Importing Initial Data...
mysql -u root -p advanced < data/install.sql

echo 5. Deployment Complete!
echo Please access the frontend at http://localhost/advanced/frontend/web/
pause
