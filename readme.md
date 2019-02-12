# Portfolio + Blog = [yarmat.su](https://yarmat.su)

This open source site was made specifically for potential customers to get acquainted with the quality of my code. This project is quite simple, but unfortunately I cannot show the code of more complex projects, because they are with the NDA (Non-disclosure agreement)

#### Beside Laravel, this project uses other tools like:
* [bootstrap 4](https://getbootstrap.com/)
* [fontawesome](https://fontawesome.com)
* [Vue.js](https://vuejs.org)
* [axios](https://github.com/axios/axios)
* [redis](https://redis.io)
* [laravel backpack](https://backpackforlaravel.com)
* [laravel comment](https://yarmat.su/en/portfolio/item/paket-kommentariev-dlya-laravel)
* [Google Recaptcha](https://www.google.com/recaptcha)
* And others that you can discover in the file "composer.json"

#### Example
[Real example](https://yarmat.su)

#### Installation
Step 1
```
git clone https://github.com/yarmat/portfolio.git ./
```

Step 2 
```php
composer install
```

Step 3
```
cp .env.example .env
```

Step 4 <br>
Editing .env
<pre>
LADA_CACHE_ACTIVE=true // https://github.com/spiritix/lada-cache

LARAVEL_PAGE_SPEED_ENABLE=true // https://github.com/renatomarinho/laravel-page-speed

ADMIN_USER_NAME=admin // Admin User Name
ADMIN_USER_EMAIL=admin@gmail.com //Admin user email
ADMIN_USER_PASSWORD=secret
ADMIN_PANEL_PREFIX=admin // f.e. blog.com/admin return admin panel

CAPTCHA_SECRET=[secret-key]
CAPTCHA_SITEKEY=[site-key]
</pre>

Step 5 
```php
php artisan key:generate
```

Step 6
```php
php artisan storage:link
```

Step 7
```php
php artisan migrate
```

Step 8
```php
php artisan db:seed
```

Step 9 <br />
Open this project in the browser

## License

This is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
