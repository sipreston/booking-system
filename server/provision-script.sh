#!/usr/bin/env bash

# This is an example provisioning script and should not be used verbatim.
# But this example will be the base for most of our server setups.
# As a rule the upgrade.sh and finish.sh scripts should always book end the script
# run orders. But you will need to tweak the other script dependent on project needs.
# The vagrant provisioning scripts should provide a good base for what you need to install on the server.
#
# Do not run any project specific scripts, in this process. This is for installing/configuring the packages required only.
# Ensure you run this script as the root user.

cd provision-scripts
# Upgrade.sh should ALWAYS be the first script that is run.
./upgrade.sh

# Now fill your sandwich with tasty ingredients
./apache2
./certbot.sh
./php.sh
./swapfile.sh
./redis.sh
./memcached.sh
./composer.sh
./node.sh

# Enable if you wish to install Mailhog on a QA build
#./mailhog.sh

# Finish.sh should always be the LAST script that is run.
./finish.sh
