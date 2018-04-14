Basic Symfony Flex Project With Docker + PHPUnit + PHPCS
--------------------------------------------------------

Basic skeleton containing just a `/_healthcheck` endpoint, and including:
- Dockerized startup (with PHP-FPM + nginx, check `/docker` folder and the `README.md` in there).
- PHPUnit (run `bin/phpunit` to pass the unit and functional tests).
- PHPCS (symlink to `/vendor/bin/phpcs`, run `bin/phpcs` to run a code sniffer based on PSR2 standard).

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