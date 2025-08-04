## 🚀 E-commerce Platform with Laravel

A full-featured E-commerce application built on Laravel featuring category and subcategory management, role-based permissions, and a dedicated admin dashboard for site administration.

---

## 🛠️ Features

- **Category & Subcategory Management**: Create, update, and organize product categories and subcategories.
- **Role-Based Permissions**: Define custom roles and permissions for users and admins using Laravel Gates and Policies.
- **Admin Dashboard**: Separate, secure dashboard for administrators to manage products, orders, users, and settings.
- **Product & Inventory**: CRUD for products with images, SKUs, stock tracking, and status flags.
- **Coupon & Discount System**: Create and manage discount coupons with usage limits and expiration dates.
- **Authentication & Security**: Laravel built-in auth scaffolding, Sanctum authentication for APIs, CSRF protection, and HttpOnly cookies.
- **RESTful API**: API endpoints for mobile apps or third-party integrations.
- **Reporting & Analytics**: Basic sales and order reports in the admin panel.

---

## 📦 Included Packages

- **Laravel Framework** (v 12)
- **Spatie Laravel-Permission** for RBAC
- **Intervention Image** for product image processing
- **Laravel Sanctum** for API authentication
- **Livewire** + **Alpine.js** for interactive UI components

---

## 🔧 Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/Mustafa-Elfrmawy/E-commerce-Platform-with-Laravel.git
   cd E-commerce-Platform-with-Laravel
````

2. **Install dependencies**

   ```bash
   composer install
   npm install && npm run dev
   ```

3. **Environment setup**

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

   Then configure your `.env` file with database and app credentials.

4. **Run migrations & seeders**

   ```bash
   php artisan migrate --seed
   ```

5. **Start the development server**

   ```bash
   php artisan serve
   ```

---

## 📝 Usage

* Access the homepage at `http://localhost:8000`
* Admin panel at `http://localhost:8000/admin` (use seeded admin credentials)
* API endpoints under `http://localhost:8000/api` with Sanctum authentication

---

## 📂 Project Structure

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
