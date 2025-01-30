
# GITS CAPSTONE PROJECT: Group 7 [ Kancil ] - Mini E-Commerce Print-Shop Webstore 👕

"Print-Shop Webstore" merupakan sebuah aplikasi berbasis web yang menyediakan beragai layanan pemesanan Produk seperti kaos, jaket, dan lain sebagainya. Tidak hanya itu Aplikasi ini juga menyediakan layanan untuk pemesanan jasa pembuatan Baju seperti Desain Kaos, Konveksi Baju dan lain sebagainya.


# Members of Group 7🧑🏻‍🎓

- Leader : Taufik Hidayat
- Members 1st : Dinda Hirya Hirmaya
- Members 2nd : Nurfanis Mulyana
- Members 3rd : Sholeh Budi Utomo
- Members 4rd : Silviana
## Preview Pages of Print-Shop Webstore App 🛒

![Admin Print-Shop Webstore App](https://i.postimg.cc/XqmcQgXH/print-shop-admin.png)

![Home 1 Print-Shop Webstore App](https://i.postimg.cc/HL1bLjb8/print-shop-home-1.png)

![Home 2 Print-Shop Webstore App](https://i.postimg.cc/fLwXxF2w/print-shop-home-2.png)

![Home 3 Print-Shop Webstore App](https://i.postimg.cc/qqD8BLGp/print-shop-home-3.png)

## Application Features or Stack 🤖

Features for Manager :
- Authentication for Manager (Register, Login, & Logout)
- Profile Management for Manager Users
- CMS (Content Management System) for Manager
- Support for CMS System like Search and Datatable Features
- Make Promo Banner for the Website
- Confirm Transaction Order of Customer's
- Tracking Transaction Order of Customer's

Features for Customer :
- Authentication for Customer (Register, Login, & Logout)
- Profile Management for Customer Users
- Rating Store for Customer
- Rating Products and Services for Customer
- Search Products and Services for Customer
- Add to Cart Products for Customer
- Add to Order Services for Customer
- Management Cart Products and Order Services for Customer
- Do some Transaction of Products and Orders for Customer
- Checkout Transaction Product and Order Service for Customer
- Tracking Transaction Product or Order Service of Customer's
## Installation Web App 🎨

- start with clone this project
```bash
  git clone https://github.com/Gits-Group-7/group-7-capstone-project-app.git
```
- install composer (*if you dont have artisan)
```bash
  composer install
```
- install livewire on your terminal project
```bash
  composer require livewire/livewire
```
- install midtrans
```bash
  composer require midtrans/midtrans-php
```
- make database db_gits_capstone on mysql (*option 1)
```bash
  create database db_gits_capstone;
```
- modify file .env - change database and port mysql (*option 1)
```bash
  DB_PORT=3306
  DB_DATABASE=db_gits_capstone
```
- running migration with seeder to your mysql (*option 1)
```bash
  php artisan migrate --seed "or" php artisan migrate:fresh --seed
```
- or import database on this project to your mysql (*option 2)
```bash
  "check database file on this project and please import manually to your database on php my admin"
```
- make storage folder link to your public folder
```bash
  php artisan storage:link
```
- run the app
```bash
  php artisan serve
```
- for best practice, please modify image photo of products and services from CMS Manager on this url
```bash
  http://127.0.0.1/admin/daftar-produk and http://127.0.0.1/admin/daftar-jasa
```
- thank you, your app have been succesfully runned into your system
## Support and Thanks ✨

For support credit, please email leader of this project : taufikhidayat09121@gmail.com. Thank you to team 7 members, our regards are mentors Ala Rai and GITS Indonesia 🎉🎉🎉

