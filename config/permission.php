<?php
/**
 * @project blue-dashboard
 * @author  Im A Feature
 * @email   im.not.a.bug.173@gmail.com
 * @date    12/3/2023
 * @time    10:07 PM
 **/

/**
 * Permission configuration.
 *
 * [key]: page name (e.g: index, login, ...)
 * [role_ids]: Role ids can access [key] page.
 * [user_ids]: User ids can access [key] page.
 */
return [
    'create-website' => [
        'role_ids' => [1],
        'user_ids' => [],
    ],
];
