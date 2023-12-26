<?php
/**
 * @project blue-dashboard
 * @author  Im A Feature
 * @email   im.not.a.bug.173@gmail.com
 * @date    12/3/2023
 * @time    9:29 PM
 **/

namespace app\helpers;

/**
 * Password helper.
 */
class PasswordHelper
{

    /**
     * Hashing a password.
     *
     * @param  string  $password
     * @param  string  $salt
     *
     * @return string|null
     */
    public static function hash(string $password, string $salt = '$6$rounds=20000$codes$'): ?string
    {
        return crypt($password, $salt);
    }

    /**
     * Verify a password.
     *
     * @param  string  $password
     * @param  string  $hash
     *
     * @return bool
     */
    public static function verify(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }

    /**
     * Generates user-friendly random password.
     *
     * @param  int  $length
     *
     * @return string
     */
    public static function generateRandomPassword(int $length = 8): string
    {
        $sets     = [
            'abcdefghjkmnpqrstuvwxyz',
            'ABCDEFGHJKMNPQRSTUVWXYZ',
            '123456789',
        ];
        $all      = '';
        $password = '';
        foreach ($sets as $set) {
            $password .= $set[array_rand(str_split($set))];
            $all      .= $set;
        }
        $all      = str_split($all);
        $password .= str_repeat($all[array_rand($all)], $length - count($sets));

        return str_shuffle($password);
    }

    /**
     * Generate random key.
     *
     * @param  int  $length
     *
     * @return string
     */
    public static function generateRandomKey(int $length = 32): string
    {
        $characters       = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString     = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }
}
