echo "#################################"
echo "Starting Vagrant provision script"
echo "#################################"

ln -s /var/www/booking-system ~/application
export PHP_VERSION=8.4
export APP_NAME=booking-system