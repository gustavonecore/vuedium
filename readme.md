API for Vuedium application
=============================

Powered by Leftaro a PSR-7, PSR-11 and PSR-15 compliant micro framework for PHP 7.

Get ready
--------------

- `composer install`
- Copy the folder `config/base` into `config/local`
- Update the settings
- Run the local server for development with `php bin/server.php`

Propel ORM integration
--------------

###Generate models from existing database

1. Update the schema.xml from the database using the reverse command

`./propel database:reverse --config-dir=config/local/ --namespace="Leftaro\App\Model" --output-dir=etc`

2. **Important** Remove from the schema.xml the namespace generated to the database root tag. This avoid the double namespace for the generated ORM classes.

3. Update generated model classes from updated etc/schema.xml

`./propel build --schema-dir=etc --output-dir=src/App/Model --disable-namespace-auto-package --config-dir=config/local/`

###Migrations

1. Update your database

2. Execute the diff tool

  `./propel diff --schema-dir=etc --config-dir=config/local/`

  This will generate a new migration php file inside of  `generated-migrations` folder.

3. Run the migration `./propel --config-dir=config/local/ migrate`

###Docs





