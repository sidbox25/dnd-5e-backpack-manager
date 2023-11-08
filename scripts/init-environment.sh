#!/bin/bash
set -eou pipefail

docker exec dnd5e-tool-php-app composer update
docker exec dnd5e-tool-php-app composer install
docker exec dnd5e-tool-php-app composer dumpautoload
