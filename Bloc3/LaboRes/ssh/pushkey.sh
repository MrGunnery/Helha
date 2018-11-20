#!/bin/bash

for IP in 'cat /root/admin/ip.txt
do
  if ping -c 2 $IP > /dev/null 2>&1
  then
    ssh-copy-id root@$IP > /dev/null 2>&1
    echo "KPub recopiee sur $IP .... OK" >> /root/admin/logs/pushkey.sh.log
  else
    echo "$IP ne repond pas..." >> /root/admin/logs/pushkey.sh.error.log
  fi
done
