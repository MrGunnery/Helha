#!/bin/bash

. /root/admin/sh/initvar.sh

for IP in 'cat $IPFILE'
do
  if ping -c 2 $IP > /dev/null 2>&1
  then
    ssh root@$IP "sed -i -e \"s/TIMEOUT=0/TIMEOUT=5/g\" /etc/default/grub "
    ssh root@$IP "grub2-mkconfig -o /boot/grub2/grub.cfg"
    echo "Modif de grub sur $IP changee .... OK" >> $LOGDIR/$NAMELOG.log
  else
    echo "$IP ne repond pas..." >> $LOGDIR/$NAMELOG.error.log
  fi
done
