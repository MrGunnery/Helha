#!/bin/bash
#
#############################################################################
#
VARIABLES
#
#############################################################################
lanws=10.0.10.0/24
lanint=10.0.20.0/24
dmz=10.0.30.0/24
ipext= 10.103.0.x
dnsfai1=109.88.203.3
dnsfai2=62.197.111.140
webext=10.0.30.2
sshext=10.0.30.3
webint=10.0.20.2
dnsint=10.0.20.3
######################################################################
#
ARRET (TOUT OUVERT) MEME L'ACCES AUX SERVICES INTERNES
######################################################################
stop()
{
#
# On nettoye toutes les regles des tables filter et nat
iptables -F
iptables -X # Pour les regles utilisateurs
iptables -t nat -F
iptables -t nat -X # Pour les regles utilisateurs
# On ouvre tout
for chaine in INPUT OUTPUT FORWARD
do
iptables -P $chaine ACCEPT
done
for chaine in PREROUTING POSTROUTING OUTPUT
do
iptables -t nat -P $chaine ACCEPT
done
# Et meme les cibles -j MASQUERADE et -j DNAT
iptables -t nat -A POSTROUTING -o enp0s3 -j MASQUERADE
iptables -t nat -A PREROUTING -i enp0s3 -p tcp --dport 80 -j DNAT
--to-destination $webext:80
iptables -t nat -A PREROUTING -i enp0s3 -p tcp --dport 22 -j DNAT
--to-destination $sshext:22
echo "[Done.]"
}
Page 5/10###########################################################################
#
DEMARRAGE (TOUT FERME) SAUF LES ACCES AUTORISES POUR L'EXERCICE
#
###########################################################################
start()
{
# On nettoye toutes les regles des tables filter et nat
########################################################
iptables -F
iptables -X # Pour les regles utilisateurs
iptables -t nat -F
iptables -t nat -X # Pour les regles utilisateurs
# On ferme tout (pas de DROP sur nat)
#####################################
for chaine in INPUT OUTPUT FORWARD
do
iptables -P $chaine DROP
done
# Les services locaux doivent pouvoir communiquer entre eux
###########################################################
iptables -A INPUT -i lo -j ACCEPT
iptables -A OUTPUT -o lo -j ACCEPT
# On ouvre la translation d'adresse (on aurait pu travailler avec MASQUERADE)
# (Sinon il n'y aurait pas de nating et l'accès à l'extérieur de l'intérieur
# serait tout simplement impossible)
#############################################################################
###iptables -t nat -A POSTROUTING -o enp0s3 -j MASQUERADE
### ou
iptables -t nat -A POSTROUTING -o enp0s3 -j SNAT --to $ipext
# Ouvre la resolution dns vers dnsint pour tous les hosts des lans
##################################################################
for lan in $lanws $lanint $dmz
do
# Lan vers dnsint
iptables -A FORWARD -p udp --dport 53 -s $lan -d $dnsint -j ACCEPT
iptables -A FORWARD -p udp --sport 53 -s $dnsint -d $lan -j ACCEPT
done
for dnsfai
do
# dnsint
iptables
ACCEPT
iptables
ACCEPT
done
in $dnsfai1 $dnsfai2
vers dnsfai
-A FORWARD -i enp0s9 -o enp0s3 -p udp --dport 53 -s $dnsint -d $dnsfai -j
-A FORWARD -i enp0s3 -o enp0s9 -p udp --sport 53 -s $dnsfai -d $dnsint -j
# Autoriser l'acces ssh sur fw des hosts de lanint
###################################################
iptables -A INPUT -i enp0s9 -s $lanint -p tcp --dport 22 -j ACCEPT
iptables -A OUTPUT -o enp0s9 -d $lanint -p tcp --sport 22 -j ACCEPT
# Autoriser l'acces http a webint uniquement a partir des hosts de lanws
########################################################################
iptables -A FORWARD -i enp0s8 -o enp0s9 -p tcp --dport 80 --sport 1024: -s $lanws
-d $webint -j ACCEPT
iptables -A FORWARD -i enp0s9 -o enp0s8 -p tcp --dport 1024: --sport 80 -s $webint
-d $lanws -j ACCEPT
# Autoriser l'acces aux services web et ssh sur les hosts de la dmz a partir du web
###################################################################################
iptables -t nat -A PREROUTING -i enp0s3 -p tcp --dport 80 -j DNAT
--to-destination $webext:80
iptables -t nat -A PREROUTING -i enp0s3 -p tcp --dport 22 -j DNAT
--to-destination $sshext:22
# Ne pas oublier le forward car il est DROP.
# En effet, il faut autoriser celui-ci apres un PREROUTING
iptables -A FORWARD -i enp0s3 -o enp0s10 -p tcp --dport 80 -j ACCEPT
iptables -A FORWARD -i enp0s10 -o enp0s3 -p tcp --sport 80 -j ACCEPT
iptables -A FORWARD -i enp0s3 -o enp0s10 -p tcp --dport 22 -j ACCEPT
iptables -A FORWARD -i enp0s10 -o enp0s3 -p tcp --sport 22 -j ACCEPT
echo "[Done.]"
}
status()
{
iptables -L
iptables -t nat -L;;
}
########################################################
#
GESTION DU PASSAGE DE PARAMETRES AU SCRIPT
#
########################################################
case "$1" in
start)
echo "Firewall is starting ..."
start;;
esac
stop) echo "Firewall is stopping ... "
stop;;
restart) echo "Firewall is stopping ... "
stop
echo "Firewall is starting ..."
start;;
status) status;;
*) echo "Usage: $0 {start|stop|restart|status}";;
