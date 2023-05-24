# laravel-user-status-v1
### A Simple Library for Handle User Status for Laravel Project v1

-------
## Requires
- [laravel/framework](https://github.com/laravel/framework/) v^10.0
- [thebachtiarz-company/laravel-base-v1](https://github.com/thebachtiarz-company/laravel-base-v1/) v^1.x
- [thebachtiarz-company/laravel-auth-v1](https://github.com/thebachtiarz-company/laravel-auth-v1) v^2.x

## Installation
- composer config (only if you have access)
```bash
composer config repositories.thebachtiarz-company/laravel-user-status-v1 git git@github.com:thebachtiarz-company/laravel-user-status-v1.git
```

- install repository
```bash
composer require thebachtiarz-company/laravel-user-status-v1
```

- vendor publish
```bash
php artisan vendor:publish --provider="TheBachtiarz\UserStatus\ServiceProvider"
```

- database migration
``` bash
php artisan migrate
```

- application refresh
``` bash
php artisan thebachtiarz:base:app:refresh
```

- create default status
``` bash
php artisan thebachtiarz:userstatus:generate:default
```

-------
## Feature

> sek males nulis cak :v
-------
