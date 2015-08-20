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

# Usage

## Controller

Caramel shipped with abstract Caramel_Controller. Caramel controller can use templates and auth library.

To enable templating for controller you need setup ```protected $templated``` to ```true```. 
For auth acccess to controller, just change ```protected $guarded``` to ```true``` also.

```php
use Smartcat\Caramel\Controllers\Caramel_Controller;

    /**
     * Use template
     * @var bool
     */
    protected $templated = true;

    /**
     * Use garde
     * @var bool
     */
    protected $guarded = true;

    /**
     * Controller constructor
     */
    public function __construct()
    {
        parent::__construct();

        /**
         * Check auth
         */
        if (! $this->garde->check()) {
            $this->template->set_flash('Auth consroller');
            redirect('/');
        }
    }

    /**
     * Index controller method
     *
     * @return CI_Output
     */
    public function index()
    {
        return $this->template->render('app');
    }

```

You can also use only garde or template independently.
