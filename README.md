````markdown
<p align="center">
  <!-- <a href="https://your-ecommerce-site.example.com" target="_blank"> -->
    <img src="https://raw.githubusercontent.com/yourusername/E-commerce-Platform-with-Laravel/main/logo.png" width="400" alt="E-commerce Platform Logo">
  </a>
</p>

<p align="center">
  <a href="https://github.com/yourusername/E-commerce-Platform-with-Laravel/actions"><img src="https://github.com/yourusername/E-commerce-Platform-with-Laravel/workflows/tests/badge.svg" alt="Build Status"></a>
  <a href="https://packagist.org/packages/yourusername/ecommerce-platform"><img src="https://img.shields.io/packagist/dt/yourusername/ecommerce-platform" alt="Total Downloads"></a>
  <a href="https://packagist.org/packages/yourusername/ecommerce-platform"><img src="https://img.shields.io/packagist/v/yourusername/ecommerce-platform" alt="Latest Stable Version"></a>
  <a href="https://opensource.org/licenses/MIT"><img src="https://img.shields.io/badge/license-MIT-blue.svg" alt="License"></a>
</p>

## 🚀 E-commerce Platform with Laravel

A full-featured E-commerce application built on Laravel featuring category and subcategory management, role-based permissions, and a dedicated admin dashboard for site administration.

---

## 🛠️ Features

- **Category & Subcategory Management**: Create, update, and organize product categories and subcategories.
- **Role-Based Permissions**: Define custom roles and permissions for users and admins using Laravel Gates and Policies.
- **Admin Dashboard**: Separate, secure dashboard for administrators to manage products, orders, users, and settings.
- **Product & Inventory**: CRUD for products with images, SKUs, stock tracking, and status flags.
- **Coupon & Discount System**: Create and manage discount coupons with usage limits and expiration dates.
- **Authentication & Security**: Laravel built-in auth scaffolding, JWT support for API, CSRF protection, and HttpOnly cookies.
- **RESTful API**: API endpoints for mobile apps or third-party integrations.
- **Reporting & Analytics**: Basic sales and order reports in the admin panel.

---

## 📦 Included Packages

- **Laravel Framework** (v{{ framework_version }})
- **Spatie Laravel-Permission** for RBAC
- **Intervention Image** for product image processing
- **blade_engine** 

---

## 🔧 Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/E-commerce-Platform-with-Laravel.git
   cd E-commerce-Platform-with-Laravel
````

2. \*\*Install dependencies  \*\*

   ```bash
   composer install
   npm install && npm run dev
   ```

3. \*\*Environment setup  \*\*

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

   Configure your database credentials and other settings in `.env`  .

4. \*\*Run migrations & seeders  \*\*

   ```bash
   php artisan migrate --seed
   ```

5. \*\*Start the development server  \*\*

   ```bash
   php artisan serve
   ```

---

## 📝 Usage &#x20;

* Access the homepage at `http://localhost:8000`  .
* Admin panel at `http://localhost:8000/admin` (use seeded admin credentials). &#x20;
* API endpoints under `http://localhost:8000/api` with Sanctum authentication. &#x20;

---

## 📂 Project Structure &#x20;

```text
app/
├── Http/
│   ├── Controllers/
│   │   ├── Admin/
│   │   └── CategoryAdmin/
│   │   └── ProductAdmin/
│   │   └── Front/
│   │   └── user/
│   └── Middleware/
├── Models/
├── Policies/
├── Repositories/
resources/
├── views/
│   ├── admin/
│   └── front/
routes/
├── web.php
└── category.php
└── home_auth.php
└── front.php
└── pp.php
```

