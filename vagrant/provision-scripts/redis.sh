echo "##########################"
echo "Executing redis.sh script"
echo "##########################"

# Redis
apt-get update -y
apt-get -y install redis-server
apt-get -y install php8.4-redis
