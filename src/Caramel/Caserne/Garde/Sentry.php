<?php namespace Smartcat\Caramel\Caserne\Garde;

use Cartalyst\Sentry\Cookies\CICookie;
use Cartalyst\Sentry\Hashing\NativeHasher;
use Cartalyst\Sentry\Sessions\CISession;
use Smartcat\Caramel\Caserne\Sentry\CaramelFacade as SentryFacade;
use Cartalyst\Sentry\Sentry as BaseSentry;
use Cartalyst\Sentry\Throttling\Eloquent\Provider as ThrottleProvider;
use Cartalyst\Sentry\Users\Eloquent\Provider as UserProvider;
use Cartalyst\Sentry\Groups\Eloquent\Provider as GroupProvider;

/**
 * Class Garde
 * @package Smartcat\Garde\Sentry
 */
class Sentry extends AbstractGarde
{
    /**
     * Sentry garde constructor
     */
    public function __construct()
    {
        parent::__construct();

        $sentry_config = config_item('sentry');

        $user_model = $sentry_config['model'];

        $user_provider = $this->makeUserProvider($user_model);
        $ip_address = $this->ci->input->ip_address();
        $group_provider = new GroupProvider;
        $throttle_provider = new ThrottleProvider($user_provider);
        $ci_session = new CISession($this->ci->session);
        $ci_cookie = new CICookie($this->ci->input);

        $sentry = new BaseSentry(
            $user_provider,
            $group_provider,
            $throttle_provider,
            $ci_session,
            $ci_cookie,
            $ip_address
        );

        $this->garnison = $sentry;
    }

    /**
     * Make user provider
     *
     * @param  string $user_model
     * @return UserProvider
     *
     */
    private function makeUserProvider($user_model)
    {
        if (class_exists($user_model)) {
            return new UserProvider(new NativeHasher(), $user_model);
        }

        return new UserProvider(new NativeHasher());
    }

    /**
     * Authenticate credentials
     *
     * @param   string  $login
     * @param   string  $password
     * @param   bool    $remember
     * @return  bool    mixed
     */
    public function authenticate($login, $password, $remember = false)
    {
        try
        {

            $login_name = $this->garnison->getEmptyUser()->getLoginName();

            // Login credentials
            $credentials = array(
                $login_name => $login,
                'password'  => $password,
            );

            // Authenticate the user
            $user = $this->garnison->authenticate($credentials, $remember);

            return $user;
        }
        catch (\Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
            $this->set_error_message('Login field is required.');
            return false;
        }
        catch (\Cartalyst\Sentry\Users\PasswordRequiredException $e)
        {
            $this->set_error_message('Password field is required.');
            return false;
        }
        catch (\Cartalyst\Sentry\Users\WrongPasswordException $e)
        {
            $this->set_error_message('Wrong password, try again.');
            return false;
        }
        catch (\Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            $this->set_error_message('User was not found.');
            return false;
        }
        catch (\Cartalyst\Sentry\Users\UserNotActivatedException $e)
        {
            $this->set_error_message('User is not activated.');
            return false;
        }

            // The following is only required if the throttling is enabled
        catch (\Cartalyst\Sentry\Throttling\UserSuspendedException $e)
        {
            $this->set_error_message('User is suspended.');
            return false;
        }
        catch (\Cartalyst\Sentry\Throttling\UserBannedException $e)
        {
            $this->set_error_message('User is banned.');
            return false;
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

    /**
     * Get current user
     * @return \Cartalyst\Sentry\Users\UserInterface
     */
    public function get_user()
    {
        return $this->garnison->getUser();
    }

}