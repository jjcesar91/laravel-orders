# Laravel Orders Demo

**Laravel Orders** is a demo webapp built with Laravel 8 that simulates the management of orders, customers, agents, warehouses, and products, without any database required. All data is managed via JSON files, making the project plug-and-play and easily deployable on Railway or any PHP hosting.

## Main Features

- **Login & Registration**: Demo authentication with data stored in `storage/demo-data/users.json`.
- **Order Management**: View orders, details, status, amounts, and related customers.
- **Customer & Agent Management**: Customer and agent registry, all from JSON files.
- **Warehouse & Product Management**: View products, quantities, prices, and warehouses.
- **Filters & Search**: Filter orders by agent, customer, status, price, completion percentage.
- **No Database Needed**: No MySQL connection required, perfect for showcase and testing.
- **Plug-and-play Deploy**: Ready for Railway, just connect the repo and set environment variables.
- **Clean, Commented Code**: MVC architecture, controllers adapted to work with static data, easy to extend for real backends.

## Technologies Used

- **Laravel 8** (no Eloquent, only controllers and views)
- **Blade** for views
- **Bootstrap** for UI (customizable)
- **PHP 8+**

## How it Works

- All data (users, orders, customers, agents, warehouses, details) is in `/storage/demo-data/*.json`.
- Demo login: `demo@demo.com` / password: `demo` (you can register new demo users)
- No database writes: registration adds users to the JSON file.
- Update functions (stock, status, etc.) are simulated and do not change real data.

## Example Screens

- Login and registration
- Orders list with filters
- Order detail with products and status
- Customer and agent registry
- Product and warehouse list

## Why Use It as a Portfolio

- **Showcases adaptability**: conversion of a Laravel project from database to static files for plug-and-play demo.
- **Clean architecture**: separated controllers, views, and models, easy to extend.
- **Ready for deploy**: Railway configuration and instructions included.
- **Real demo**: you can show the working webapp without complex setup.


## Quick Deploy on Railway

1. Login at https://railway.app
2. Click "New Project" > "Deploy from GitHub repo" and select this repository.
3. Railway will automatically detect it as a PHP/Laravel project and run `composer install` and `php artisan serve` by default.
4. Go to "Variables" and add at least:
	- `APP_KEY` (generate locally with `php artisan key:generate --show`)
	- `APP_ENV=production`
	- `APP_DEBUG=false`
5. Make sure the root is the `public/` folder.
6. Start the deploy: Railway will install dependencies and launch the PHP server.

---

**Author:** Julio Cesar Plascencia Bierd

For questions or collaborations, contact me on Upwork!
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
