## Go Queer ##



**Go Queer** is a platform to make your geo-caching game 

### Installation ###
* `install php & composer & git`
* `git clone https://github.com/bamzy/goQueer2.git projectname`
* `cd projectname`
* `composer install`
* `php artisan key:generate`
* Create a local database and update *.env* by setting DB_CONNECTION,DB_HOST,DB_PORT,DB_DATABASE,DB_USERNAME,DB_PASSWORD
* `php artisan migrate --seed` to create and populate tables
* Inform *config/mail.php* for email sends
* `php artisan vendor:publish` to publish filemanager
* `php artisan serve` to start the app on http://localhost:8000/




### Include ###

* [HTML5 Boilerplate](http://html5boilerplate.com) for front architecture
* [Bootstrap](http://getbootstrap.com) for CSS and jQuery plugins
* [Font Awesome](http://fortawesome.github.io/Font-Awesome) for the nice icons
* [Leaflet](http://leaflet.com) the great drawing tool for maps


### Features ###

* Home page
* Custom Error Page 404
* Authentication (registration, login, logout, password reset, mail confirmation, throttle)
* Add Media
* Define Locations/Polygons on maps
* Leave Comments on resources

### Packages included ###

* laravelcollective/html


