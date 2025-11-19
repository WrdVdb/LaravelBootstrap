#Multilingual laravel 12 - bootstrap 5.3 site start

##How to install

```
cp default.env .env
php artisan key:generate
composer install
npm install
```

##Laravel mix

Build css (from scss resources/scss/app.scss) and javascript (from resources/js/app.js)

```
npm run build
```
Or watch the files for changes
```
npm run watch
```

##Run site

```
php artisan serve
```