echo "######################################"
echo "Executing enable-application.sh script"
echo "######################################"

# Create symbolic links for SSL keys
## To generate new keys do the following:
  # cd /var/www/booking-system/vagrant/apache/keys/
  # openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout otbs.key -out site.crt
cp application/vagrant/apache/keys/site.crt /etc/ssl/certs/site.crt
cp application/vagrant/apache/keys/site.key /etc/ssl/certs/site.key

# Copy apache file
cp application/vagrant/apache/sites-available/site.conf /etc/apache2/sites-available/site.conf

# Enabling site configuration
a2ensite site.conf

