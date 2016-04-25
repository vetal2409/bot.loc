# BOT #


### Requirements ###
* [VirtualBox 5 or higher](https://www.virtualbox.org/)
* [Vagrant 1.8.x or higher](https://www.vagrantup.com/)


### Installation ###

* clone repository with `git clone` command
* go inside to project directory
* run command `vagrant up` to up vagrant
* run command `vagrant ssh` to enter to the server via ssh
* run command `sudo /bin/bash /var/www/bot.loc/bash/run` to init some things (bot, composer install)


### USAGE ###
#####Yoy can find more information in 'task.pdf' #####

        command [arguments]
##### Available commands: ####
* `bot schedule [{IMAGE_DIR_PATH}]]`   Add filenames to resize queue
* `bot resize [-n {COUNT}]`            Resize next images from the queue
* `bot upload [-n {COUNT}]`            Upload next images to remote storage
* `bot retry [-n {COUNT}]`             Moves all URLs from failed queue back to resize queue
* `bot status`                         Output current status in format %queue%:%number_of_images%
