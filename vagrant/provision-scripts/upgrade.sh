echo "############################"
echo "Executing upgrade.sh script"
echo "############################"

# Updating Currently Installed Packages
export DEBIAN_FRONTEND=noninteractive

apt-get update -y
apt-get install -y gnupg tzdata
echo "UTC" > /etc/timezone
dpkg-reconfigure -f noninteractive tzdata

apt-get update -y
apt-get upgrade --force-yes
apt-get dist-upgrade -y

apt-get install -y build-essential
apt-get install -y tcl

apt-get install -y ca-certificates
apt-get install -y apt-transport-https
apt-get install -y software-properties-common
#apt-get install -y supervisor
apt-get install -y wget curl zip unzip git vim
apt-get install -y iputils-ping

apt-get install -y ufw

# Weird Vagrant issue fix
apt-get install -y ifupdown