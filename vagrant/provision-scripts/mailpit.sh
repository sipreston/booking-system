echo "###########################"
echo "Executing Mailpit.sh script"
echo "###########################"

sudo adduser --system --no-create-home --group mailpit

sudo sh < <(curl -sL https://raw.githubusercontent.com/axllent/mailpit/develop/install.sh)
sudo mkdir /var/lib/mailpit
sudo chown -R mailpit:mailpit /var/lib/mailpit

sudo tee /etc/systemd/system/mailpit.service <<EOL
[Unit]
Description=Mailpit server

[Service]
ExecStart=/usr/local/bin/mailpit -d /var/lib/mailpit/mailpit.db
Restart=always
# Restart service after 10 seconds if service crashes
RestartSec=10
SyslogIdentifier=mailpit
User=mailpit
Group=mailpit

[Install]
WantedBy=multi-user.target
EOL
sudo systemctl enable mailpit
sudo systemctl start mailpit