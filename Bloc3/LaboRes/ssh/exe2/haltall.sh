#!/bin/bash

. /root/admin/sh/initvar.sh

for IP in 'cat $IPFILE'
do
  if ping -c 2 $IP > /dev/null 2>&1
  then
    ssh-copy-id root@$IP > /dev/null 2>&1
    ssh root$IP "shutdown -h now"
    
    echo "Extinction de $IP .... OK" >> $LOGDIR/$NAMELOG.log
  else
    echo "$IP eteinte..." >> $LOGDIR/$NAMELOG.error.log
  fi
done
