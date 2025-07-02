# Install certbot. This is required for sites where Let's Encrypt will be deployed
# for free SSL certificates. Remember to run sudo certbot --apache, once
# the project has been deployed and configured.

echo "##################"
echo "Installing Certbot"
echo "##################"
snap install core
snap refresh core
snap install --classic certbot
ln -s /snap/bin/certbot /usr/bin/certbot
