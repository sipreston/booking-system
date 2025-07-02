# Composer V2
echo "###################"
echo "Installing Composer"
echo "###################"
EXPECTED_SIGNATURE=$(wget -q -O - https://composer.github.io/installer.sig)
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
ACTUAL_SIGNATURE=$(php -r "echo hash_file('SHA384', 'composer-setup.php');")

php composer-setup.php --quiet
rm composer-setup.php
mv composer.phar /usr/local/bin/composer
