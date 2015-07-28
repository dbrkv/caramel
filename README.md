# Caramel

Caramel is codeigniter package. Delight for your web application.

Caramel mixed with [Illuminate Database](https://github.com/illuminate/database) 
library, [Twig](http://twig.sensiolabs.org/) template engine and 
[Sentry](https://cartalyst.com/manual/sentry) authorization and authentication package

## Install

Install Codeigniter framework firstly. You can just simply download .zip package from 
Codeigniter [website](http://www.codeigniter.com/) or via composer:

```bash
composer create-project bcit-ci/CodeIgniter
```

Once Codeigniter installed,

in ```application/config/config.php``` set Composer autoloader path:

```php
$config['composer_autoload'] = FCPATH . 'vendor/autoload.php';
```

In composer.json file and add psr-4 autoload for models:
 
 ```
   "autoload": {
     "psr-4": {
       "App\\Models\\": "application/models/"
     }
   },
 ```

then run ```composer require``` command:

```bash
composer require namesmile/caramel
```