#!/bin/sh

# If you would like to do some extra provisioning you may
# add any commands you wish to this file and they will
# be run after the Homestead machine is provisioned.

if [ ! -f /usr/local/extra_homestead_software_installed ]; then
	echo 'installing some extra software'

	# Install PHPMyAdmin
	echo 'installing PHPMyAdmin'
	sh /home/vagrant/exercise/.homestead/phpmyadmin-setup.sh
	
else
	echo "extra software already installed... moving on..."
fi
