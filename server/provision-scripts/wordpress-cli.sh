# Wordpress CLI for Wordpress sites.

echo "########################"
echo "Installing Wordpress CLI"
echo "########################"
curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
chmod +x wp-cli.phar
sudo mv wp-cli.phar /usr/local/bin/wp
