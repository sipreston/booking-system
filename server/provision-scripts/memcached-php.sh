# Memcached for php 8.4
echo "####################"
echo "Installing memcached"
echo "####################"
apt-get -y install memcached
apt-get -y install php8.4-memcached
service apache2 restart
