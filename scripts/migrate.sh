#!/bin/bash
cd /var/www/html/

while [ ! -f /usr/local/etc/skeleton/skeleton.ini ]
do
  sleep 2
done

vendor/bin/phing -propertyfile /usr/local/etc/skeleton/skeleton.ini setup >> /var/log/deploy.log
chown -R apache:apache /var/www/html/*