---
```



````markdown
<p align="center">
  <a href="https://your-ecommerce-site.example.com" target="_blank">
    <img src="https://raw.githubusercontent.com/yourusername/E-commerce-Platform-with-Laravel/main/logo.png" width="400" alt="E-commerce Platform Logo">
  </a>
</p>

<p align="center">
  <a href="https://github.com/yourusername/E-commerce-Platform-with-Laravel/actions"><img src="https://github.com/yourusername/E-commerce-Platform-with-Laravel/workflows/tests/badge.svg" alt="Build Status"></a>
  <a href="https://packagist.org/packages/yourusername/ecommerce-platform"><img src="https://img.shields.io/packagist/dt/yourusername/ecommerce-platform" alt="Total Downloads"></a>
  <a href="https://packagist.org/packages/yourusername/ecommerce-platform"><img src="https://img.shields.io/packagist/v/yourusername/ecommerce-platform" alt="Latest Stable Version"></a>
  <a href="https://opensource.org/licenses/MIT"><img src="https://img.shields.io/badge/license-MIT-blue.svg" alt="License"></a>
</p>

## 🚀 E-commerce Platform with Laravel

A full-featured E-commerce application built on Laravel featuring category and subcategory management, role-based permissions, and a dedicated admin dashboard for site administration.

---

## 🛠️ Features

- **Category & Subcategory Management**: Create, update, and organize product categories and subcategories.
- **Role-Based Permissions**: Define custom roles and permissions for users and admins using Laravel Gates and Policies.
- **Admin Dashboard**: Separate, secure dashboard for administrators to manage products, orders, users, and settings.
- **Product & Inventory**: CRUD for products with images, SKUs, stock tracking, and status flags.
- **Coupon & Discount System**: Create and manage discount coupons with usage limits and expiration dates.
- **Authentication & Security**: Laravel built-in auth scaffolding, JWT support for API, CSRF protection, and HttpOnly cookies.
- **RESTful API**: API endpoints for mobile apps or third-party integrations.
- **Reporting & Analytics**: Basic sales and order reports in the admin panel.

---

## 📦 Included Packages

- **Laravel Framework** (v{{ framework_version }})
- **Spatie Laravel-Permission** for RBAC
- **Intervention Image** for product image processing
- **Laravel Sanctum** for API authentication
- **Livewire** + **Alpine.js** for interactive UI components

---

## 🔧 Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/E-commerce-Platform-with-Laravel.git
   cd E-commerce-Platform-with-Laravel
````

2. \*\*Install dependencies  \*\*

   ```bash
   composer install
   npm install && npm run dev
   ```

3. \*\*Environment setup  \*\*

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

   Configure your database credentials and other settings in `.env`  .

4. \*\*Run migrations & seeders  \*\*

   ```bash
   php artisan migrate --seed
   ```

5. \*\*Start the development server  \*\*

   ```bash
   php artisan serve
   ```

---

## 📝 Usage &#x20;

* Access the homepage at `http://localhost:8000`  .
* Admin panel at `http://localhost:8000/admin` (use seeded admin credentials). &#x20;
* API endpoints under `http://localhost:8000/api` with Sanctum authentication. &#x20;

---

## 📂 Project Structure &#x20;

```text
app/
├── Http/
│   ├── Controllers/
│   │   ├── Admin/
│   │   └── API/
│   └── Middleware/
├── Models/
├── Policies/
├── Repositories/
resources/
├── views/
│   ├── admin/
│   └── customer/
routes/
├── web.php
└── api.php
```

---

## 📋 Core Projects

* **E-commerce Platform with Laravel**
  A comprehensive e-commerce solution featuring:

  * Category & subcategory management
  * Role-based permissions
  * Dedicated admin dashboard for products, orders, and users
  * Coupon and discount system
  * Inventory tracking

* **Invoice and Inventory Management System**
  A Laravel-based application to manage sales invoices, customer (trader) profiles, and stock across multiple branches with daily/monthly reporting.

* **Laravel Personal Aljawharuh System V2**
  A customized personal management system built on Laravel, featuring advanced category/subcategory organization, permission control, and a secure admin interface.

* **Pharmacy Management System**
  A robust Laravel solution for pharmacies to handle prescription records, medicine inventory, supplier management, and automated stock replenishment alerts.

## 🧩 Key Personal & Training Projects & Training Projects

A concise list of the main utility tools included in this toolkit:

* **DBHandler**: Simplifies PDO-based CRUD operations with reusable methods and error handling.
* **Curl**: PSR-compatible HTTP client wrapper for easy API requests and JSON handling.
* **GitHub API Manager**: Provides authenticated methods to interact with GitHub repositories via REST API.
* **MyFunction Utility Class**: Offers manual implementations of PHP built-in functions for educational purposes.

---

## 🤝 Contributing &#x20;

Contributions are welcome! Please read [CONTRIBUTING.md](CONTRIBUTING.md) for guidelines. &#x20;

---

## 📄 License &#x20;

This project is open-sourced under the MIT license. See [LICENSE](LICENSE) for details. &#x20;

```
```
