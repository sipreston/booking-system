echo "############################"
echo "Executing phpunit.sh script"
echo "############################"

# PHP Unit
wget https://phar.phpunit.de/phpunit-12.2.5.phar
chmod +x phpunit-12.2.5.phar
mv phpunit-12.2.5.phar /usr/local/bin/phpunit
