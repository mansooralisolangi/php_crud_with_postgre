PHP PostgreSQL REST API

This project is a simple REST API built in PHP using PostgreSQL. It supports basic CRUD operations (Create, Read, Update, Delete) on a user_data table.

It also uses Composer for dependency management (ramsey/uuid for UUID generation).

🛠️ Requirements

PHP  8.2

PostgreSQL

Composer

⚡ Installation

Clone the repository:

git clone <https://github.com/mansooralisolangi/php_crud_with_postgre>

Install Composer dependencies:

composer install

Database setup:

Create a PostgreSQL database.

Create a schema and table:

CREATE SCHEMA "user";

CREATE TABLE "user".user_data (
    id UUID PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100),
    phone_number VARCHAR(20)
);

Database connection:

Update database.php with your PostgreSQL credentials:

<?php
$con = pg_connect("host=localhost dbname=your_db user=your_user password=your_password");
if (!$con) {
    die("Connection failed: " . pg_last_error());
}
?>
🚀 API Endpoints
Method	Endpoint	Description	Request Body / Params
GET	/api.php?id=...	Get user by ID	Query param id
GET	/api.php	Get all users	None
POST	/api.php	Create new user	JSON: name, email, phone_number
PUT	/api.php	Update user	JSON: id, name, email, phone_number
DELETE	/api.php	Delete user	JSON: id

Example POST request body:

{
  "name": "mansoor",
  "email": "mansoor@example.com",
  "phone_number": "+1234567890"
}

Example PUT request body:

{
  "id": "uuid-of-user",
  "name": "mansoor",
  "email": "mansoor@example.com",
  "phone_number": "+9876543210"
}
✅ Notes

The vendor/ folder should not be pushed to Git. Add it to .gitignore:

/vendor/

Push only your source code, composer.json, composer.lock, and README.

API returns JSON for all responses.

All IDs are generated using UUID v4 via ramsey/uuid.

🔧 Testing

You can test the API using:

Postman

cURL:

# GET all users
curl http://localhost/api.php

# GET user by id
curl http://localhost/api.php?id=<uuid>

# POST new user
curl -X POST -H "Content-Type: application/json" -d '{"name":"John","email":"john@example.com","phone_number":"123456"}' http://localhost/api.php
