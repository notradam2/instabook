# Instabook
This is a Laravel project that performs CRUD operations and demonstrates how the Laravel Horizon, Redis and AWS S3 works. 

## :gear: Requirements
* Docker for Mac or Linux
* docker-compose 

## :whale:  Docker Setup
Git clone this repository
```shell
git clone git@github.com:folder/local-docker.git
```

---
# :factory:  Backend Setup
Follow the commands below to setup the Laravel backend
development environment.

### Step 1: Clone Repository
Clone the repository inside `local-docker/apps`
```shell
git clone git@github.com:folder/instabook.git
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

:warning: For security reasons, we do not expose .env credentials. You can put your own credentials value.

Setup Local File Permissions by
```shell
chmod -R 777 storage
```

Then install Laravel
```shell
composer install
php artisan key:generate
```

### 3. Setup the MySQL Database
Run the command below to setup the database. This will automatically
create the `instabook_db` database.
```shell
php artisan migrate:fresh --seed
```
If prompted, just input `yes`.

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


## 7. Build project UI

To build the admin UI, run the following command:
```shell
npm i && npm run dev
```

---

# :checkered_flag:  Everything Working?
To make sure that everything is working. We need to run some couple of tests. Let's run PHPUnit.
```shell
./vendor/bin/phpunit
```

## :ocean:  Laravel Horizon
We are processing our queue system through Redis queues and manage them
with Laravel Horizon.

You can go to your docker container `instabook-worker` and check if the PHP workers are running:
```shell
docker exec -it worker bash
```
Now that you are in, please run the command to see the running processes:
```shell
ps -ef
```
You should be able to see the horizon is running
show image here..

Now go to your browser and open https://instabook.local.host/horizon.
You should be able to see the Laravel Horizon user interface.
show image here..

Make sure the status is "Active".
