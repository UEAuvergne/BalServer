#!/bin/bash

docker run -v /var/www/balserver:/app -e SERVER_NAME=$SERVER_NAME -e FRANKENPHP_CONFIG="worker /app/public/index.php" -e APP_RUNTIME=Runtime\\FrankenPhpSymfony\\Runtime -p 80:80 -p 443:443 -p 443:443/udp dunglas/frankenphp
