ThreadsAndTrolls
================

## Developers 
### How to install
To install the game on a web server, put the files in a accessible directory, and execute the command `composer install` to
fetch dependencies.

You also have to execute the file "setup.sql" on your database, and configure the access to it in the file config.php

### Want to make your form compatible with T&T ?
You just need to create a class extending `MessageLoader` (check JolMessageLoader) then src/routes.php to add a route for your forum.

