The demo for this project is available at this URL dev.balniketansangh.org

1. This project needs to be run on a web server like apache or nginx with PHP support and version>=5.6. 
Please put all these source files in the htdocs folder on apache and configure your routes appropriately in the httpd-vosts.conf file.
2. To install all the dependencies please run composer install. Composer is a dependency management tool available on all platforms
3. Tests for this project are defined in the /tests directory. To run all the tests in the suite use the following command:
./vendor/bin/phpunit

4. REST API Endpoints: Here are the API endpoints for this project

GET ->/v1/users or /v1/users/{id}

POST -> /v1/users

DELETE -> /v1/users/{id}

To test the rest endpoints you can use POSTMAN or a restclient and type the following:

GET http://somedomain.com/v1/users

5. Please specify your database connection settings in the config.php file.



