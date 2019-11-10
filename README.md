# Laravel Inventory System

This is an inventory system using Laravel and Vue.js to catalog and categorize goods, keep track of current inventory, pricing, and track items on layaway.


## Goals

- Show a listing of the current items in the store, along with their price and inventory. 
- Have the ability to add a new item to the store. 
- Will allow comments to be added to any store item (user authentication is not required). 
- At least one of these interactions should use Vue.js 
- Use bootstrap so that the pages look clean and balanced. 


## Getting up and running

This is assuming you want to use the project's vagrant box included. 

1. `composer install`
2. `npm install && npm run dev`
3. `php artisan migrate --seed`


## Test Account

Once you install the project, migrate and seed, you can login using the following test account.

**Email:** `tester@gmail.com`

**Password:** `secret`

Alternative you can register a new account if you prefer.