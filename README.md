## About
This is an online shopping website built with laravel.

## Features
- CRUD operations
- Fully responsive UI (using bootstrap)
- Restful Api
- Register, Login and Edit profile
- Session and Cookies
- Middlewares
- Two types of users: Customers and Sellers (using polymorphic relationship)
- Sellers can add products in different categories
- Nested categories for products
- Customers can filter and search for products and add them to their cart.
- Edit cart using Ajax
- List orders of a user



## Getting Started

    git clone https://github.com/RezaAbbaszadeh/Ecommerce-Web-Programming Ecommerce

    cd Ecommerce

    composer install

    php artisan migrate

    php artisan serve
    
There is also a pre-built postgresql database.tar file uploaded. You can import it using pgAdmin and name the database "ecommerce_web_programming".
