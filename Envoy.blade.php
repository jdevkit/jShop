@servers(['localhost' => '127.0.0.1'])


<?php
$dir = __DIR__;
?>
@story('deploy')
    composer
    config
    permissions
@endstory

@task('composer', ['on' => 'localhost'])
<?php

$composer = $dir . '/composer.json';
$current = file_get_contents($composer);
$current = str_replace('"laravel/tinker": "~1.0"',
    '"laravel/tinker": "~1.0",
    "zizaco/entrust": "5.2.x-dev"', $current);
file_put_contents($composer, $current);
?>
composer update

@endtask

@task('config', ['on' => 'localhost'])
php artisan entrust:migration
<?php
$file = $dir . '/config/app.php';
$current = file_get_contents($file);
$current = str_replace('App\Providers\RouteServiceProvider::class,',
    "App\Providers\RouteServiceProvider::class,
        Zizaco\Entrust\EntrustServiceProvider::class,", $current);
$current = str_replace("'View' => Illuminate\Support\Facades\View::class,",
    "'View' => Illuminate\Support\Facades\View::class,
        'Entrust'   => Zizaco\Entrust\EntrustFacade::class,",$current);
file_put_contents($file, $current);

$middlewares = $dir . '/app/Http/Kernel.php';
$current = file_get_contents($middlewares);
$current = str_replace("'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,",
    "'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'role' => \Zizaco\Entrust\Middleware\EntrustRole::class,
        'permission' => \Zizaco\Entrust\Middleware\EntrustPermission::class,
        'ability' => \Zizaco\Entrust\Middleware\EntrustAbility::class,", $current);
file_put_contents($middlewares, $current);
?>
php artisan vendor:publish
php artisan migrate
@endtask

@task('permissions', ['on' => 'localhost'])
sudo chmod 777 -R storage/framework
sudo chmod 777 -R storage/logs
sudo chmod 777 -R bootstrap/cache
composer global require "acacha/adminlte-laravel-installer=~3.0"
php artisan make:auth
adminlte-laravel install
@endtask
