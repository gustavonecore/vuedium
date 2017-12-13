API for Vuedium application
=============================

Powered by Leftaro a PSR-7, PSR-11 and PSR-15 compliant micro framework for PHP 7.

Get ready
--------------

- `composer install`
- Copy the folder `config/base` into `config/local`
- Update the settings
- Run the local server for development with `php bin/server.php`

How to Propel-Model
--------------

- Update generated model classes from updated etc/schema.xml

`./propel build --schema-dir=etc --output-dir=src/App/Model --disable-namespace-auto-package --config-dir=config/local/`

- Update the schema.xml from the database

`./propel database:reverse --config-dir=config/local/ --namespace="Leftaro\App\Model" --output-dir=etc`

**Important**: After update the schema, you should remove the namespace related to the database, without this change the namespace of the new classes will be duplicated.

- Run migrations
  1) Update your database

  2) Execute the diff tool 
  
  `./propel diff --schema-dir=etc --config-dir=config/local/`

  This will generate a new migration php file inside of  `generated-migrations` folder.

  3) Run the migration `./propel --config-dir=config/local/ migrate`




