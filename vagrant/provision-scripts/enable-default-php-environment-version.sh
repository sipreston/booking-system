echo "#######################################################"
echo "Executing enable-default-php-environment-version script"
echo "#######################################################"

# Change to have PHP 8.3 as the default version of the environment
sudo update-alternatives --set php /usr/bin/php8.4
