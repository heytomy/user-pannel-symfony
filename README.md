# Symfony Profile Settings Example

This is a simple example Symfony 5 application that demonstrates how to implement profile settings for your users. Users can update their email address and password from their account settings page.
Requirements

    PHP 7.4 or later
    Composer
    MySQL or MariaDB

Installation

    Clone the repository: git clone https://github.com/heytomy/pannel-symfony.git.
    
    Install dependencies: composer install.
    
    Create the database: php bin/console doctrine:database:create.
    
    Run the database migrations: php bin/console doctrine:migrations:migrate.
    
    Load some dummy data (optional): php bin/console doctrine:fixtures:load.
    
    Start the Symfony web server: php bin/console server:run.
    
    Visit the website at http://localhost:8000.

Usage

To use the profile settings feature, you'll need to create an account first.

Once you've created an account and logged in, you can update your profile settings by clicking the "Settings" link in the navigation bar. Here you can change your email address and password.
Contributing

If you have any issues or suggestions for this project, please feel free to open an issue or pull request on the repository.
License

This project is open source software licensed under the MIT license.
