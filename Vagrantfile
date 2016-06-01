# -*- mode: ruby -*-
# vi: set ft=ruby :

VAGRANTFILE_API_VERSION = '2'

@script = <<SCRIPT
DOCUMENT_ROOT_ZEND="/var/www/zf/public"
apt-get update
apt-get install -y apache2 git curl php5-cli php5 php5-intl

#Provisionning MySQL
debconf-set-selections <<< "mysql-server mysql-server/root_password password root"
debconf-set-selections <<< "mysql-server mysql-server/root_password_again password root"
apt-get install mysql-server -y > /dev/null
apt-get install php5-mysql

echo "
<VirtualHost *:80>
    ServerName skeleton-zf.local
    DocumentRoot $DOCUMENT_ROOT_ZEND
    <Directory $DOCUMENT_ROOT_ZEND>
        DirectoryIndex index.php
        AllowOverride All
        Order allow,deny
        Allow from all
    </Directory>
</VirtualHost>
" > /etc/apache2/sites-available/skeleton-zf.conf
a2enmod rewrite
a2dissite 000-default
a2ensite skeleton-zf
service apache2 restart
cd /var/www/zf
curl -Ss https://getcomposer.org/installer | php
echo "** [ZEND] Visit http://localhost:8085 in your browser for to view the application **"
SCRIPT

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  config.vm.box = 'ubuntu/trusty64'
  config.vm.network "forwarded_port", guest: 80, host: 8085
  config.vm.hostname = "skeleton-zf.local"
  config.vm.synced_folder '.', '/var/www/zf'
  config.vm.provision 'shell', inline: @script

  config.vm.provider "virtualbox" do |vb|
    vb.customize ["modifyvm", :id, "--memory", "1024"]
  end

end
