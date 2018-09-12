installation
* read laravel installation steps (version: 5.5+)
* install php version > 7
* install composer
* git clone project
* run command: composer install
* run command: npm install
* copy .env-example .env
* run command: php artisan key:generate
* modify database info in .env
* run command: php artisan serve
if using Mac + Mysql 8.0+ and phpMyAdmin login error
try 
- mysql -uroot -p
- enter password
- type: use mysql;
- type: alter user 'username'@'localhost' identified with mysql_native_password by 'password';
