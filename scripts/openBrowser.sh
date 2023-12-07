#!/bin/bash
set -eou pipefail

IP_ADDRESS=$(docker inspect dnd5e-tool-php-app  -f '{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}')

echo "\033[33;1mthe ip adress is {$IP_ADDRESS}\033[0m"

#linux
xdg-open "http://{$IP_ADDRESS}/"

#windows
#start firefox "https://${IP_ADDRESS}/"

#mac
#open "http://${IP_ADDRESS}/"
