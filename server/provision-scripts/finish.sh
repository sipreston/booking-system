echo "###########"
echo "Cleaning up"
echo "###########"

# Ensure we can clone things from github.com without being asked for key confirmation
echo -e "Host github.com\n\tStrictHostKeyChecking no\n" >> ~/.ssh/config

apt-get autoremove -y
apt-get clean

a2dissite 000-default.conf
systemctl reload apache2
systemctl enable apache2

rm -rf /var/www/html/

echo "#####################################################"
echo "Server provisioning complete. System will reboot now."
echo "Restart the server in Google Cloud"
echo "#####################################################"

# Necessary to ensure all installed packages are properly bedded in.
shutdown now
