# Symfony Profile Settings Example

This is a simple example Symfony 5 application that demonstrates how to implement profile settings for your users. Users can update their email address and password from their account settings page.

Requirements

    PHP 8.2 or later
    Composer
    MySQL or MariaDB

Installation

    git clone https://github.com/heytomy/pannel-symfony.git.
    
    composer install
    
    edit .env with your db user and passowrd !!
    
    php bin/console doctrine:database:create.
    
    php bin/console doctrine:migrations:migrate.
    
    php bin/console doctrine:fixtures:load.
    
    php bin/console server:start.
    
    Visit the website at http://localhost:8000.

Contributing

If you have any issues or suggestions for this project, please feel free to open an issue or pull request on the repository.
License

This project is open source software licensed under the MIT license.
