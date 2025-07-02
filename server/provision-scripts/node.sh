#
# Install Node.js
#
echo "####################"
echo "Installing Node, NPM"
echo "####################"

curl -sL https://deb.nodesource.com/setup_22.x | sudo -E bash -
curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | sudo apt-key add -
echo "deb https://dl.yarnpkg.com/debian/ stable main" | sudo tee /etc/apt/sources.list.d/yarn.list

sudo apt-get install -y aptitude
sudo apt-get install -y nodejs

# Install some NPM packages

npm -g install requirejs
