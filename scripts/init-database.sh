#!/bin/bash

export MYSQL_ROOT_USER="root"
export MYSQL_ROOT_PASSWORD="example"


mysql -u {$MYSQL_ROOT_PASSWORD} -P {$MYSQL_ROOT_PASSWORD} < scripts/init-database.sh