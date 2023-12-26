<?php
/**
 * @project blue-dashboard
 * @author  Im A Feature
 * @email   im.not.a.bug.173@gmail.com
 * @date    12/3/2023
 * @time    9:18 PM
 **/

namespace app\classes;

use app\abstracts\Model;
use app\helpers\PasswordHelper;
use app\interfaces\IdentityInterface;
use JetBrains\PhpStorm\Pure;

/**
 * This is the model of the "user" table.
 */
class User extends Model implements IdentityInterface
{

    const STATUS_INACTIVE = 0;

    const STATUS_ACTIVE   = 1;

    const STATUS_BLOCKED  = 2;

    const STATUS          = [
        self::STATUS_INACTIVE => 'Inactive',
        self::STATUS_ACTIVE   => 'Active',
        self::STATUS_BLOCKED  => 'Blocked',
    ];

    public int         $id;
    public int         $role_id;
    public string      $email;
    public string      $username;
    public string      $password_hash;
    public string      $auth_key;
    public string|null $verification_token;
    public string|null $forgot_password_token;
    public string|null $registration_ip;
    public int         $status;
    public int|null    $confirmed_at;
    public int|null    $blocked_at;
    public int|null    $last_login_at;
    public int         $created_at;
    public int         $updated_at;

    /**
     * {@inheritDoc}
     */
    public function getTableName(): string
    {
        return 'user';
    }

    /**
     * {@inheritDoc}
     */
    public function validate(): bool
    {
        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function save(array $data): bool
    {
        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function update(array $data): bool
    {
        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function delete(int $id): bool
    {
        return true;
    }

    /**
     * {@inheritDoc}
     */
    #[Pure] public function generatePasswordHash(string $password): string
    {
        return PasswordHelper::hash($password);
    }

    /**
     * {@inheritDoc}
     */
    public function validatePassword(string $password, string $hash): bool
    {
        return PasswordHelper::verify($password, $hash);
    }
}
