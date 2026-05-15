# Quiz App

## Features

* User signup and login
* 10 random quiz questions
* Quiz timer
* Results page
* Leaderboard
* Scores saved in MySQL
* Replay quiz feature

## Technologies

* HTML
* CSS
* JavaScript
* PHP
* MySQL

## Run Locally

```bash id="4x8htq"
php -S localhost:8000
```

Then open:

```text id="rbecxg"
http://localhost:8000
```

## Database Schema

### users

```sql id="j3v6ru"
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) UNIQUE,
    password VARCHAR(255),
    is_admin TINYINT DEFAULT 0
);
```

### scores

```sql id="56qzyr"
CREATE TABLE scores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255),
    score INT
);
```

## GitHub Repository

https://github.com/Emir-Usta14/appo.git

## Deployed Website

https://appo-4lur.onrender.com

## MySQL Database

https://www.freesqldatabase.com/
Host: sql5.freesqldatabase.com
Database name: sql5826932
Database user: sql5826932
Database password: CZMTpRWzE3
Port number: 3306

## Author

Emir Usta
