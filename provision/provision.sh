apt-get -qq update
apt-get install -y apache2
apt-get install -y php5
apt-get install -y php5-pgsql
apt-get install -y php5-sqlite
apt-get install -y php5-curl
apt-get install -y php5-memcache
apt-get install -y php5-memcached
apt-get install -y php5-xsl
apt-get install -y php5-xdebug
apt-get install -y php5-xmlrpc
apt-get install -y php5-gd
apt-get install -y php5-mcrypt
apt-get install -y php5-mongo
apt-get install -y php5-intl
apt-get install -y php5-json
apt-get install -y unixodbc
apt-get install -y libpq5
apt-get install -y memcached
apt-get install -y git-core
apt-get install -y zip
apt-get install -y unzip

cp /vagrant/provision/etc/php5/apache2/php.ini /etc/php5/apache2/php.ini
cp /vagrant/provision/etc/php5/cli/php.ini /etc/php5/cli/php.ini

cp /vagrant/provision/etc/apache2/sites-available/neptune.local.conf /etc/apache2/sites-available/neptune.local.conf

a2ensite neptune.local.conf
a2enmod rewrite

# Apache2 - changing apache2 base user
sed -i 's/APACHE_RUN_USER=www-data/APACHE_RUN_USER=vagrant/' /etc/apache2/envvars
sed -i 's/APACHE_RUN_GROUP=www-data/APACHE_RUN_GROUP=vagrant/' /etc/apache2/envvars
chown -R vagrant:www-data /var/lock/apache2
service apache2 stop
service apache2 start
echo '127.0.0.1 neptune.local' >> /etc/hosts

apt-get install -y postgresql
apt-get install -y postgresql-contrib

sudo -u postgres psql -c "ALTER USER postgres WITH PASSWORD 'postgres_password';"
sudo -u postgres psql -c "CREATE USER neptune WITH SUPERUSER PASSWORD 'neptune_pass';"
sudo -u postgres psql -c "CREATE DATABASE neptune;"
sudo -u postgres psql -c "GRANT ALL PRIVILEGES ON DATABASE neptune to neptune;"
sudo -u postgres psql -c "CREATE EXTENSION ltree;"

cp /vagrant/provision/etc/postgresql/9.4/main/pg_hba.conf /etc/postgresql/9.4/main/pg_hba.conf
cp /vagrant/provision/etc/postgresql/9.4/main/postgresql.conf /etc/postgresql/9.4/main/postgresql.conf

service postgresql restart


#memcache
cp /vagrant/provision/etc/init.d/memcached /etc/init.d/memcached
chmod u+x /etc/init.d/memcached


#Composer
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer.phar
chmod u+x /usr/local/bin/composer.phar
ln -s /usr/local/bin/composer.phar /usr/local/bin/composer


#other stuff
apt-get install -y vim mc htop

echo "KexAlgorithms curve25519-sha256@libssh.org,ecdh-sha2-nistp256,ecdh-sha2-nistp384,ecdh-sha2-nistp521,diffie-hellman-group-exchange-sha256,diffie-hellman-group14-sha1,diffie-hellman-group-exchange-sha1,diffie-hellman-group1-sha1" >> /etc/ssh/sshd_config
service ssh restart
