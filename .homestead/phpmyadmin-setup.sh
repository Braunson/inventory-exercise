#!/bin/bash

LATEST_VERSION=$(curl -sS 'https://api.github.com/repos/phpmyadmin/phpmyadmin/releases/latest' | awk -F '"' '/tag_name/{print $4}')
DOWNLOAD_URL="https://api.github.com/repos/phpmyadmin/phpmyadmin/tarball/$LATEST_VERSION"

echo "Downloading phpMyAdmin $LATEST_VERSION"
wget $DOWNLOAD_URL -q -O 'phpmyadmin.tar.gz'

[ -d phpmyadmin ] || mkdir -p phpmyadmin

tar xf phpmyadmin.tar.gz -C phpmyadmin --strip-components 1

rm phpmyadmin.tar.gz

cp /home/vagrant/exercise/.homestead/stubs/phpmyadmin.config.inc.php.dist $(pwd)/phpmyadmin/config.inc.php

echo "Installing dependencies for phpMyAdmin"
cd phpmyadmin && composer update --no-dev --quiet --no-interaction