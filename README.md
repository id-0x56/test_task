```
git clone git@github.com:id-0x56/test_task.git
```
```
cd test_task && cp .env.example .env
```
```
composer install
```
```
./vendor/bin/sail up -d
```
```
./vendor/bin/sail artisan key:generate
```
```
./vendor/bin/sail php artisan migrate:refresh --seed
```
```
./vendor/bin/sail php artisan queue:work
```
