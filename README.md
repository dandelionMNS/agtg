## LARAVEL SETUP

- Install composer
- Download php.zip at PHP official website
- Save it in C:php/
- Rename file php.ini-development to php.ini
- Enable comments extension:
    > openssl
    > pdo_mysql
    > zip

- if encounter error like "VCRUNTIME140.dll and MSVCP140.dll missing in Windows 11", install this ( https://aka.ms/vs/17/release/vc_redist.x64.exe )

- run "composer install" in DIR of imported project
- run 'composer require laravel/ui'
- run 'npm install'
- run 'npm run build'
- copy .env.example = paste and rename it as .env
- run "php artisan migrate"
- run "php artisan key:generate"
- run "php artisan serve"


## Basic cli syntax
- start server >> php artisan serve
- create migration file >> php artisan make:migration action_name
- migrate files >> php artisan migrate
- create controller file >> php artisan make:controller NameController
