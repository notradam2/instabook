# About
Instabook is a Laravel project that performs CRUD operations and demonstrates how Laravel Horizon, Redis and AWS S3 works.

## Requirements
* Docker for Mac or Linux
* docker-compose

##  Docker Setup
Git clone this repository
```shell
git clone git@github.com:notradam2/dev-docker.git
```
You may use this repo to set up your docker compose.
https://github.com/notradam2/dev-docker


---
## Installation
Follow the commands below to set up the Laravel backend
development environment.

### 1: Clone Repository
Clone the repository inside `dev-docker/apps`
```shell
git clone git@github.com:notradam2/instabook.git
```
Go to `instabook` directory.
```shell
cd instabook
```
Switch to `develop` branch.
```shell
git checkout develop
git pull origin develop
```
Then we have to build the containers with `docker-compose`
```shell
docker-compose up --build -d
```

### 2. Setup Laravel Framework

Get inside the terminal of `instabook` container to setup the laravel.
```shell
docker exec -it instabook bash
```

Copy the `.env.example` file to `.env`
```
cp .env.example .env
```

:warning: You need to add your own AWS & MailTrap credentials value.

Setup Local File Permissions by
```shell
chmod -R 777 storage
```

Then install Laravel key
```shell
composer install
php artisan key:generate
```

### 3. Setup the MySQL Database
Run the command below to set up the database.
```shell
composer dump-autoload
php artisan migrate:fresh --seed
```

### 4. Setup Storage
Create a symlink to link the `public/storage` by running the command:
```shell
php artisan storage:link
```

### 5. Setup Localhost
Open the `/etc/hosts` of your computer and add the following lines
in the file.
```
127.0.0.1 instabook.local.host
```

### 6. Clear Cache
We need to clear all caching for a fresh system. Go to the `api` terminal and run the
following commands.
```shell
php artisan optimize:clear
```


### 7. Build project UI

To build the admin UI, run the following command:
```shell
npm i && npm run dev
```

---

### 8. Unit Test
Run PHPUnit test to double-check everything is working.
```shell
./vendor/bin/phpunit
```

### 9. Open Browser
Access https://instabook.local.host in your browser and enter the test account credentials.
```
username: admin@test.com
password: admin12345
```
![Instabook Dashboard](https://i.ibb.co/pZT3MrG/Screenshot-from-2022-10-25-11-21-19.png)


## Laravel Horizon
We are processing our queue system through Redis queues and manage them
with Laravel Horizon.

Open http://instabook.localhost/horizon to see the Laravel Horizon user interface.
![Laravel Horizon](https://i.ibb.co/tHvq8C4/Screenshot-from-2022-10-25-11-14-25.png)
```
username: admin
password: admin
```
