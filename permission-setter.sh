#!/bin/bash

echo "==============================="
echo "change ownership as yours"
echo "add group www-data"
echo "change permission to 775"
sudo echo "==============================="

for foldername in ./*; do
    if [ $foldername != './vendor' ]
    then
        echo "configuring $foldername"
        sudo chown -R $USER:www-data $foldername
        sudo chmod -R 775 $foldername
    fi
done

echo "==============================="
echo "done."
echo "==============================="
