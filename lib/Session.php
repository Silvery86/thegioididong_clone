<?php
/**
 * @project blue-dashboard
 * @author  Im A Feature
 * @email   im.not.a.bug.173@gmail.com
 * @date    12/3/2023
 * @time    9:30 PM
 **/

namespace app\lib;

/**
 * Class Session.
 * This class performs any methods that affect the session.
 */
class Session
{

    /**
     * Session constructor.
     */
    public function __construct()
    {
        if (php_sapi_name() === 'cli') {
            session_start();
        } else {
            if (session_status() !== PHP_SESSION_ACTIVE) {
                session_start();
            }
        }
    }

    /**
     * Init a session.
     *
     * @param  string  $key
     * @param  mixed  $value
     */
    public function set(string $key, mixed $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Get a session.
     *
     * @param  string  $key
     *
     * @return false|mixed
     */
    public function get(string $key)
    {
        return $_SESSION[$key] ?? false;
    }

    /**
     * Remove a session.
     */
    public function remove(string $key)
    {
        unset($_SESSION[$key]);
    }

    /**
     * Destroy session.
     */
    public function destroy()
    {
        session_destroy();
    }

    /**
     * Generate a simple flash message.
     *
     * @param  string  $key
     * @param  string  $message
     */
    public function setFlash(string $key, string $message)
    {
        $this->set('flash_message', [
            'key'     => $key,
            'message' => $message,
        ]);
    }

    /**
     * Get a flash message if it has existed.
     *
     * @return mixed|null
     */
    public static function getFlash(): mixed
    {
        return $_SESSION['flash_message'] ?? null;
    }
}
