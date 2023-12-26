<?php
/**
 * @project blue-dashboard
 * @author  Im A Feature
 * @email   im.not.a.bug.173@gmail.com
 * @date    12/3/2023
 * @time    9:24 PM
 **/

/**
 * Web parameters.
 */
return [
    'name'            => 'Blue Dashboard',
    'favicon'         => '/favicon.ico',
    'logo'            => '/assets/images/logo.png',
    'home_url'        => 'http://blue-dashboard.com',
    'smtp'            => [
        'smtp_server'       => '',
        'smtp_port'         => '',
        'smtp_username'     => '',
        'smtp_password'     => '',
        'smtp_sender_email' => '',
        'smtp_sender_name'  => '',
    ],
    'email_whitelist' => [
        '@gmail.com',
        '@hotmail.com',
        '@yahoo.com',
    ],
];
