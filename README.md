# Pizza Zone 🍕

Pizza Web Page for My Web Technologies Course in Uni

A modern, responsive pizza ordering web application built with PHP, HTML, CSS, and JavaScript.

## Features
- **User Authentication:** Sign up, log in, and view as guest.
- **Order Pizzas:** Choose from a variety of pizzas, customize crust and size, and place orders with promo code support.
- **Drinks & Deals:** Browse drink options and view hot deals (UI only, more features coming soon).
- **Order Management:** View your past orders, download bills, and delete orders.
- **Promo Codes:** Apply codes like `BIG20` or `WELCOME10` for discounts.
- **Responsive Design:** Works great on desktop, tablet, and mobile.
- **Secure Credentials:** Database credentials are kept private in `php/db.php` (excluded from GitHub).

## Project Structure
```
PizzaZone 3.0/
├── css/                # Stylesheets and images
│   ├── Home_Page.css
│   ├── myorders.css
│   ├── signup_style.css
│   ├── style.css
│   └── pics/           # All images used in the site
├── javascript/
│   └── orderModal.js   # JS for order modal and promo logic
├── php/                # All PHP backend files
│   ├── db.php          # Database credentials (NOT in repo)
│   ├── Home_page.php   # Main landing page
│   ├── index.php       # Login/landing page
│   ├── login.php       # Login logic
│   ├── login_form.php  # Login form
│   ├── logout.php      # Logout logic
│   ├── myorders.php    # View/delete/download orders
│   ├── saveorder.php   # Save order logic
│   ├── signup.php      # Signup logic
│   ├── signup_form.php # Signup form
│   └── download_bill.php # Download order bill
└── .gitignore          # Ensures db.php is not tracked
```

## Setup Instructions
1. **Clone the repository:**
   ```
   git clone <your-repo-url>
   ```
2. **Create your database and import the required tables.**
3. **Create `php/db.php` with your database credentials:**
   ```php
   <?php
   $host = 'localhost';
   $user = 'your_db_user';
   $password = 'your_db_password';
   $db = 'your_db_name';
   $conn = new mysqli($host, $user, $password, $db);
   if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
   }
   ?>
   ```
4. **Run the project using XAMPP or your preferred local server.**

## Security
- Database credentials are stored only in `php/db.php` and are excluded from version control via `.gitignore`.
- All user input is sanitized and validated.

## Credits
- Developed by Mohammad Alhasan
- UI inspired by modern pizza delivery sites

## License
This project is for educational/demo purposes. Feel free to use and modify for your own learning!
