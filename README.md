# Book Management API Service

[![Build Status](https://travis-ci.org/laravel/lumen-framework.svg)](https://travis-ci.org/laravel/lumen-framework)
[![Total Downloads](https://img.shields.io/packagist/dt/laravel/lumen-framework)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Stable Version](https://img.shields.io/packagist/v/laravel/lumen-framework)](https://packagist.org/packages/laravel/lumen-framework)
[![License](https://img.shields.io/packagist/l/laravel/lumen)](https://packagist.org/packages/laravel/lumen-framework)

This is a simple RESTful API service built with Laravel Lumen framework for managing books.

## Installation

To get started, clone this repository and run the following commands:
```bash
cd Books-API
composer install
cp .env.example .env
php artisan key:generate
```

Create a new database in MySQL and update the DB_DATABASE, DB_USERNAME and DB_PASSWORD variables in the .env file accordingly.

Then, run the following command to create the tables in the database:

```bash
php artisan migrate
```


## Usage

To run the service, run the following command:

```bash
php -S localhost:8000 -t public
```


You can then use an API client like Postman to make requests to the following endpoints:


### Get all books
```php
GET /books
```
### Get a book by ID
```php
GET /books/{id}
```
### Create a new book
```php
POST /books/create
```

Body:

```json
{
    "isbn": "978-3-16-148410-0",
    "title": "Book Title",
    "author": "Book Author",
    "publication_date": "2022-01-01"
}
```

### Update a book

```php
PUT /books/update/{id}
```

Body:

```json
{
    "isbn": "978-3-16-148410-0",
    "title": "New Book Title",
    "author": "New Book Author",
    "publication_date": "2022-01-01"
}
```
###  Delete a book

```php
delete /books/delete/{id}
```

## License

The Lumen framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
