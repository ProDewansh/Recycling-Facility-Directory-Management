<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
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

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).




# Recycling-Facility-Directory-Management
A Laravel-based web application for managing a Recycling Facility Directory, allowing users to add, edit, search, and filter recycling centers by materials and location. Includes authentication (Laravel Breeze) and CSV export functionality for filtered facility data.



---


## Table of Contents


- [Features](#features) 
- [Tech Stack](#tech-stack) 
- [Database Design](#database-design) 
- [Installation](#installation) 
- [Usage](#usage) 
- [Folder Structure](#folder-structure) 
- [Sample Data](#sample-data) 
- [License](#license) 


---


## Features


- Add, edit, and delete recycling facilities. 
- List facilities in a paginated table. 
- Search facilities by **name**, **city**, or **material**. 
- Sort facilities by **last update date**. 
- Filter facilities by materials accepted. 
- Facility detail page with all info and embedded Google Maps. 
- Export filtered facility data as **CSV**. 
- Authentication using Laravel Breeze; only logged-in users can access pages.


---


## Tech Stack


- **Backend:** Laravel 12 
- **Frontend:** Blade Templates, Bootstrap 5, Select2 
- **Database:** MySQL 
- **Authentication:** Laravel Breeze 
- **CSV Export:** Laravel native functionalities 
- **Optional:** GenAI tools for development 


---


## Database Design


### Tables


#### `facilities`


| Column           | Type    |
|-----------------|---------|
| id              | PK      |
| business_name   | string  |
| last_update_date| date    |
| street_address  | string  |
| city            | string  |
| state           | string  |
| postal_code     | string  |
| timestamps      | -       |


#### `materials`


| Column | Type   |
|--------|--------|
| id     | PK     |
| name   | string |


#### Pivot Table: `facility_material`


| Column      | Type     |
|-------------|----------|
| id          | PK       |
| facility_id | FK       |
| material_id | FK       |


#### Relationships


- **Facility** → many-to-many → **Materials** 
- Each facility can accept multiple materials. 
- Each material can belong to multiple facilities.


---


## Installation


1. Clone the repository: 


```bash
git clone <your-repo-url>
cd <project-folder>
composer require laravel/ui
php artisan ui bootstrap --auth
npm install
npm run dev
php artisan migrate
php artisan key:generate

Note:  for databse I also add a recycle.sql file for quick viewing or use that sql file for creating, use for ease.




