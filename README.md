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

**[Blade](https://laravel.com/docs/master/blade)**

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

#### Tinker

```bash
php artisan tinker
```

### [Validations](https://laravel.com/docs/master/validation)

```bash
php artisan make:request PostRequest
```