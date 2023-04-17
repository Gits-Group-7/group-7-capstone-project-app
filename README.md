
# GITS UTS Group 7 Project - POS APP (Gadget Web Store) 🛒

"Gadget Web Store" merupakan sebuah aplikasi yang menggambarkan kegiatan toko online yang menawarkan produk teknologi atau gadget yang dapat diakses dari mana saja melalui web browser. Aplikasi ini mendukung berbagai operasi seperti halnya untuk memanajemen data produk yang dapat dilakukan oleh Admin secara langsung menggunakan fitur CMS.


# Members of This Project 🚀

- Leader : Taufik Hidayat
- Members 1st : Dinda Hirya Hirmaya
- Members 2nd : Sholeh Budi Utomo
- Members 3rd : Nurfanis
- Members 4rd : Silviana
## Features or Stack 🤖

- Authentication (Register, Login, & Logout)
- CMS for Admin (CRUD Product, & CRUD Category)
- Upload Image Product using Storage
- Add to Cart System for Customer (Guest)
- Transaction System for Customer (Guest)
- Transaction Log Management for Customer (Guest)
- Catalog Product for Customer (Guest)

## Function Features ✨

- Sebagai identifikasi dan pembatas untuk pengguna dalam melakukan operasi pada aplikasi.
- CMS sebuah aplikasi atau platform yang memungkinkan pengguna untuk membuat, mengelola, dan mengatur konten di sebuah situs web, dalam hal ini yaitu pada konten Manajemen data oleh pengguna Admin.
- Fungsi upload data image product menggunakan storage, yaitu memungkinkan pengguna untuk mengunggah gambar produk ke server atau penyimpanan cloud yang ditentukan oleh aplikasi atau platform.
- Fitur "add to cart" pada aplikasi biasanya digunakan dalam konteks e-commerce, dan fungsinya adalah memungkinkan pengguna untuk menambahkan produk yang mereka ingin beli ke dalam keranjang belanjaan mereka, untuk memudahkan proses pembayaran pada tahap selanjutnya.
- Fitur "transaction system" pada aplikasi biasanya berkaitan dengan fungsi pembayaran dan manajemen transaksi keuangan dalam aplikasi. Dalam hal ini pada aplikasi kami masih belum mengimplementasikan "Transaction" yang sebenarnya (backend).
- Fitur "transaction log management" pada aplikasi berfungsi untuk mencatat, memantau, dan mengelola log transaksi pada aplikasi setelah pengguna berhasil melakukan transaksi.
- Fitur "catalog product" pada aplikasi berfungsi untuk menampilkan daftar atau katalog produk yang dijual pada aplikasi tersebut. Dalam hal ini yaitu Katalog Produk ditampilkan pada Beranda website.
## Installation 🎨

- start with clone this project
```bash
  git clone https://github.com/Gits-Group-7/group-7-pos-app.git
```
- install composer (*if you dont have artisan)
```bash
  composer install
```
- make database db_pos_app on mysql
```bash
  create database db_pos_app;
```
- modify file .env - change database dan port mysql
```bash
  database = db_pos_app
  port = 3306
```
- import database on this project to your mysql (*option 1)
```bash
  "check database file on this project and please insert manual to your database on php my admin"
```
- running migration to your mysql (*option 2)
```bash
  php artisan migrate
```
- running migration to your mysql with seed (*option 3 & recommended) - still not added yet
```bash
  php artisan migrate:fresh --seed
```
- making storage folder link to your public folder
```bash
  php artisan storage:link
```
- starts the app
```bash
  php artisan serve
```
- for best practice, please modify image photo product from CMS Admin on this url
```bash
  http://127.0.0.1/admin/index-produk
```
- thank you, your app have been succesfully runned into your system
## Support and Question 👀

For support, email leader of this project : taufikhidayat09121@gmail.com, Thank you 🤍

