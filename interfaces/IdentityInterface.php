<?php
/**
 * @project blue-dashboard
 * @author  Im A Feature
 * @email   im.not.a.bug.173@gmail.com
 * @date    12/3/2023
 * @time    9:22 PM
 **/

namespace app\interfaces;

/**
 * Interface Identity.
 * This interface contains all default methods for identity.
 */
interface IdentityInterface
{

    /**
     * Generate a hashed password.
     *
     * @param  string  $password
     *
     * @return string
     */
    public function generatePasswordHash(string $password): string;

    /**
     * Validate a hashed password.
     *
     * @param  string  $password
     * @param  string  $hash
     *
     * @return bool
     */
    public function validatePassword(string $password, string $hash): bool;
}
