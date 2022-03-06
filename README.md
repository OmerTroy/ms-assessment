## Meta school assessment

### Core Fundamentals
    When a user registers, i am extracting his location via public ip, saving it in database and matching it with records while querying data.

### How it is executed
- Authentication:  added via laravel/breeze
- Public IP, Location: Api calling [http://www.geoplugin.net/php.gp](http://www.geoplugin.net/php.gp)
- Timezone: i have used [jamesmills/laravel-timezone](https://packagist.org/packages/jamesmills/laravel-timezone) before but it cant be used anymore with laravel 8+. For timezone setting, i have used php's built in date_default_timezone_set function

### Process
- Welcome page will show current user's country, tasks (public and localized) and authentcation routes.
- User has to register to be able to add tasks. 

### Setup application
Copy .env.example as .env
Set db information
> composer update\
> php artisan migrate (Note: no factories or seeders are included)\
> php artisan serve

### Things that are missing/can be improved
- Datetime is not being set when update popup shows up
- Overall application logic can be improved