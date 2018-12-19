copier fwless.sh fwfull.sh (fw)

modifier la section start
  
  # DROP de toutes les regles
  for chaine in INPUT OUTPUT FORWARD
  do
    iptables -P $chaine DROP
  done
  
  # activer les requete local
  iptables -A INPUT -i lo -j ACCEPT
  iptables -A OUTPUT -0 lo -j ACCEPT
  
  # fw pour que les lan puissent communiquer avec le dnsint
  for lan in $lanws $lanint $dmz
  do
    iptables -A FORWARD -p udp --dport 53 -s $lan -d $dnsint -m state --state NEW,ESTABLISHED -j ACCEPT
    iptables -A FORWARD -p udp --sport 53 -d $lan -s $dnsint -m state --state ESTABLISHED -j ACCEPT
  done
  
  # fw pour que le dnsint puisse contacter l'exterieur
  for dnsfai in $dnsfai1 $dnsfai2
  do
    iptables -A FORWARDING -i enp0s3 -o enp0s9 -p udp --dport 53 -s $dnsint -d $dnsfai -m state --state NEW,ESTABLISHED -j ACCEPT
    iptables -A FORWARDING -i enp0s3 -o enp0s9 -p udp --sport 53 -d $dnsint -s $dnsfai -m state --state ESTABLISHED -j ACCEPT
  done
  
  # ne pas oublier le nat
  iptables -t nat -A POSTROUTING -o enp0s3 -j MASQUERADE
 
  # Autoriser l'acces ssh sur le fw a partir de lanint
  iptables -A INPUT -i enp0s9 -s $lanint -p tcp --dport 22 -m state --state NEW,ESTABLISHED -j ACCEPT
  iptables -A OUTPUT -o enp0s9 -d $lanint -p tcp --dport 22 -m state --state ESTABLISHED -j ACCEPT
  
  # Autoriser l'acces http sur le webint a partir de lanws
  iptables -A FORWARD -i enp0s8 -o enp0s9 -p tcp --dport 80 --sport 1024: -s $lanws -d $webint -m state --state NEW,ESTABLISHED -j ACCEPT
  iptables -A FORWARD -0 enp0s8 -i enp0s9 -p tcp --sport 80 --dport 1024: -d $lanws -s $webint -m state --state ESTABLISHED -j ACCEPT

  # Autoriser l'acces au service de la dmz a partir de l'exterieur
  iptables -t nat -A PREROUTING -i enp0s3 -p tcp --dport 80 -j DNAT --to-destination $webext:80
  iptables -t nat -A PREROUTING -i enp0s3 -p tcp --dport 22 -j DNAT --to-destination $sshext:22
  
  # + ouvrir le FORWARD car il est DROP par default
  iptables -A FORWARD -i enp0s3 -o enp0s10 -p tcp --dport 80 -d $webext -j ACCEPT
  iptables -A FORWARD -o enp0s3 -i enp0s10 -p tcp --sport 80 -s $webext -j ACCEPT
  iptables -A FORWARD -i enp0s3 -o enp0s10 -p tcp --dport 22 -d $sshext -j ACCEPT
  iptables -A FORWARD -o enp0s3 -i enp0s10 -p tcp --sport 22 -s $sshext -j ACCEPT
