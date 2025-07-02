# Redis for php 8.4
echo "#################"
echo "Installing Redis"
echo "#################"
apt-get update -y
apt-get -y install redis-server
apt-get -y install php8.4-redis
service apache2 restart
