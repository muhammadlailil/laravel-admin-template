<div align="center">
    <h2>Base Admin Template Using Tailwind For Laravel</h2>
</div>
<br/>

## Installation

- Copy all folder and file to your fresh laravel
- Copy this code and paste info composer.json autoload-dev under psr-4 config

```code
"files": [
     "app/Helpers/helper.php"
]
```
- Run composer dump-autoload
```sh
composer dump-autoload
```
- Connect to your database and run database migration
```sh
php artisan migrate
```