<?php
/**
 * @project blue-dashboard
 * @author  Im A Feature
 * @email   im.not.a.bug.173@gmail.com
 * @date    12/3/2023
 * @time    9:12 PM
 **/

namespace app\functions;

use app\classes\User;
use app\lib\App;
use app\lib\Database;
use app\middlewares\Authentication;
use JetBrains\PhpStorm\NoReturn;

/**
 * Class Auth.
 * This class handle the authentication of a user.
 */
class Auth extends Authentication
{

    /**
     * @var User $_user The instance of the "User" model
     */
    public User $_user;
    /**
     * @var App $app The instance of the "App" class
     */
    public App $app;
    /**
     * @var string $username Username
     */
    public string $username;
    /**
     * @var string $password Password
     */
    public string $password;
    /**
     * @var bool $rememberMe Remember me
     */
    public bool $rememberMe = false;

    /**
     * Login constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->app   = new App();
        $this->_user = new User();
        $this->getPostData();
    }

    /**
     * Login a user.
     */
    public function login()
    {
        if ($this->user) {
            $this->app->goHome();
        }
        if (isset($_COOKIE['identity'])) {
            $user = User::findOne(['auth_key' => $_COOKIE['identity']]);
            if ($user) {
                $this->performLogin($user);
            }
        }
        if ( ! empty($this->username) && ! empty($this->password)) {
            if ($this->validateLogin()) {
                $user = User::findOne(['username' => $this->username]);
                if ($user) {
                    $this->performLogin($user, $this->rememberMe);
                }
            }
        }
    }

    /**
     * Logout a user.
     */
    public function logout()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (isset($_GET['action']) && $_GET['action'] == 'logout') {
                $this->session->destroy();
                $this->app->redirect('/login');
            }
        }
    }

    /**
     * Perform the login request.
     *
     * @param  User  $user
     * @param  bool  $rememberMe
     */
    #[NoReturn] private function performLogin(User $user, bool $rememberMe = false)
    {
        if ($rememberMe == true) {
            setcookie('identity', $user->auth_key, strtotime('+7 days'));
        }
        $this->session->set('identity', $user->id);
        $db        = new Database();
        $statement = $db->prepare(
            'UPDATE '.$this->_user->getTableName().' SET last_login_at='.time().', updated_at='.time(
            ).' WHERE id='.$user->id
        );
        $statement->execute();
        $this->app->goHome();
    }

    /**
     * Login validation.
     *
     * @return bool
     */
    private function validateLogin(): bool
    {
        $user = User::findOne(['username' => $this->username]);
        if ( ! $user || ! $this->_user->validatePassword(
                $this->password,
                $user->password_hash
            ) || $user->status != User::STATUS_ACTIVE) {
            $this->session->setFlash('danger', 'Sai username hoặc password.');

            return false;
        }

        return true;
    }

    /**
     * Get login data.
     */
    private function getPostData()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ( ! empty($_POST['username']) && ! empty($_POST['password'])) {
                $this->username = $this->app->xss->xss_clean($_POST['username']);
                $this->password = $this->app->xss->xss_clean($_POST['password']);
            }
            if ( ! empty($_POST['rememberMe'])) {
                $this->rememberMe = $_POST['rememberMe'];
            }
            $this->app->csrf->verifyRequest();
        }
    }
}
