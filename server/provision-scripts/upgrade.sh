#
# Update package lists
#
export DEBIAN_FRONTEND=noninteractive
export LANGUAGE=en_US.UTF-8
export LANG=en_US.UTF-8
export LC_ALL=en_US.UTF-8
locale-gen en_US.UTF-8
dpkg-reconfigure locales
chmod +x -R ./provision-scripts

echo "##########################################"
echo "Installing base packages and configuration"
echo "##########################################"
apt-get update
apt-get upgrade -y

apt-get install software-properties-common
apt-get install wget
apt-get install curl

#
# Force locale, set timezone
#
echo "LC_ALL=en_US.UTF-8" >> /etc/default/locale
locale-gen en_US.UTF-8
ln -sf /usr/share/zoneinfo/UTC /etc/localtime

#
# Install basic packages
#
apt-get update
apt-get install -y apt-transport-https \
	build-essential \
	git-core \
	libssl-dev \
	libreadline-dev \
	libyaml-dev \
	libsqlite3-dev \
	libxml2-dev \
	libxslt1-dev \
	libcurl4-openssl-dev \
	libffi-dev \
	sqlite3 \
	tcl \
	tree \
	unzip \
	vim \
	zip \
	zlib1g-dev
