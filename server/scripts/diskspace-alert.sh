#!/bin/bash

# Parse df selected output
df -h|egrep -v 'File|tmpfs|docker|udev'| \
while read LINE; do
        USED_NUMBER=`echo $LINE |awk '{print $5}'|sed 's/\%//'|sed 's/ //g'`
        USED_PERCENT=`echo $LINE |awk '{print $5}'|sed 's/ //g'`
        MOUNT_POINT=`echo $LINE |awk '{print $6}'|sed 's/ //g'`
        if [ $USED_NUMBER -gt 90 ]; then
                # Create message without spaces
                MESSAGE=`echo WARNING On $HOSTNAME disk $MOUNT_POINT is full at $USED_PERCENT usage WARNING|sed 's/ /_/g'`
                # Post message
                curl -X POST --data-urlencode \
                'payload={"channel": "#dev", "username": "memebot", "text": "'$MESSAGE'", "icon_emoji": ":ghost:"}' \
		            https://hooks.slack.com/services/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
        fi
done
