#!/usr/bin/env bash

echo "####################"
echo "Upgrading PHP to 8.5"
echo "####################"

sudo apt-get update
sudo apt-get install -y php8.5

# PHP module for the Apache webserver
sudo apt-get install -y libapache2-mod-php8.5

# PHP Modules
sudo apt-get -y install php8.5-common
sudo apt-get -y install php8.5-dev

# MySQL
sudo apt-get -y install php8.5-mysql

sudo apt-get install -y \
     php8.5-bcmath \
     php8.5-bz2 \
     php8.5-cgi \
     php8.5-cli \
     php8.5-ctype \
     php8.5-curl \
     php8.5-enchant \
     php8.5-fpm \
     php8.5-gd \
     php8.5-gmp \
     php8.5-igbinary \
     php8.5-imagick \
     php8.5-imap \
     php8.5-intl \
     php8.5-ldap \
     php8.5-memcached \
     php8.5-mbstring \
     php8.5-mcrypt \
     php8.5-memcached \
     php8.5-odbc \
     php8.5-pdo \
     php8.5-pgsql \
     php8.5-pspell \
     php8.5-readline \
     php8.5-sqlite3 \
     php8.5-soap \
     php8.5-tidy \
     php8.5-xml \
     php8.5-xmlrpc \
     php8.5-zip

sudo update-alternatives --set php /usr/bin/php8.5

sudo a2dismod php8.4
sudo a2enmod php8.5

# Xdebug !! RUN ON DEV ONLY !!
sudo apt-get install php8.5-xdebug
sudo cp /var/www/booking-system/vagrant/php/mods-available/xdebug.ini /etc/php/8.5/mods-available/xdebug.ini

# Absolutely Force Zend OPcache off...
sudo sed -i s,\;opcache.enable=0,opcache.enable=0,g /etc/php/8.5/apache2/php.ini


sudo service apache2 restart
