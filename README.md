# Deploy

Automaticaly deploy your git projects with webhooks

## Installation

Begin by installing this package with composer.

`composer require nickdekruijk/deploy`

Set `APP_DEPLOY_SECRET` in your `.env` file.

Also edit `app/Http/Middleware/VerifyCsrfToken.php` to skip Csrf token check on the route by adding it to the $except array
```
    protected $except = [
        '/deploy-webhook',
    ];
```

## Deploy script
The controller will execute a shell script that does the actual deployment. By default it calls `deploy.sh` in the laravel projects root folder.
For example this could contain:
```
#!/bin/sh
git pull origin master
composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
php artisan migrate --force
```

## Config
If the Defaults don't fit your project publish the config file with

```php artisan vendor:publish --provider="NickDeKruijk\Deploy\ServiceProvider"```

And see the config file at `/config/deploy.php` and make changes where needed.
