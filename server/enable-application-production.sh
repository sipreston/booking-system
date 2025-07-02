echo "##################"
echo "Enable Application"
echo "##################"

# Create a symbolic link for a new server block
sudo ln -s /var/www/example/server/apache/sites-available/example.conf /etc/apache2/sites-available/example.conf

# Enabling site configuration
sudo a2ensite example.conf

# Reloading Apache
sudo systemctl reload apache2

# Restarting Apache
sudo systemctl restart apache2

# Check the Apache site configuration
#sudo apachectl configtest

echo "##################"
echo "Start Application"
echo "##################"

sudo cp /var/www/example/server/application/.env.production /var/www/example/application/.env

## Update directory and file permissions. this location may defer, depending on the framework in use.
chmod -R 777 /var/www/example/application/storage

# For Laravel applications
chmod -R 777 /var/www/example/application/bootstrap/cache

#### Composer ####
# Ensure ~/.composer exists and is writable
if [ ! -d ~/.composer ]; then
    echo "Creating ~/.composer directory";
    mkdir ~/.composer
fi

chmod -R ugo+rw ~/.composer

# Make sure to run AFTER importing the database:
cd /var/www/example/application

if [ -f composer.json ];  then
    echo "Detected application file /var/www/example/application/composer.json";

    echo "Run composer install"
    composer install
#    echo "Run composer self-update"
#    composer self-update
    echo "composer dump-autoload"
    composer dump-autoload
else
    echo "Unable to locate application file /var/www/example/application/composer.json file";
fi

chmod +x /var/www/example/application/vendor/autoload.php

### Application #####
cd /var/www/example/application/
echo "Clear application caches"
echo "view:clear"
php artisan view:clear
echo "config:clear"
php artisan config:clear
echo "cache:clear"
php artisan cache:clear
echo "route:clear"
php artisan route:clear
echo "Running Application migrations"
php artisan migrate

# Create a symbolic link for a the cron jobs
sudo ln -s  /var/www/example/server/crontab/cronjobs-example-production /etc/cron.d/cronjobs-example

# The cron service won't use the cron file without these permissions
sudo chown -R root:root /var/www/example/server/crontab/cronjobs-example-production
sudo chmod 700 /var/www/example/server/crontab/cronjobs-example-production

# restart the cron jobs
sudo service cron restart

# view the status of the cron jobs
# sudo service cron status

# view the running cron jobs
# tail -f /var/log/syslog | grep CRON
