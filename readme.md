# Shaftaloo!

## Installation

To run the project on your local machine:

```bash
$ git clone https://github.com/miladrahimi/shaftaloo
$ cd shaftaloo
$ chmod -R 0777 storage
$ chmod -R 0777 bootstrap/cache
$ cp .env.example .env
$ docker-compose up -d
$ docker-compose exec php composer install
$ docker-compose exec php php artisan migrate:refresh --seed
```

## License
[MIT License](http://opensource.org/licenses/mit-license.php)
