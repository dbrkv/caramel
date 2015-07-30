<?php
/**
 * Created by PhpStorm.
 * User: Dmitry
 * Date: 14.07.2015
 * Time: 10:51
 */

class Profile extends \Smartcat\Caramel\Controllers\Caramel_Controller
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

    /**
     * Controller constructor
     */
    public function __construct()
    {
        parent::__construct();

        /**
         * Guarded controller
         */
        if (! $this->garde->check()) {

            redirect('/');
        }
    }

    /**
     * @return CI_Output
     */
    public function index()
    {
        $garde = $this->garde->get_garde();
        $user = $garde->getUser();

        return $this->template->render('profile', ['user' => $user->toArray()]);
    }
}