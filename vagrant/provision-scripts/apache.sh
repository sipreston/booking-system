echo "##########################"
echo "Executing apache.sh script"
echo "##########################"

# Apache
add-apt-repository -y ppa:ondrej/apache2 # Latest Version
apt-get update
apt install apache2 -y

# Enabled missing h5bp modules (https://github.com/h5bp/server-configs-apache)
a2enmod expires
a2enmod headers
a2enmod include
a2enmod proxy
a2enmod ssl
a2enmod setenvif

# Enable modules for Apache2 service can work with multiple PHP versions
# Executing CGI scripts based on media type or request method
a2enmod actions
# High performance alternative to mod_cgi that starts a sufficient number of instances of the CGI program to handle concurrent requests
a2enmod fcgid
# Provides for the mapping of different parts of the host filesystem in the document tree, and for URL redirection
a2enmod alias
# Allows Apache to forward requests to PHP-FPM
a2enmod proxy_fcgi

# Enabling mod_rewrite
a2enmod rewrite

# Enable Firewall
ufw allow 4000

#Tip: tree is a useful command for seeing file and directory structures from the command-line. You can install it with the following command:
#To use it, cd into the directory you want and type tree or provide the path to the starting point with tree /home/sammy/www
apt-get install tree