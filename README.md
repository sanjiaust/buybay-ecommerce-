# BuyBay — E-Commerce Web Application

BuyBay is a full-stack e-commerce web application built with PHP and MySQL. It supports product browsing, cart management, order placement, payment processing, product reviews, and a full admin panel for store management.

---

## Features

### Customer-facing
- Browse products by category (watches, sneakers, coats, clothing) with price filtering and pagination
- Search products and view individual product detail pages
- Add to cart, update quantities, and proceed to checkout
- Place orders with delivery address and contact details
- Simulated payment flow with BKash, PayPal, and Visa UI (no live gateway)
- Wishlist management
- Product reviews and ratings
- User account page with order history and review history
- Blog section

### Admin panel (`/admin`)
- Secure admin login (session-based)
- Dashboard with paginated order listing
- Add, edit, and delete products (with image upload)
- Manage orders — view, edit status, delete
- View and manage registered users
- Payment tracking
- Direct message (DM) system

---

## Tech stack

| Layer | Technology |
|---|---|
| Backend | PHP 8+ |
| Database | MySQL (via MySQLi) |
| Frontend | HTML5, CSS3, Bootstrap 5.3 |
| Icons | Font Awesome 5 |
| Server | Apache / XAMPP / WAMP |

---

## Project structure

```
buybay-ecommerce/
├── index.php               # Home page
├── shop.php                # Product listing with search & filters
├── single_product.php      # Individual product page
├── cart.php                # Shopping cart
├── checkout.php            # Checkout form
├── payment.php             # Payment page
├── order_details.php       # Order confirmation/details
├── wishlist.php            # User wishlist
├── reviews.php             # User reviews
├── blog.php                # Blog page
├── account.php             # User account
├── login.php               # User login
├── register.php            # User registration
├── contact.php             # Contact page
├── submit_review.php       # Review submission handler
├── MessageHandler.php      # Message/contact form handler
│
├── layout/
│   ├── header.php          # Shared navbar & head (Bootstrap, session)
│   └── footer.php          # Shared footer
│
├── admin/
│   ├── admin_login.php
│   ├── admin_dashboard.php
│   ├── admin_orders.php
│   ├── admin_products.php
│   ├── admin_users.php
│   ├── add_product.php
│   ├── edit_products.php
│   ├── edit_images.php
│   ├── edit_order.php
│   ├── delete_order.php
│   ├── payment.php
│   ├── admin_dm.php
│   ├── admin_help.php
│   ├── HD_SD.php
│   ├── header.php
│   └── logout.php
│
├── server/
│   ├── connection.php              # DB connection (not committed — see setup)
│   ├── connection.example.php      # Template for connection.php
│   ├── get_featured_products.php
│   ├── get_coats.php
│   ├── get_sneakers.php
│   ├── get_watches.php
│   ├── place_order.php
│   └── update_order_status.php
│
├── assets/
│   ├── css/style.css
│   └── imgs/                       # Product and UI images
│
└── .gitignore
```

---

## Getting started

### Prerequisites

- PHP 8.0 or higher
- MySQL 5.7 or higher
- Apache web server (XAMPP or WAMP recommended for local development)

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/sanjiaust/buybay-ecommerce-.git
   cd buybay-ecommerce-
   ```

2. **Set up the database**

   - Open phpMyAdmin (or your MySQL client)
   - Create a new database named `buybay_project`
   - Import the SQL schema file to create the required tables

   The database uses the following tables:
   - `users` — registered customers
   - `admins` — admin accounts
   - `products` — product catalogue
   - `orders` — placed orders
   - `order_items` — individual items per order
   - `reviews` — product reviews

3. **Configure the database connection**

   Copy the example connection file and fill in your credentials:
   ```bash
   cp server/connection.example.php server/connection.php
   ```

   Then edit `server/connection.php`:
   ```php
   <?php
   $conn = mysqli_connect("localhost", "your_username", "your_password", "buybay_project")
       or die("Couldn't connect to database");
   ```

4. **Place files on your server**

   Copy the project into your web server's root directory:
   - XAMPP: `C:/xampp/htdocs/buybay-ecommerce/`
   - WAMP: `C:/wamp64/www/buybay-ecommerce/`

5. **Open in your browser**
   ```
   http://localhost/buybay-ecommerce/
   ```

   Admin panel:
   ```
   http://localhost/buybay-ecommerce/admin/admin_login.php
   ```

---

## Environment notes

- `server/connection.php` is excluded from version control via `.gitignore` to keep database credentials private. Always use `connection.example.php` as the template.
- Passwords are hashed using MD5. For a production environment, this should be upgraded to `password_hash()` / `password_verify()` (bcrypt).
- Image uploads are stored in `assets/imgs/`. Ensure the directory has write permissions on your server.

---

## Author

**Ridwanul Islam Sanji**  
BSc in Computer Science & Engineering — Ahsanullah University of Science and Technology  
GitHub: [@sanjiaust](https://github.com/sanjiaust) · LinkedIn: [1ridwanulislamsanji](https://www.linkedin.com/in/1ridwanulislamsanji/)

---

## License

This project was developed as an academic project. Feel free to fork and build on it.
