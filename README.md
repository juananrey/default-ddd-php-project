Basic Symfony Flex Project With Docker + PHPUnit + PHPCS
--------------------------------------------------------

Basic skeleton containing just a `/_healthcheck` endpoint, and including:
- Dockerized startup (with PHP-FPM, check `/docker` folder and the `README.md` in there).
- PHPUnit (run `bin/phpunit` to pass the unit tests).
- PHPCS (symlink to `/vendor/bin/phpcs`, run `bin/phpcs` to run a code sniffer based on PSR2 standard).

If you want to include Redis in your project, run `docker-compose -f docker-compose-with-redis.yml up -d`

## Requirements
- Docker

## Installation
1) On the root folder, run: `docker-compose up -d` and wait for all required packages to install. 
2) Get into the machine (`docker exec -ti mylocalproject-php-fpm bash`) and run a `composer install` from inside
3) Go to [localhost:8000/_healthcheck](http://localhost:8000/_healthcheck), where you should be able to see this output:
```json
{
    "status": "i am ok"
}
```

Now, it is completely up to you how do you want your project to grow :)

## Going to production
If you consider the dockerized environment good enough to production, remember these two steps:
1) Run `composer install --no-dev --classmap-authoritative --apcu-autoloader`
2) Remember to change `APP_ENV` to `prod` within the `.env` file.

You can see a reasonably good performance by executing
[Apache Bench tool](https://httpd.apache.org/docs/2.4/programs/ab.html),
with around 100s of requests in 10s concurrent:
`ab -n 100 -c 10 http://localhost:8000/_healthcheck`