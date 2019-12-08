# Deploy

Automaticaly deploy your git projects with webhooks

## Installation

Begin by installing this package with composer.

`composer require nickdekruijk/deploy`

Set `APP_DEPLOY_SECRET` in your `.env` file.

Also edit `app/Http/Middleware/VerifyCsrfToken.php` to skip Csrf token check on the route by adding it to the $except array
```
    protected $except = [
        [ config('deploy.route') ],
    ];
```

## Config
If the Defaults don't fit your project publish the config file with

```php artisan vendor:publish --provider="NickDeKruijk\Deploy\ServiceProvider"```

And see the config file at `/config/deploy.php` and make changes where needed.
