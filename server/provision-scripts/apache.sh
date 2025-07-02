#
# Install Apache
#
echo "###################"
echo "Installing Apache2"
echo "###################"
apt-get install -y apache2

# Enable modules

a2enmod expires
a2enmod headers
a2enmod include
a2enmod proxy
a2enmod rewrite
a2enmod ssl
a2enmod setenvif
a2enmod actions
a2enmod fcgid
a2enmod alias
a2enmod proxy_fcgi

ufw allow http
ufw allow https
