#!/bin/bash

. /root/admin/sh/initvar.sh

for IP in 'cat $IPFILE'
do
  if ping -c 2 $IP > /dev/null 2>&1
  then
    ssh root@$IP "useradd $1 > /dev/null 2>&1"
    ssh root@$IP "echo $1 | passwd --stdin $1 > /dev/null 2>&1"
    echo "Ajout de $1 sur $IP changee .... OK" >> $LOGDIR/$NAMELOG.log
  else
    echo "$IP ne repond pas..." >> $LOGDIR/$NAMELOG.error.log
  fi
done
