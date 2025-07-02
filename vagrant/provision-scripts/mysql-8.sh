echo "###########################"
echo "Executing mysql-8.sh script"
echo "###########################"

# MySQL 8 set up
# Note: This is dependent on what OS you are running. If you are using Ubuntu 18.04,
# then MySql 5.6 is installed by default. Ubuntu 20.04 comes with version 8.
debconf-set-selections <<< 'mysql-server mysql-server/root_password password root'
debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password root'
apt-get -y install mysql-server

## Create a basic database
# MySQL does allow for the creation of a user, when granting privileges, so this must be done separately.
mysql -u root -proot -e "CREATE USER 'root'@'*' IDENTIFIED BY 'root';"
mysql -u root -proot -e "GRANT ALL PRIVILEGES ON *.* TO 'root'@'*';"
mysql -u root -proot -e "CREATE DATABASE bookingsystem CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;"
mysql -u root -proot -e "CREATE USER 'bookingsystem'@'localhost' IDENTIFIED BY 'bookingsystem';"
mysql -u root -proot -e "GRANT ALL PRIVILEGES ON bookingsystem.* TO 'bookingsystem'@'localhost';"

cp application/vagrant/mysql/my.cnf /etc/mysql/mysql.conf.d/my.cnf

systemctl enable mysql
