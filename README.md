<h1 align="center">A Simple Login System</h1>
<p>A login system boilerplate</p>

## What is this for
Login systems take some time to set up. This repo can be a good start when building a project that requires a login system.

## Set Up
1. Run the /createtables.sql contents in your database. This will create the database and the needed table.
2. Make sure the configurations are correct on the /db.php file for your database connection.
3. Visit the /register.php page and make an account. 
4. If you are redirected back to the index page and the page welcomes you with your fullname and username, all is working as it should. 

## What you should know
1. The database connection for all the quieries lives in the 'includes/functions.php' file.
2. A PDO instance is being utilized for the database connection. See manual for further instruction [here](http://php.net/manual/en/book.pdo.php).
2. When a new user has been made, they are redirected to the login page instead of being logged in right away.
3. The 'TITLE' constent is for the page title that will be set on the header of every page. Make sure the 'TITLE' constant is defined before the included header.php file.
4. This boilerplate has minimal security. Prepared statements are used for the login and registration systems and that's about it. Be sure to ramp up your security when using this as a starting point. 

## Adding Pages That Need Authorization
When adding pages that should be hidden from none users, be sure to do the following:
1. At the top of the page, add the following code
```php
session_start();
include 'includes/functions.php';
checkSession();
```
2. Include the header.php file that has meta tags for no-index and no-follow.
3. Edit the robots.txt file to disallow robots to index any pages of your choice on your site. See more on this [here](http://www.robotstxt.org/robotstxt.html).

That should be it! Enjoy :)