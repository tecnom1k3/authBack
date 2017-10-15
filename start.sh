#!/usr/bin/env bash

docker-compose up -d --build
docker exec -d authback-php-fpm /usr/local/bin/supervisord -c /etc/supervisord.conf
