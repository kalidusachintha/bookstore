# Book Store
## System Requirement 

- PHP 7
- Mysql 5.7 
- Ubuntu 16.04

## Installtion Guide

- This App uses `PHP 7` `Mysql 5.7` 
- Install latest version of Symfony using this [Guide] (https://symfony.com/doc/current/setup.html) 
Make sure Symfony web server is Installed.
- Get a clone of this Repo and run `git clone` with the repo URL
- Go to project directry 
  > cd bookstore
- Run `composer install`
- Create a database in mysql
- Edit `.env` and add database credentials
- Run `php bin/console doctrine:migrations:migrate`
- Run `php bin/console doctrine:fixtures:load`
- Start the server 
  > symfony server:start
