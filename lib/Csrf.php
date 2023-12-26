<?php
/**
 * @project blue-dashboard
 * @author  Im A Feature
 * @email   im.not.a.bug.173@gmail.com
 * @date    12/3/2023
 * @time    9:29 PM
 **/

namespace app\lib;

use JetBrains\PhpStorm\Pure;

/**
 * Class Csrf.
 * A simple CSRF class to protect forms against CSRF attacks.
 * This class uses PHP sessions for storage.
 */
class Csrf
{

    /**
     * @var string $namespace The namespace for the session variable and form inputs
     */
    private string $namespace;

    /**
     * Csrf constructor.
     * Initializes the session variable name, starts the session if not already so, and initializes the token.
     *
     * @param  string  $namespace
     */
    public function __construct(string $namespace = '_csrf')
    {
        $this->namespace = $namespace;
        if (session_id() === '') {
            session_start();
        }
        $this->setToken();
    }

    /**
     * Return the token from persistent storage.
     *
     * @return string
     */
    #[Pure] public function getToken(): string
    {
        return $this->readTokenFromStorage();
    }

    /**
     * Verify if supplied token matches the stored token.
     *
     * @param  string  $userToken
     *
     * @return boolean
     */
    #[Pure] public function isTokenValid(string $userToken): bool
    {
        return ($userToken === $this->readTokenFromStorage());
    }

    /**
     * Echoes the HTML input field with the token, and namespace as the name of the field.
     */
    public function echoInputField()
    {
        $token = $this->getToken();
        echo "<input type=\"hidden\" name=\"{$this->namespace}\" value=\"{$token}\" />";
    }

    /**
     * Verifies whether the post token was set, else dies with error.
     */
    public function verifyRequest()
    {
        if ( ! $this->isTokenValid($_POST[$this->namespace])) {
            die("CSRF validation failed.");
        }
    }

    /**
     * Generates a new token value and stores it in persistent storage, or else does nothing if one already exists in persistent storage.
     */
    private function setToken()
    {
        $storedToken = $this->readTokenFromStorage();
        if ($storedToken === '') {
            $token = md5(uniqid(rand(), true));
            $this->writeTokenToStorage($token);
        }
    }

    /**
     * Reads token from persistent storage.
     *
     * @return string
     */
    private function readTokenFromStorage(): string
    {
        return $_SESSION[$this->namespace] ?? '';
    }

    /**
     * Writes token to persistent storage.
     *
     * @param $token
     */
    private function writeTokenToStorage($token)
    {
        $_SESSION[$this->namespace] = $token;
    }
}
