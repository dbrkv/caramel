<?php namespace Smartcat\Caramel\Caserne\Garde;

use Cartalyst\Sentry\Facades\CI\Sentry as SentryFacade;

/**
 * Class Garde
 * @package Smartcat\Garde\Sentry
 */
class Sentry extends AbstractGarde
{
    /**
     * Sentry gardians constructor
     */
    public function __construct()
    {
        parent::__construct();

        $this->garnison = SentryFacade::createSentry();
    }

    /**
     * Authenticate credentials
     *
     * @param   string  $email
     * @param   string  $password
     * @param   bool    $remember
     * @return  bool    mixed
     */
    public function authenticate($email, $password, $remember = FALSE)
    {
        try
        {
            // Login credentials
            $credentials = array(
                'email'    => $email,
                'password' => $password,
            );

            // Authenticate the user
            $user = $this->garnison->authenticate($credentials, $remember);

            return $user;
        }
        catch (\Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
            $this->set_error_message('Login field is required.');
            return FALSE;
        }
        catch (\Cartalyst\Sentry\Users\PasswordRequiredException $e)
        {
            $this->set_error_message('Password field is required.');
            return FALSE;
        }
        catch (\Cartalyst\Sentry\Users\WrongPasswordException $e)
        {
            $this->set_error_message('Wrong password, try again.');
            return FALSE;
        }
        catch (\Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            $this->set_error_message('User was not found.');
            return FALSE;
        }
        catch (\Cartalyst\Sentry\Users\UserNotActivatedException $e)
        {
            $this->set_error_message('User is not activated.');
            return 'User is not activated.';
        }

            // The following is only required if the throttling is enabled
        catch (\Cartalyst\Sentry\Throttling\UserSuspendedException $e)
        {
            $this->set_error_message('User is suspended.');
            return FALSE;
        }
        catch (\Cartalyst\Sentry\Throttling\UserBannedException $e)
        {
            $this->set_error_message('User is banned.');
            return FALSE;
        }
    }

    /**
     * Logout
     *
     * @return mixed
     */
    public function logout()
    {
        return $this->garnison->logout();
    }

    /**
     * Check auth status
     *
     * @return mixed
     */
    public function check()
    {
        return $this->garnison->check();
    }

    /**
     * Return
     * @return \Cartalyst\Sentry\Sentry
     */
    public function garnison()
    {
        return $this->garnison;
    }

}