<?php
/**
 * @project blue-dashboard
 * @author  Im A Feature
 * @email   im.not.a.bug.173@gmail.com
 * @date    12/4/2023
 * @time    10:25 PM
 **/

namespace app\traits;

use app\classes\User;

/**
 * Trait RoleFilter.
 *
 * This trait used to perform filter access by role.
 */
trait RoleFilterTrait
{

    /**
     * Check the user has permission to access page or not.
     *
     * @param  User  $user
     * @param  array  $permission
     *
     * @return bool
     */
    public function hasPermission(User $user, array $permission): bool
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
