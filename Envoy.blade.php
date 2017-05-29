@servers(['localhost' => '127.0.0.1'])


@story('deploy')
    composer
    config
    permissions
@endstory

@task('composer', ['on' => 'localhost'])
composer install
@endtask

@task('config', ['on' => 'localhost'])
php artisan vendor:publish
php artisan migrate
@endtask

@task('directories')
mkdir ./public/img/covers
mkdir storage/books
@endtask

@task('permissions', ['on' => 'localhost'])
sudo chmod 777 ./public/img/covers
sudo chmod 777 -R storage/framework
sudo chmod 777 -R storage/logs
sudo chmod 777 -R storage/books
sudo chmod 777 -R bootstrap/cache
@endtask
