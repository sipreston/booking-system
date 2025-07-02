# Use if you need to use a login prompt on the website
# Install after Apache2

apt-get install apache2-utils
touch /etc/apache2/.htpasswd

ln -s /var/www/example/server/apache/conf-available/htpasswd.conf /etc/apache2/conf-available/htpasswd.conf
a2enconf htpasswd.conf
systemctl reload apache2

# You will need to run this command manually, once provisioned
# htpasswd /etc/apache2/.htpasswd 3ev

