echo "############################"
echo "Executing swapfile.sh script"
echo "############################"

# Source:
# https://stackoverflow.com/questions/55069471/how-to-solve-this-error-on-live-server-for-laravel/55074773#55074773

# Creating 1GB memory swapfile
fallocate -l 1G /swapfile
dd if=/dev/zero of=/swapfile bs=1024 count=1048576

# Configuring file to swap
chmod 600 /swapfile
mkswap /swapfile

# Enable swap
swapon /swapfile

#To check:
# free -m