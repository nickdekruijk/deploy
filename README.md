# Deploy

Automaticaly deploy your git projects with webhooks

## Installation

Begin by installing this package with composer.

`composer require nickdekruijk/deploy`

Set `APP_DEPLOY_SECRET` in your `.env` file.
```
APP_DEPLOY_SECRET=your_secret_here
```

Also edit `app/Http/Middleware/VerifyCsrfToken.php` to skip Csrf token check on the route by adding it to the $except array
```
    protected $except = [
        '/deploy-webhook',
    ];
```

Finaly add a new webhook to github (or your git provider) with the the url https://yourdomain.com/deploy-webhook and the `APP_DEPLOY_SECRET` value.

## Deploy script
The controller will execute a shell script that does the actual deployment. By default it calls `deploy.sh` in the laravel projects root folder. You may need to set execute permission.
For example this could contain:
```
#!/bin/sh
git pull origin master
composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
php artisan migrate --force
```

## Notifications
If you want to enable email notifications for deployment errors add an emailaddress to your `.env` file with
```
APP_DEPLOY_NOTIFY_MAIL=user@domain.com
```

If you want notifications on successful deployments too and add
```
APP_DEPLOY_NOTIFY_SUCCESS=true
```

## Config
If the Defaults don't fit your project publish the config file with
```
php artisan vendor:publish --provider="NickDeKruijk\Deploy\ServiceProvider"
```

And see the config file at `/config/deploy.php` and make changes where needed.
