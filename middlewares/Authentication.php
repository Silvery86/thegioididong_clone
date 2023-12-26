<?php
/**
 * @project blue-dashboard
 * @author  Im A Feature
 * @email   im.not.a.bug.173@gmail.com
 * @date    12/3/2023
 * @time    9:30 PM
 **/

namespace app\middlewares;

use app\classes\User;
use app\lib\Session;
use JetBrains\PhpStorm\Pure;

/**
 * Class Authentication.
 * This middleware handles the authentications.
 */
class Authentication
{

    /**
     * @var Session $session Instance of the "Session" class
     */
    public Session $session;
    /**
     * @var User|null $user The instance of the "User" class
     */
    public ?User $user = null;

    /**
     * Auth constructor.
     */
    public function __construct()
    {
        $this->session = new Session();
        if ($this->hasAuth()) {
            $this->user = User::findOne(['id' => $this->getIdentity()]);
        }
    }

    /**
     * Get "identity" session.
     *
     * @return false|mixed
     */
    #[Pure] public function getIdentity(): mixed
    {
        return $this->session->get('identity');
    }

    /**
     * Get "identity" session.
     * Return false if this session not existed.
     *
     * @return bool
     */
    #[Pure] public function hasAuth(): bool
    {
        if ($this->getIdentity() === false) {
            return false;
        }

        return true;
    }

    /**
     * Get role of a user.
     *
     * @return int|null
     */
    public function getRole(): ?int
    {
        return $this->user?->role;
    }
}
