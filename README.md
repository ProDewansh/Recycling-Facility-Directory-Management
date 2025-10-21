# Recycling-Facility-Directory-Management
A Laravel-based web application for managing a Recycling Facility Directory, allowing users to add, edit, search, and filter recycling centers by materials and location. Includes authentication (Laravel Breeze) and CSV export functionality for filtered facility data.
# Recycling Facility Directory

A small Laravel application to manage a Recycling Facility Directory stored in a MySQL database. The application allows authenticated users to manage facilities, materials, and view details with filtering, searching, and exporting options.

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



