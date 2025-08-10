# Travel Management MVP

A Proof of Concept (POC) Laravel application for managing travel reservations with partners and admins. Built with **Laravel**, **Filament**, and **Spatie Laravel Permission** to demonstrate a scalable travel booking system.

🚀 **Ready for client presentation** — fully functional in under 24 hours.

---

## ✨ Features

- **Dual Panel Authentication**
  - Admin panel (`/admin`)
  - Partner panel (`/partner`)
- **Role-Based Access Control (RBAC)**
  - Roles: `admin`, `partner`
  - Managed via Spatie Laravel Permission
- **User Management**
  - Admin can create and manage users
  - Role assignment during creation
- **Location Management**
  - Countries, Provinces, Cities
  - Cascading dropdowns with live updates
- **Service & Subservice Management**
  - Services: Flight, Hotel, Car Rental
  - Subservices: Economy, Business, Suite
- **Reservation System**
  - Partners can create reservations
  - Cascading selects for origin/destination
  - Service → Subservice dependency
  - Inline creation of locations and services
- **Responsive Admin Panel**
  - Built with Filament PHP
  - Clean, modern UI
- **Data Seeding**
  - Predefined countries, cities, and services
  - Ready for testing

---

## 🛠 Tech Stack

| Layer        | Technology                          |
|------------|-----------------------------------|
| Framework   | Laravel 10                        |
| Admin Panel | Filament 3                        |
| Auth        | Laravel Sanctum + Guards          |
| Roles       | Spatie Laravel Permission         |
| Frontend    | Tailwind CSS, Alpine.js (via Filament) |
| Database    | MySQL                             |

---

## 📦 Installation

### 1. Clone the repository

```bash
git clone git@github.com:siamaknaghel/laravel-travel-management-mvp.git
cd laravel-travel-management-mvp
```

### 2. Install dependencies

```bash
composer install
npm install && npm run build
```
> ⚠️ Make sure you have Composer and Node.js installed.

### 3. Set up environment

```bash
cp .env.example .env
```
Edit `.env` and set your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=travel_mgmt_mvp
DB_USERNAME=root
DB_PASSWORD=
```
### 4. Generate app key and run migrations

```bash
php artisan key:generate
php artisan migrate
php artisan db:seed
```
> This will seed:
> - Roles: `admin`, `partner`
> - Admin user: `admin@admin.com` / `password`
> - Countries: Iran, Turkey, UAE
> - Services: Flight, Hotel, Car Rental
> - And related provinces, cities, and subservices

### 5. Serve the application

```bash
php artisan serve
```
Open your browser and visit:

- 👉 http://localhost:8000/admin — Admin Panel
- 👉 http://localhost:8000/partner — Partner Panel

---

## 🔐 Default Credentials

| Panel   | Email               | Password   | Role     |
|--------|---------------------|------------|----------|
| Admin  | admin@admin.com     | password   | admin    |
| Partner| partner@partner.com | password   | partner  |

> You can create more partners via `/partner/register`.

---

## 🧭 Project Structure (Key Parts)

app/
├── Models/
│   ├── User.php
│   ├── Country.php
│   ├── Province.php
│   ├── City.php
│   ├── Service.php
│   ├── Subservice.php
│   └── Reservation.php
└── Filament/
    ├── Resources/           → Admin CRUD panels
    └── Partner/Pages/       → Partner-specific forms

database/
├── seeders/
│   ├── RolePermissionSeeder.php
│   ├── AdminUserSeeder.php
│   ├── LocationSeeder.php
│   └── ServiceSeeder.php


---

## 🧪 Testing the System

### As Admin:
1. Login to `/admin`
2. Go to **User Management** → Create a new user with role `partner`
3. Check **Reservations** (will be added in next phase)

### As Partner:
1. Register at `/partner/register` or use test account
2. Go to **Create Reservation**
3. Fill form with:
   - Origin: Iran → Tehran → Tehran
   - Destination: Iran → Isfahan → Isfahan
   - Service: Flight → Economy
   - Travel Date & Price
4. Submit — reservation will be saved with status `pending`

---

## 📌 Next Steps (Optional Enhancements)

- [ ] Add status management (pending, confirmed, cancelled)
- [ ] Partner payment tracking
- [ ] API endpoints for mobile apps
- [ ] Email notifications
- [ ] Multi-language support

---

## 🤝 Ready for Client Handoff

This POC demonstrates:
✅ Rapid development  
✅ Clean architecture  
✅ Scalable design  
✅ Professional UI/UX  

Perfect for presenting to clients and moving to full MVP development.

---

## 📬 Contact

Siamak Nagheli  
📧 30amak89@gmail.com  
💼 Upwork Profile: https://www.upwork.com/freelancers/~01b2c3d4e5f6g7h8i9j
