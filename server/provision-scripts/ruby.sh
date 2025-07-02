# Ruby
echo "###############"
echo "Installing Ruby"
echo "###############"
apt -y install make build-essential ruby ruby-dev zlib1g-dev -y \
  && apt-get install -y rubygems
