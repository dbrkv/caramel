<?php namespace Smartcat\Caramel\Caserne\Garde;

/**
 * Class AbstractGarde
 * @package Smartcat\Caramel\Caserne\Garde
 */
abstract class AbstractGarde {

    /**
     * CI Singleton
     * @var object
     */
    protected $ci;

    /**
     * Our brave gardians
     * @var object
     */
    protected $garnison;

    /**
     * Error message
     * @var string
     */
    protected $error_message;

    /**
     * Garde class constructor
     */
    public function __construct()
    {
        $this->ci =& get_instance();
    }

    /**
     * Authenticate credentials
     *
     * @param   string  $email
     * @param   string  $password
     * @param   bool    $remember
     * @return  bool    mixed
     */
    abstract public function authenticate($email, $password, $remember = FALSE);

    /**
     * Logout
     *
     * @return mixed
     */
    abstract public function logout();

    /**
     * Check authentication
     *
     * @return mixed
     */
    abstract public function check();

    /**
     * Get gardians
     *
     * @return object
     */
    public function get_garde()
    {
        return $this->garnison;
    }

    /**
     * Get last error message
     *
     * @return string
     */
    public function last_error()
    {
        return $this->error_message;
    }

    /**
     * Set error message
     *
     * @param string $message
     */
    protected function set_error_message($message)
    {
        $this->error_message = $message;
    }
}