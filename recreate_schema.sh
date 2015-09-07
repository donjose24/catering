mysql -u root -p -e "DROP SCHEMA catering"
mysql -u root -p -e "CREATE SCHEMA catering"
php artisan migrate
