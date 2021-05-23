# cara menjalankan web app

1. Buat database dengan nama **bridgenote**
2. Download atau clone dan simpan di xampp/htdocs
3. Jalankan **php artisan migrate** untuk menambahkan atau migrasi database
4. Jalankan menggunakan xampp dengan php 7.4 kemudian buka dengan browser link https://localhost/bridgenote/public/
5. **Penting!** : jalankan web app ini menggunakan **https**, karena kebijakan baru dari facebook api harus menggunakan https
6. Jika web app nya sudah berhasil terbuka silahkan pilih login atau register pada pojok kanan atas
7. **Info** : jika register menggunakan google maka untuk login juga menggunakan google, demikian juga dengan register menggunakan facebook maka login juga harus dengan facebook
8. Selamat anda sudah berhasil login

# cara menggunakan api

# Register

1. Setting header
  - Content-Type: application/json
  - X-Requested-With: XMLHttpRequest

2. Method **POST**
3. Link **http://localhost/bridgenote/public/api/register**
4. Parameter
  - name
  - email
  - password
  - password_confirm

# Login

1. Setting header
  - Content-Type: application/json
  - X-Requested-With: XMLHttpRequest

2. Method **POST**
3. Link **http://localhost/bridgenote/public/api/login**
4. Parameter
  - email
  - password

# Check User Authenticated

1. Setting header
  - Content-Type: application/json
  - X-Requested-With: XMLHttpRequest

2. Authorization
  - bareToken (didapatkan dari hasil login: token)

3. Method **GET**
4. Link **http://localhost/bridgenote/public/api/user**
5. Parameter
  - email
  - password

# CRUD

# Create

1. Setting header
  - Content-Type: application/json
  - X-Requested-With: XMLHttpRequest

2. Authorization
  - bareToken (didapatkan dari hasil login: token)

3. Method **POST**
4. Link **http://localhost/bridgenote/public/api/member**
5. Parameter
  - status
  - position

# update

1. Setting header
  - Content-Type: application/json
  - X-Requested-With: XMLHttpRequest

2. Authorization
  - bareToken (didapatkan dari hasil login: token)

3. Method **PUT**
4. Link **http://localhost/bridgenote/public/api/member/{id}**
5. Parameter
  - status
  - position

# delete

1. Setting header
  - Content-Type: application/json
  - X-Requested-With: XMLHttpRequest

2. Authorization
  - bareToken (didapatkan dari hasil login: token)

3. Method **DELETE**
4. Link **http://localhost/bridgenote/public/api/member/{id}**

# Check User Authenticated

1. Setting header
  - Content-Type: application/json
  - X-Requested-With: XMLHttpRequest

2. Authorization
  - bareToken (didapatkan dari hasil login: token)

3. Method **GET**
4. Link **http://localhost/bridgenote/public/api/member**
