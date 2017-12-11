API for Vuedium application
=============================

Powered by Leftaro a PSR-7, PSR-11 and PSR-15 compliant micro framework for PHP 7.

Get ready
--------------

- `composer install`
- Copy the folder `config/base` into `config/local`
- Update the settings
- Run the local server for development with `php bin/server.php`

How to Propel-ORM
--------------

- Update generated model classes from updated etc/schema.xml

`./propel build --schema-dir=etc --output-dir=src/App/Orm --disable-namespace-auto-package --config-dir=config/local/`

- Update the schema.xml from the database
`./propel database:reverse --config-dir=config/local/ --namespace="Leftaro\App\Orm"`
This will create a new file inside the `generated-reversed-database`
Then move the created file inside etc/ and replace the existing one, then you are ready to update all your generated classes.

- Run migrations
  1) Update your database
  2) Execute the diff tool `./propel diff --schema-dir=etc --config-dir=config/local/`
  This will generate a new migration php file inside of `generated-migrations` folder.
  3) Run the migration `./propel --config-dir=config/local/ migrate`




