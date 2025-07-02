#!/usr/bin/env bash
# This MUST be run if the production crontabs (normal and importers) have been changed
# and you need those changes deployed. Do NOT alter the crontab files directly on the server

# Create a copy of the cronjobs file in cron.d
# This is necessary, as the file is required to be owned by root,
# which breaks git merges, when symlinking to it
sudo cp ../crontab/example /etc/cron.d/example
sudo chown root:root /etc/cron.d/example
sudo chmod 644 /etc/cron.d/example
