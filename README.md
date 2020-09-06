# Ybank

banking application, where one account can send money to another.

### Installation

Clone this repo.

```sh
git clone https://github.com:ahmedmahmoudit/ybank.git
```

**Setup API server**

```sh
$ cd ybank/api
$ composer install
$ cp .env.example .env
$ php artisan key:generate
```

Configure your database connection in the *.env* file, and run the server.

Then migrate and seed your tables.

```sh
$ php artisan migrate --seed
$ php artisan serve
```

**Setup the front-end**

```sh
$ cd ybank/web
$ yarn install && yarn dev
```



Open [http://localhost:3000/](http://localhost:3000) to start your application.
