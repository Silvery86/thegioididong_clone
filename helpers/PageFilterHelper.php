<?php
/**
 * @project blue-dashboard
 * @author  Im A Feature
 * @email   im.not.a.bug.173@gmail.com
 * @date    12/5/2023
 * @time    12:29 PM
 */

namespace app\helpers;

use app\classes\User;

class PageFilterHelper
{

    /**
     * Check the user has permission to access page or not.
     *
     * @param  User  $user
     * @param  array  $permission
     *
     * @return bool
     */
    public static function filter(User $user, array $permission): bool
    {
        if (in_array($user->role_id, $permission['role_ids'])) {
            return true;
        } else {
            if (in_array($user->id, $permission['user_ids'])) {
                return true;
            }

            return false;
        }
    }
}
