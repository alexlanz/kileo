#!/bin/bash

# Locales
grep -q 'LC_ALL="en_US.UTF-8"' /etc/environment || echo 'LC_ALL="en_US.UTF-8"' >> /etc/environment

# Hostname, Hosts
cp /vagrant/vagrant/files/hostname /etc/hostname
cp /vagrant/vagrant/files/hosts /etc/hosts

# Timezone
cp /vagrant/vagrant/files/timezone /etc/timezone
dpkg-reconfigure --frontend noninteractive tzdata

# Updates
apt-get update
apt-get upgrade -y

# Basic packages
apt-get install -y build-essential software-properties-common curl wget vim git

# MySQL
debconf-set-selections <<< 'mysql-server mysql-server/root_password password password'
debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password password'
apt-get install -y mysql-client mysql-server
mysql --user=root --password=password --database=mysql --execute="DELETE FROM user where user='root' and host='127.0.0.1'"
mysql --user=root --password=password --database=mysql --execute="DELETE FROM user where user='root' and host='::1'"
mysql --user=root --password=password --database=mysql --execute="DELETE FROM user where user='root' and host='vagrant-ubuntu-trusty-64'"
mysql --user=root --password=password --database=mysql --execute="DELETE FROM user where user='debian-sys-maint' and host='localhost'"
mysql --user=root --password=password --database=mysql --execute="CREATE DATABASE kileo"
mysql --user=root --password=password --database=mysql --execute="GRANT ALL ON kileo.* TO kileo@localhost IDENTIFIED BY 'password'"
service mysql restart

# PHP-FPM
add-apt-repository -y ppa:ondrej/php5
apt-get update
apt-get install -y --force-yes php5-fpm php5-cli php5-mysql php5-sqlite php5-curl php5-gd php5-mcrypt php5-json php5-xdebug

sed -i "s/error_reporting = .*/error_reporting = E_ALL/" /etc/php5/cli/php.ini
sed -i "s/display_errors = .*/display_errors = On/" /etc/php5/cli/php.ini
sed -i "s/memory_limit = .*/memory_limit = 512M/" /etc/php5/cli/php.ini
sed -i "s/;date.timezone.*/date.timezone = Europe\/Rome/" /etc/php5/cli/php.ini

sed -i "s/error_reporting = .*/error_reporting = E_ALL/" /etc/php5/fpm/php.ini
sed -i "s/display_errors = .*/display_errors = On/" /etc/php5/fpm/php.ini
sed -i "s/;cgi.fix_pathinfo=1/cgi.fix_pathinfo=0/" /etc/php5/fpm/php.ini
sed -i "s/memory_limit = .*/memory_limit = 512M/" /etc/php5/fpm/php.ini
sed -i "s/;date.timezone.*/date.timezone = Europe\/Rome/" /etc/php5/fpm/php.ini

grep -q 'xdebug.remote_enable = 1' /etc/php5/fpm/conf.d/20-xdebug.ini || echo 'xdebug.remote_enable = 1' >> /etc/php5/fpm/conf.d/20-xdebug.ini
grep -q 'xdebug.remote_connect_back = 1' /etc/php5/fpm/conf.d/20-xdebug.ini || echo 'xdebug.remote_connect_back = 1' >> /etc/php5/fpm/conf.d/20-xdebug.ini
grep -q 'xdebug.remote_port = 9000' /etc/php5/fpm/conf.d/20-xdebug.ini || echo 'xdebug.remote_port = 9000' >> /etc/php5/fpm/conf.d/20-xdebug.ini
grep -q 'xdebug.max_nesting_level = 200' /etc/php5/fpm/conf.d/20-xdebug.ini || echo 'xdebug.max_nesting_level = 200' >> /etc/php5/fpm/conf.d/20-xdebug.ini

service php5-fpm restart

# Nginx
add-apt-repository -y ppa:nginx/stable
apt-get update
apt-get install -y nginx
rm -f /etc/nginx/sites-enabled/default
rm -f /etc/nginx/sites-available/default
cp /vagrant/vagrant/files/kileo.dev.conf /etc/nginx/sites-available/
ln -s /etc/nginx/sites-available/kileo.dev.conf /etc/nginx/sites-enabled/kileo.dev.conf
service nginx restart

# Composer
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer

# Node.js
apt-get install -y nodejs nodejs-legacy npm
npm install -g gulp bower karma-cli