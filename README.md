# New project base framework

## Preface
This framework serves the base for new projects. Using this approach, projects can be self-contained from start to finish - from development to server.
It includes everything you need to get going with at the development environment, with Vagrant boxes based on Ubuntu, and server provisioning scripts, which you can tweak to match your development setup.
Using this approach means everything required is stored in the code repository, providing better visibility, and makes it much easier to track changes, as upgrade-scripts can be
added to the repository. With better parity between the vagrant box and the server, upgrade scripts can be tested on the box first, before being run on the server.

## Application
This contains the codebase

## Vagrant
Contains everything needed to get a development environment running. This will be where you determine which packages need to be installed, for the project to run. This will also determine the server setup.
* apache - contains the apache conf files and ssl keys. You will need to tweak the settings to tailor for your project setup. You may also need to create new keys. How to do this is included in the provision-scripts/enable-application.sh file.
* application - contains environmental settings for the application. i.e. if making a Laravel project, you would store the .env file here. This can be copied to application directory for quick setup for devs.
* crontab - store any cronjobs you may potentially want to run on a dev box here. Note, this file can not be symlinked. You must copy it to the /etc/cron.d/ directory and set permissions of 644.
* mysql - contains some custom settings for mysql on a dev box. general_log is disabled by default, but you may want this enabled to debug issues. Note that this file can get very large, inflating the size of your VM. Use sparingly.
* php - includes settings for php on a dev build, including settings xdebug
* provision-scripts - This contains scripts responsible for installing required packages on the vagrant box. These have been designed so that you can put together a collection of scripts like Lego; removing scripts (or adding new ones) as required by your project. You then add these scripts to the Vagrantfile, which will run through them, on first boot. It is important that the upgrade.sh script is run first, and the finish.sh script run last.
* upgrade-scripts - Contains any scripts required to update **existing** devs boxes, and also serves as a base test for upgrading a server with new packages. If you have created a upgrade script, it is your duty to replace the script, in the provision-scripts, with this newer package script, so that anyone, creating a fresh box from scratch, does not need to run this upgrade script, afterwards.

## Server
Contains server configuration files and provisional setup.
* apache - contains the site apache conf file plus other configurations such as htpasswd, which you need for password protecting a server. You can symlink the files in here directly in /etc/apache2
* application - contains environmental settings for the application. i.e. if making a Laravel project, you would store the .env files for the staging and live servers here.
* build - contains any files needed for running scripts on a server. The example deploy-crontab.sh deploys the crontab file, in server/cronjobs to /etc/cron.d/ and sets the permissions.
* cronjobs - contains the cronjob files that would be located in /etc/cron.d. Note you **can not** symlink these files. Whenever you make a change to these files you will need to copy the file to /etc/cron.d, then set the permissions to 644. There is an example crontab, for a Laravel project.
* logrotate - this is where you store files, that would be located in /etc/logrotate.d/ on the server. Logrotate is responsible for ensuring the log files are archived, daily (or weekly, depending on your setting). It contains an example setting. This can be symlinked.
* provision-scripts - contains a suite of scripts responsible for installing the required packages and server setup. You will not be using all these to build a server, you need to select ones applicable to the project in question. This should closely follow the provision scripts determined for the vagrant boxes. The provision-script.sh file is responsible for running these. See more below.
* scripts - any other scripts you want to run on the server. There is an example script for diskspace alerts, and is included in the crontab example files.
* upgrade-scripts - scripts for performing server upgrades. This should be empty, when starting a new project. An example is included for an upgrade script to php 7.4.
* provision-script.sh - this is the script that will be responsible for running the scripts contained in the provision-scripts directory. The one included in this framework serves as an example.
* Vagrantfile - The vagrant box configuration file. The one included serves as an example, and you will need to tweak it to your needs. It's important to change the IP address to one that isn't in use by another project (or, at the very least, not one being used by a project that requires muliple VMs running). It also contains the list of provision-scripts which will be required to build the box on first boot.

## Postman
Many projects need postman requests for testing, or connection to third party services. Store them in here, so they can be accessed by any devs, easily.

# Usage
## How to get going
cd to the vagrant directory of the project and run ``vagrant up``. If this is the first time running the virtual machine, it will take a few minutes to provision the system, installing all the various packages and setting up the database server so that it is ready for use.
Once this is complete the vagrant box will shut down. Run ``vagrant up`` again and it will now be ready for us. The provisioning will only need to be run once - or any time you delete the box and start afresh.

Once the box is running, run ``vagrant ssh`` to ssh in to the box. cd to the ``/var/www/booking-system/application`` directory and run the following in sequence.
* ``composer install``
* ``php artisan migrate``
* ``php artisan db:seed``
* ``npm ci``
* ``npm run build``

On your host machine add the following entries to your /etc/hosts file
* ``192.168.56.11 booking-system.in``
