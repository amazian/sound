#!/bin/bash
cd /var/www/sandbox/sound/
git pull
mysql -uroot -pZAQ!2wsx sound < /var/www/sandbox/sound/protected/data/schema.mysql.sql