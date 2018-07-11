#!/bin/bash

sudo echo "change ownership as yours & add to www-data group"
sudo chown -R $USER:www-data ..

echo "change permission"
sudo chmod -R 775 ..

echo "done."