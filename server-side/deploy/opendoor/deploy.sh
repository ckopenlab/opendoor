#!/bin/bash

PROJECT_NAME=opendoor
DEPLOY_PATH=/opt

. /lib/lsb/init-functions

log_action_msg Deploying [ opendoor ] \( by zshenjia@gmail.com \)

# Install php5-dev, php5-fpm, php5-sqlite, php5-xcache
log_action_msg Installing [ php5-dev ] by apt-get...
sudo apt-get install php5-dev -y

log_action_msg Installing [ php5-fpm ] by apt-get...
sudo apt-get install php5-fpm -y

log_action_msg Configuring [ php5-fpm ]...
sudo cp -r ./etc/php5 /etc/php5

log_action_msg Installing [ php5-sqlite ] by apt-get...
sudo apt-get install php5-sqlite -y

log_action_msg Installing [ php5-xcache ] by apt-get...
sudo apt-get install php5-xcache -y

# Install WiringPi
log_action_msg Building [ WiringPi ]...
./WiringPi/build >> /dev/null

# Install nginx
log_action_msg Installing [ nginx ] by apt-get...
sudo apt-get install nginx -y

log_action_msg Configuring [ nginx ]...
sudo rm -rf /etc/nginx
sudo cp -r ./etc/nginx /etc/nginx
log_end_msg $?

# Install code
log_action_msg Deploy frameworks to [ $DEPLOY_PATH/frameworks ]
sudo chown pi $DEPLOY_PATH
sudo cp -r ./opt/* $DEPLOY_PATH
chmod -R 777 $DEPLOY_PATH/$PROJECT_NAME/protected/runtime
chmod -R 777 $DEPLOY_PATH/$PROJECT_NAME/protected/data

# Start services
log_begin_msg Start [ php5-fpm ] service...
sudo service php5-fpm restart
log_end_msg $?

log_begin_msg Start [ nginx ] service...
sudo service nginx restart
log_end_msg $?

# Done
log_action_msg Deployed to [ $DEPLOY_PATH ];