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

//Schema definition

CREATE TABLE IF NOT EXISTS `customers` (
  `id` mediumint(11) NOT NULL AUTO_INCREMENT,
  `encrypted_id` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=63 ;


CREATE TABLE IF NOT EXISTS `customer_certificate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `private_key` text,
  `body` text NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;





