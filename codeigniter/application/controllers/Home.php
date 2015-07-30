<?php

use Smartcat\Caramel\Controllers\Caramel_Controller;

/**
 * Class Home
 */
class Home extends Caramel_Controller
{
    /**
     * Use template
     * @var bool
     */
    protected $themed = true;

    /**
     * Use garde
     * @var bool
     */
    protected $garded = true;

    public function index()
    {
        $time = \Carbon\Carbon::now();

        return $this->template->render('home', ['time' => $time]);//->cache(2);
    }
}