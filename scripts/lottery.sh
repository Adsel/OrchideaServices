#!/bin/bash
# FILE WHICH IS EXECUTED BY CRONTAB
# IT GENERATES LOTTERY RESULTS

cd /var/www/html/scripts/
php /var/www/html/scripts/rand.php
