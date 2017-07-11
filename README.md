Utilizing Silex with Doctrine ORM, and boostrap to get most popular PHP Repos

Install:
```bash
cd /path/to/your_project
git clone https://github.com/fiifiappiah/populargithubphprepos.git
```

Run
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
```bash
