# Chat App #

### What ###

RESTful API simple chat app build with slim framework

### Installation (the slow way) ###

* type `git clone git@github.com:ilhamarrouf/chat-app.git projectname` to clone the repository 
* type `cd projectname`
* type `composer install`
* in *.env.example* rename it to *.env* file :
   * set DB_DRIVER
   * set DB_HOST
   * set DB_DATABASE
   * set DB_USERNAME
   * set DB_PASSWORD
* in *phinx.yml.example* rename it to *phinx.yml* and customize your settings
* type `vendor/bin/phinx migrate` to create tables
* type `vendor/bin/phinx seed:run` to create dummy data

