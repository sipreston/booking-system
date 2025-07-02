echo "#####################################"
echo "Executing start-application.sh script"
echo "#####################################"

# If the database is not imported, or the application is does not connect to an external database (remote server)
#   the `composer` and `php artisan` commands here will fail.
## Verify the connection parameters in ./vagrant/application/.env.local

## Copy the local .env configuration in the application root directory.
sudo cp  application/vagrant/application/.env.local  application/application/.env

## Update directory and file permissions
chmod -R 775  application/application/storage
chmod -R 775  application/application/bootstrap/cache

#### Composer ####
# Ensure ~/.composer exists and is writable
if [ ! -d ~/.composer ]; then
    echo "Creating ~/.composer directory";
    mkdir ~/.composer
fi

chmod -R ugo+rw ~/.composer
