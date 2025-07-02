# Install PHP 8.4
echo "##################"
echo "Installing PHP 8.4"
echo "##################"

apt-add-repository -y ppa:ondrej/php
apt-get update -y
apt-get install -y php8.4

apt-get install -y libapache2-mod-php8.4

# Add index.php to readable file types
MAKE_PHP_PRIORITY='<IfModule mod_dir.c>
    DirectoryIndex index.php index.html index.cgi index.pl index.xhtml index.htm
</IfModule>'
echo "$MAKE_PHP_PRIORITY" | tee /etc/apache2/mods-enabled/dir.conf

apt-get -y install php8.4-common
apt-get -y install php8.4-dev

apt-get -y install php8.4-mysql

apt-get install -y \
     php8.4-fpm \
     php8.4-cli \
     php8.4-pgsql \
     php8.4-sqlite3 \
     php8.4-gd \
     php8.4-mcrypt \
     php8.4-imap \
     php8.4-mbstring \
     php8.4-xml \
     php8.4-zip \
     php8.4-bcmath \
     php8.4-soap \
     php8.4-intl \
     php8.4-readline \
     php8.4-cgi \
     php8.4-bz2 \
     php8.4-json \
     php8.4-xmlrpc \
     php8.4-odbc \
     php8.4-pspell \
     php8.4-tidy \
     php8.4-pgsql \
     php8.4-gmp \
     php-pear \
     php-msgpack \
     php-igbinary

apt-get -y install libapache2-mod-fcgid
apt-get -y install libenchant-dev
apt-get -y install php8.4-enchant
apt-get -y install php8.4-curl
apt-get -y install php8.4-imagick

systemctl enable php8.4-fpm
systemctl start php8.4-fpm

# Change to have PHP 8.4 as the default version of the environment
update-alternatives --set php /usr/bin/php8.4
