# Panduan Clone Project
## Installation

#### 1. Clone Project

```bash
  git clone https://github.com/SyahriRhamadhan/survei_ci4.git
```

#### 2. Masuk Folder

```bash
  cd survei_ci4
```

#### 3. Install Composer

```bash
  composer install
```

#### 4. Membuat  Database di XAMPP Sesuai di File .env 

```bash
  database.default.hostname = 127.0.0.1
  database.default.database = survei_umrah
  database.default.username = root
  database.default.password = 
  database.default.DBDriver = MySQLi
  database.default.DBPrefix =
  database.default.port = 3306
```

#### 5. Menjalankan Tabel Migration  

```bash
  php spark migrate
```

#### 6. Menjalankan User Seeder  

```bash
  php spark db:seed UserSeeder
```

#### 7. Menjalankan CodeIgniter4 

```bash
  php spark serve
```

#### 8. CLI (command) Jika  Menghapus dan  Menjalankan Migrasi sekaligus  didalam terminal

```bash
  php spark migrate:refresh
```
#### 9. CLI (command) Jika ingin Membuat Migration didalam terminal

```bash
  php spark make:migration Users
```

#### 10. CLI (command) Jika ingin Membuat Model didalam terminal

```bash
  php spark make:model UserModel 
```

#### 11. CLI (command) Jika ingin Membuat Controller didalam terminal
Akan Membuat sebuah Folder Admin Yang didalamnya Terdapat Controller Dashboard
```bash
  php spark make:controller Admin/Dashboard
```

Jika Tidak ingin didalam Folder 
```bash
  php spark make:controller Login
```


# CodeIgniter 4 Application Starter

## What is CodeIgniter?

CodeIgniter is a PHP full-stack web framework that is light, fast, flexible and secure.
More information can be found at the [official site](https://codeigniter.com).

This repository holds a composer-installable app starter.
It has been built from the
[development repository](https://github.com/codeigniter4/CodeIgniter4).

More information about the plans for version 4 can be found in [CodeIgniter 4](https://forum.codeigniter.com/forumdisplay.php?fid=28) on the forums.

You can read the [user guide](https://codeigniter.com/user_guide/)
corresponding to the latest version of the framework.

## Installation & updates

`composer create-project codeigniter4/appstarter` then `composer update` whenever
there is a new release of the framework.

When updating, check the release notes to see if there are any changes you might need to apply
to your `app` folder. The affected files can be copied or merged from
`vendor/codeigniter4/framework/app`.

## Setup

Copy `env` to `.env` and tailor for your app, specifically the baseURL
and any database settings.

## Important Change with index.php

`index.php` is no longer in the root of the project! It has been moved inside the *public* folder,
for better security and separation of components.

This means that you should configure your web server to "point" to your project's *public* folder, and
not to the project root. A better practice would be to configure a virtual host to point there. A poor practice would be to point your web server to the project root and expect to enter *public/...*, as the rest of your logic and the
framework are exposed.

**Please** read the user guide for a better explanation of how CI4 works!

## Repository Management

We use GitHub issues, in our main repository, to track **BUGS** and to track approved **DEVELOPMENT** work packages.
We use our [forum](http://forum.codeigniter.com) to provide SUPPORT and to discuss
FEATURE REQUESTS.

This repository is a "distribution" one, built by our release preparation script.
Problems with it can be raised on our forum, or as issues in the main repository.

## Server Requirements

PHP version 8.1 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)

> [!WARNING]
> - The end of life date for PHP 7.4 was November 28, 2022.
> - The end of life date for PHP 8.0 was November 26, 2023.
> - If you are still using PHP 7.4 or 8.0, you should upgrade immediately.
> - The end of life date for PHP 8.1 will be December 31, 2025.

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php) if you plan to use MySQL
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library

