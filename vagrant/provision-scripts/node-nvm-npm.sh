echo "#################################"
echo "Executing node-nvm-npm.sh script"
echo "#################################"

# Node, NVM, NPM
cd ~ \
  && curl -sL https://deb.nodesource.com/setup_22.x -o nodesource_setup.sh \
  && sudo bash nodesource_setup.sh \
  && sudo apt-get -y install nodejs \
  && curl --silent -o- https://raw.githubusercontent.com/creationix/nvm/master/install.sh | bash;
#  && sudo apt-get install -y npm \
