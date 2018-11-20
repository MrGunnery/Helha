#!/bin/bash

PUBKEYDIR="/root/.ssh"
LOGDIR="/root/admin/logs"
IPFILE="/root/admin/ip.txt"

for IP in 'cat $IPFILE'
do
  if ping -c 2 $IP > /dev/null 2>&1
  then
    ssh-copy-id root@$IP > /dev/null 2>&1
    echo "KPub recopiee sur $IP .... OK" >> $LOGDIR/pushkey.sh.log
  else
    echo "$IP ne repond pas..." >> $LOGDIR/pushkey.sh.error.log
  fi
done
