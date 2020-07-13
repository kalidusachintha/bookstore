# Book Store
## System Requirement 

- PHP 7
- Mysql 5.7 
- Ubuntu 16.04

## Installtion Guide

- This App uses `PHP 7` `Mysql 5.7` 
- Install latest version of Symfony using this [Guide](https://symfony.com/doc/current/setup.html).
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
- Go to `http://127.0.0.1:8000/main`
 
 ## Assummptions

  1.If you buy 5 or more Children books you get a 10% discount from the Children books total
   Assume this applies only for Children and category name will not be changed.
   
  2.If you buy 10 books from each category you get 5% additional discount from the totalbill
   Assume this applies to all the categories not just for 1 category with 10 books
   
  3.Coupon code needs to be applied every time when user updated the card.use (code_15);
  4.This is open site not user logins are required.
  
