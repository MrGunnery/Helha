#!/bin/bash
echo -e "start win7 \n quit \n"|virsh -c qemu+ssh://root@192.168.1.155/system
virt-viewer -k --kiosk-quit on-disconnect --connect qemu+ssh://root@192.168.1.1$
exit
