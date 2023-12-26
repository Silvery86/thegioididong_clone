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
 * Class Cookie.
 *
 * Handle web cookie.
 */
class Cookie
{

    /**
     * Set cookie.
     *
     * @param  string  $name
     * @param  string  $value
     * @param  int  $time
     */
    public function setCookie(string $name, string $value, int $time = 86400)
    {
        if (empty($this->getCookie($name))) {
            setcookie($name, $value, time() + $time);
        }
    }

    /**
     * Get cookie by given name.
     *
     * @param  string  $name
     *
     * @return mixed
     */
    public function getCookie(string $name): mixed
    {
        return $_COOKIE[$name];
    }
}
