# Top PHP Repo's on Github
Utilizing Silex with Doctrine ORM, and boostrap to get most popular PHP Repos

## Getting Started
These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites
Composer (getcomposer.org)
PHP 5.5+
Mysql

#### Installing:
```bash
git clone https://github.com/fiifiappiah/populargithubphprepos.git
```

Run
```bash
composer.phar install to install dependencies
```

Set your Github keys or preferred authentication method
$app->register(new GuzzleProvider(), array(
    'guzzle.request_options' =>
        ['auth' => ['xxx', 'xxxx']]
));
```

Set your database information in config/param.yml:
```

Create database, then generate tables with Doctrine CLI tool
```bash
php bin/console orm:schema-tool:update --force
```

See Doctrine docs for additional documentation

Application Routes
```bash
/
/update
/show/{id}
```
