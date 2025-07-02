echo "############################"
echo "Executing php-8-4.sh script"
echo "############################"

# Install PHP $PHP_VERSION

add-apt-repository -y ppa:ondrej/php
apt-get update -y
apt-get install -y php$PHP_VERSION

# PHP module for the Apache webserver
apt-get install -y libapache2-mod-php$PHP_VERSION

# Add index.php to readable file types
MAKE_PHP_PRIORITY='<IfModule mod_dir.c>
    DirectoryIndex index.php index.html index.cgi index.pl index.xhtml index.htm
</IfModule>'
echo "$MAKE_PHP_PRIORITY" |  tee /etc/apache2/mods-enabled/dir.conf
service apache2 restart

# PHP Modules
apt-get -y install php$PHP_VERSION-common
apt-get -y install php$PHP_VERSION-dev

# MySQL
apt-get -y install php$PHP_VERSION-mysql

apt-get install -y \
     php$PHP_VERSION-fpm \
     php$PHP_VERSION-cli \
     php$PHP_VERSION-pgsql \
     php$PHP_VERSION-sqlite3 \
     php$PHP_VERSION-gd \
     php$PHP_VERSION-memcached \
     php$PHP_VERSION-mcrypt \
     php$PHP_VERSION-imap \
     php$PHP_VERSION-mbstring \
     php$PHP_VERSION-xml \
     php$PHP_VERSION-zip \
     php$PHP_VERSION-bcmath \
     php$PHP_VERSION-soap \
     php$PHP_VERSION-intl \
     php$PHP_VERSION-readline \
     php$PHP_VERSION-cgi \
     php$PHP_VERSION-bz2 \
     php$PHP_VERSION-xmlrpc \
     php$PHP_VERSION-odbc \
     php$PHP_VERSION-pspell \
     php$PHP_VERSION-tidy \
     php$PHP_VERSION-pgsql \
     php$PHP_VERSION-xdebug \
     php$PHP_VERSION-gmp \
     php-pear \
     php-msgpack \
     php-igbinary

# Contains a mod_fcgid that starts a number of CGI program instances to handle concurrent requests
apt-get -y install libapache2-mod-fcgid

# Enchant
apt-get -y install libenchant-dev
apt-get -y install php$PHP_VERSION-enchant

# LDAP
apt-get -y install ldap-utils
apt-get -y install php$PHP_VERSION-ldap

# CURL
apt-get -y install curl
apt-get -y install php$PHP_VERSION-curl

# IMAGE MAGIC
apt-get -y install imagemagick
apt-get -y install php$PHP_VERSION-imagick

# Xdebug
cp application/vagrant/php/mods-available/xdebug.ini /etc/php/8.4/mods-available/xdebug.ini
# Configure xdebug.ini
# sed -i "s/xdebug\.remote_host\=.*/xdebug\.remote_host\=$XDEBUG_HOST/g" /etc/php/8.4/mods-available/xdebug.ini

#    default: NOTICE: Not enabling PHP FPM by default.
#    default: NOTICE: To enable PHP FPM in Apache2 do:
#    default: NOTICE: a2enmod proxy_fcgi setenvif
#    default: NOTICE: a2enconf php$PHP_VERSION-fpm

# Start the php$PHP_VERSION-fpm service:
systemctl start php8.4-fpm

# User Settings
cp application/vagrant/php/mods-available/user.ini  application/application/.user.ini

# Absolutely Force Zend OPcache off...
 sed -i s,\;opcache.enable=0,opcache.enable=0,g /etc/php/8.4/apache2/php.ini
