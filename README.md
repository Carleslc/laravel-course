# laravel-course

## Visual Studio Code

### General

```bash
Alt +/- # Move up/down current line/block
```

### Laravel

[Setup](https://medium.com/@rohan_krishna/how-to-setup-visual-studio-code-for-laravel-php-276643c3013c)

```bash
Alt + Click # Go to view/controller
```

## Laravel

**New project**: `laravel new NAME`

**[Blade](https://laravel.com/docs/master/blade)**

**[Sessions](https://laravel.com/docs/master/session)**

### [Routes](https://laravel.com/docs/master/routing)

```bash
php artisan route:list
```

### [Controllers](https://laravel.com/docs/master/controllers)

```bash
php artisan make:controller AnyController
php artisan make:controller --resource PostsController
```

### [Migrations](https://laravel.com/docs/master/migrations)

```bash
php artisan migrate
php artisan make:migration create_posts_table --create="posts"
php artisan make:migration add_is_admin_column_to_posts_table --table="posts"
php artisan migrate:rollback
php artisan migrate:reset
php artisan migrate:status
php artisan migrate:refresh # reset + migrate
```

### [Eloquent ORM](https://laravel.com/docs/master/eloquent)

#### Model

```bash
php artisan make:model Post -m # -m stands for migration
```

**[Accessors and Mutators](https://laravel.com/docs/master/eloquent-mutators)**

#### Tinker

```bash
php artisan tinker
```

### [Validations](https://laravel.com/docs/master/validation)

```bash
php artisan make:request PostRequest
```

### [Authentication](https://laravel.com/docs/6.x/authentication)

```php
composer require laravel/ui "^1.0" --dev
php artisan ui vue --auth
```

### [Authorization](https://laravel.com/docs/6.x/authorization)

```bash
php artisan make:policy PostPolicy --model=Post # Usage with 'can' middleware
php artisan make:middleware RoleMiddleware # Fresh new middleware
```

#### Maintenance mode

```bash
php artisan down
php artisan up
```

### [SCSS](https://laravel.com/docs/master/mix#sass)

```bash
# resources/sass to public/css (as per webpack.mix.js)
npm run dev
npm run watch
```