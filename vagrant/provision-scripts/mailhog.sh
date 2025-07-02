echo "###########################"
echo "Executing mailhog.sh script"
echo "###########################"

#### GOLANG ####
add-apt-repository -y ppa:longsleep/golang-backports
apt-get update
apt-get -y install golang-go

#### MAILHOG ####
wget --quiet -O ~/mailhog https://github.com/mailhog/MailHog/releases/download/v1.0.0/MailHog_linux_amd64
chmod +x ~/mailhog

# Enable and turn on
tee /etc/systemd/system/mailhog.service <<EOL
[Unit]
Description=MailHog Service
After=network.service vagrant.mount
[Service]
Type=simple
ExecStart=/usr/bin/env /home/vagrant/mailhog > /dev/null 2>&1 &
[Install]
WantedBy=multi-user.target
EOL
systemctl enable mailhog
systemctl start mailhog

# Install Sendmail replacement for MailHog
go get github.com/mailhog/mhsendmail
ln ~/go/bin/mhsendmail /usr/bin/mhsendmail
ln ~/go/bin/mhsendmail /usr/bin/sendmail
ln ~/go/bin/mhsendmail /usr/bin/mail

echo $'\nsendmail_path = /usr/bin/mhsendmail' | tee -a /etc/php/8.4/apache2/conf.d/user.ini

a2ensite mailhog.conf
systemctl reload apache2
