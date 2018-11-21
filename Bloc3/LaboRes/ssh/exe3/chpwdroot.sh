#!/bin/bash

. /root/admin/sh/initvar.sh

for IP in 'cat $IPFILE'
do
  if ping -c 2 $IP > /dev/null 2>&1
  then
    ssh root@$IP "echo $1 | passwd --stdin root"
    echo "MdP sur $IP changee .... OK" >> $LOGDIR/$NAMELOG.log
  else
    echo "$IP ne repond pas..." >> $LOGDIR/$NAMELOG.error.log
  fi
done
