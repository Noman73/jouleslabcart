=# 🛒 Laravel Cart System

A lightweight and flexible **Cart System** built with **Laravel**, designed for both guest and authenticated users.  
Supports adding, updating, removing, and persisting cart items — without storing them in the database.

---

## 🚀 Features

- Add, update, and remove items from the cart
- Manage cart using **Laravel session storage**
- Cart data persists between visits (for guest users)
- Auto calculation of total amount and item count
- Apply discounts or coupons (optional feature)
- Clean and reusable service-based structure
- Frontend built with **Tailwind CSS**

---

## 🧱 Tech Stack

| Layer | Technology                    |
|:------|:------------------------------|
| Backend | Laravel  12                   |
| Frontend | Tailwind CSS                  |
| Database | MySQL  |
| Storage | Laravel Session               |
| Language | PHP 8+                        |
| Tools | Composer, Artisan             |

---

## ⚙️ Installation Guide

### bash 
```bash
git clone https://github.com/Noman73/jouleslabcart
cd jouleslabcart

composer install
npm install && npm run dev
```

###  database setup
```
DB_DATABASE=laravel_cart
DB_USERNAME=root
DB_PASSWORD=
```

### database design here in this link bellow
https://drawsql.app/teams/xyz-79/diagrams/jouleslabcart

###  product seed

```
php artisan db:seed --class=ProductSeeder
```

###  admin_login
```
https://yourdomain.com/admin/login
```
1.Login with your admin credentials (if not created yet, you can manually insert an admin user into the users table via phpMyAdmin or a seeder).

2.Once logged in, navigate to the Products section and add some sample products.

3.Go to the Coupons section and create one or more coupons for testing.


