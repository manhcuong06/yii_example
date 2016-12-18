Yii 2 Advanced Project Template
===============================

Yii 2 Advanced Project Template is a skeleton [Yii 2](http://www.yiiframework.com/) application best for
developing complex Web applications with multiple tiers.

The template includes three tiers: front end, back end, and console, each of which
is a separate Yii application.

The template is designed to work in a team development environment. It supports
deploying the application in different environments.

Full Yii 2 Documentation is at [The Definitive Guide to Yii 2.0 ¶](http://www.yiiframework.com/doc-2.0/guide-index.html).

[![Latest Stable Version](https://poser.pugx.org/yiisoft/yii2-app-advanced/v/stable.png)](https://packagist.org/packages/yiisoft/yii2-app-advanced)
[![Total Downloads](https://poser.pugx.org/yiisoft/yii2-app-advanced/downloads.png)](https://packagist.org/packages/yiisoft/yii2-app-advanced)
[![Build Status](https://travis-ci.org/yiisoft/yii2-app-advanced.svg?branch=master)](https://travis-ci.org/yiisoft/yii2-app-advanced)

DIRECTORY STRUCTURE
-------------------

```
common
    config/              contains shared configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
backend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains backend configurations
    controllers/         contains Web controller classes
    models/              contains backend-specific model classes
    runtime/             contains files generated during runtime
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
frontend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains frontend configurations
    controllers/         contains Web controller classes
    models/              contains frontend-specific model classes
    runtime/             contains files generated during runtime
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains frontend widgets
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
tests                    contains various tests for the advanced application
    codeception/         contains tests developed with Codeception PHP Testing Framework
```

PREPARATION BEFORE INSTALL
-------------------
[Download git-scm](https://git-scm.com/downloads)
```
Step 1: Install git-scm
    Download git
    Install git
    Usage: right click at a folder and select "Git Bash Here"
Step 2: Update latest version for composer
$   composer self-update
Step 3: Install asset plugin
$   composer global require "fxp/composer-asset-plugin:^1.2.0"
```

INSTALL PROJECT
-------------------

```
Step 1: Clone project
$   git clone https://github.com/manhcuong06/yii_example.git
$   cd yii_example/
Step 2: Install default pakages of Yii
$   composer install
Step 3: Update pakages, libraries (in composer.json)
$   composer update
```

CONFIGURATIONS
-------------------
[Refer an authclient example](http://www.yiiframework.com/doc-2.0/yii-authclient-clients-facebook.html)
```
Step 1: Config social login in "backend/config/main-local.php"
    'authClientCollection' => [
        'class' => 'yii\authclient\Collection',
        'clients' => [
        ],
    ],
Step 1.5: Add clients which you want to use
    'authClientCollection' => [
        'class' => 'yii\authclient\Collection',
        'clients' => [
            'google' => [
                'class' => 'yii\authclient\clients\Google',
                'clientId' => 'YOUR_GOOGLE_ID',
                'clientSecret' => 'YOUR_GOOGLE_SECRET',
            ],
            'facebook' => [
                'class' => 'yii\authclient\clients\Facebook',
                'clientId' => 'YOUR_FACEBOOK_ID',
                'clientSecret' => 'YOUR_FACEBOOK_SECRET',
            ],
            'twitter' => [
                'class' => 'yii\authclient\clients\Twitter',
                'attributeParams' => [
                    'include_email' => 'true'
                ],
                'consumerKey' => 'YOUR_TWITTER_KEY',
                'consumerSecret' => 'YOUR_TWITTER_SECRET',
            ],
            'github' => [
                'class' => 'yii\authclient\clients\GitHub',
                'clientId' => 'YOUR_GITHUB_ID',
                'clientSecret' => 'YOUR_GITHUB_SECRET',
            ],
            'linkedin' => [
                'class' => 'yii\authclient\clients\LinkedIn',
                'clientId' => 'YOUR_LINKEDIN_ID',
                'clientSecret' => 'YOUR_LINKEDIN_SECRET',
            ],
        ],
    ],
Step 2: Create a database (example: YOUR_DATABASE_NAME)
Step 3: Config mysql in "common/config/main-local.php"
    'dsn' => 'mysql:host=localhost;dbname=YOUR_DATABASE_NAME',
    'username' => 'YOUR_USERNAME',
    'password' => 'YOUR_PASSWORD',
Step 4: Run migration
$   ./yii migrate
    Now you can login backend with default account:
        Email: admin@gmail.com
        Password: qweqwe
```

CREATE VIRTUAL HOST (WINDOW)
-------------------

```
Step 1: Edit hosts at "C:\Windows\System32\drivers\etc\hosts"
    127.0.0.1       localhost
    127.0.0.1       YOUR_FRONTEND_DOMAIN (example: yii.front.cuong.dev)
    127.0.0.1       YOUR_BACKEND_DOMAIN (example: yii.back.cuong.dev)
Step 2: Edit httpd.conf at "C:\wamp\bin\apache\apache2.4.9\conf\httpd.conf", line 514
    From: #Include conf/extra/httpd-vhosts.conf
    To:    Include conf/extra/httpd-vhosts.conf
Step 3: Edit httpd-vhosts.conf at "C:\wamp\bin\apache\apache2.4.9\conf\extra\httpd-vhosts.conf", add these lines at the end of file
    <VirtualHost *:81>
        ServerName localhost
        DocumentRoot c:\wamp\www
        <Directory "c:\wamp\www/">
            AllowOverride All
        </Directory>
    </VirtualHost>

    <VirtualHost *:81>
        ServerName yii.front.cuong.dev
        DocumentRoot c:\wamp\www\yii_example\frontend\web
        <Directory "c:\wamp\www\yii_example\frontend\web/">
            AllowOverride All
        </Directory>
    </VirtualHost>

    <VirtualHost *:81>
        ServerName yii.back.cuong.dev
        DocumentRoot c:\wamp\www\yii_example\backend\web
        <Directory "c:\wamp\www\yii_example\backend\web/">
            AllowOverride All
        </Directory>
    </VirtualHost>
Step 4: Restart your server (WAMP)
```

THANK YOU
===============================

Don't be hesitate to contact me if you find a bug, or you want to get some helps.

[Facebook](https://www.facebook.com/el.nino.505960)<br>
[Google](https://plus.google.com/u/0/108898824663504067912)<br>
[Github](https://github.com/manhcuong06)