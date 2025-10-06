echo "############################"
echo "Installing Mariadb.sh script"
echo "############################"

sudo debconf-set-selections <<< "mariadb-server mysql-server/root_password password root"
sudo debconf-set-selections <<< "mariadb-server mysql-server/root_password_again password root"
sudo debconf-set-selections <<< "mariadb-server mariadb-server/feedback_optin false"


sudo apt install gnupg software-properties-common apt-transport-https lsb-release ca-certificates -y
curl -LsS -O https://downloads.mariadb.com/MariaDB/mariadb_repo_setup
# Note 11.8.3 has a feedback plugin prompt which stops the script. 11.8.2 does not do this.
sudo bash mariadb_repo_setup --mariadb-server-version=11.8.2

sudo -E apt install mariadb-server -y

sudo mariadb -u root -proot -e "CREATE USER 'root'@'*' IDENTIFIED BY 'hT8Nw6KKa5N4eMFr';"
sudo mariadb -u root -proot -e "GRANT ALL PRIVILEGES ON *.* TO 'root'@'*';"
sudo mariadb -u root -proot -e "CREATE DATABASE bookingsystem CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci;"
sudo mariadb -u root -proot -e "CREATE USER 'bookingsystem'@'localhost' IDENTIFIED BY 'bookingsystem';"
sudo mariadb -u root -proot -e "GRANT ALL PRIVILEGES ON bookingsystem.* TO 'bookingsystem'@'localhost';"

sudo cp /var/www/booking-system/vagrant/mysql/my.cnf /etc/mysql/conf.d/my.cnf
sudo systemctl enable mariadb