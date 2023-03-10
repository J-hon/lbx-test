# LBX Test
_Upload CSV file_

### Features Implemented
* An employee can be retrieved
* All employees can be retrieved
* Employee can be deleted
* CSV file containing employee can be uploaded

## Tools and Languages

This project requires the following dependencies to run

* [PHP 8+](https://www.php.net/downloads.php)
* [MySQL](https://www.mysql.com/)
* [Composer](https://getcomposer.org/download/)

## Setup and Installation

Clone the project, install the dependencies.

```sh
git clone https://github.com/J-hon/lbx-test.git
cd lbx-test
composer install
php artisan storage:link
```

Create .env file
```sh
cp .env.example .env
```
Serve the application

```sh
php artisan serve
```
