echo "############################"
echo "Executing clean-up.sh script"
echo "############################"

# Disabling and removing default site configuration
a2dissite 000-default.conf
# Reloading Apache
systemctl reload apache2

# To keep the installation clean, autoremove anything that can get removed
apt-get autoremove -y
# Clean-up extra files
apt-get clean
# Remove files from the temporary directories
rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*
# Remove default /var/www/html folder
rm -rf /var/www/html