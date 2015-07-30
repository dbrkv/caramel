<?php

use Smartcat\Caramel\Controllers\Caramel_Controller;

/**
 * Class Auth
 */
class Auth extends Caramel_Controller
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
     * Show login form
     *
     * @return CI_Output
     */
    public function index()
    {
        return $this->template->render('login');
    }

    /**
     * Login action
     */
    public function login_action()
    {
        $login = $this->input->post('login');
        $password = $this->input->post('password');

        /**
         * Auth failed
         */
        if( ! $this->garde->authenticate($login, $password)) {

            $error_message = $this->garde->last_error();
            $this->template->set_flash($error_message, 'danger');

            redirect('login');
        }

        /**
         * We pass face control!
         */
        redirect('/');
    }

    /**
     * Logout user
     */
    public function logout()
    {
        $action = $this->input->post('action');

        if ($action === 'logout') {
            $this->garde->logout();
            redirect('/');
        }

        $url = $this->input->get_request_header('Referer');
        redirect($url);
    }

    /**
     * Show registration form
     *
     * @return CI_Output
     */
    public function get_register()
    {
        return $this->template->render('register');

    }


    /**
     * Register user by credentials
     */
    public function post_register()
    {
        $this->load->library('form_validation');

        /**
         * Registration validation rules
         */
        $rules = [
            [
                'field'     => 'login',
                'rules'     => 'trim|required|valid_email',
            ],
            [
                'field' => 'password',
                'rules' => 'trim|required',
                'label' => 'Password'
            ],
            [
                'field'     => 'confirm',
                'rules'     => 'trim|required|matches[password]',
                'label'     => 'Password confirmation',
                'errors'    => [
                    'matches' => 'Password not match'
                ]
            ]
        ];

        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() === FALSE) {
            $error = $this->form_validation->error_array();
            $this->template->set_flash($error, 'warning');
            $this->template->render('register');
        }


        $email = $this->input->post('login');
        $password = $this->input->post('password');


        try
        {
            // Let's register a user.
            $user = $this->garde->get_garde()->register([
                    'email'     => $email,
                    'password'  => $password
        ]);

            // Let's get the activation code
            $activationCode = $user->getActivationCode();
            $this->template->set_flash($activationCode, 'success');
            // Send activation code to the user so he can activate the account
        }
        catch (Cartalyst\Sentry\Users\UserExistsException $e)
        {
            $this->template->set_flash('User with this login already exists.', 'warning');
            redirect('/register');
        }

        redirect('/login');
    }
}