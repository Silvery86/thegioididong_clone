<?php
/**
 * @project blue-dashboard
 * @author  Im A Feature
 * @email   im.not.a.bug.173@gmail.com
 * @date    12/3/2023
 * @time    9:59 PM
 **/

namespace app\classes;

use app\abstracts\Model;

/**
 * This is the model of the "role" table.
 */
class Role extends Model
{

    public int    $id;
    public string $name;
    public string $description;

    /**
     * {@inheritDoc}
     */
    public function getTableName(): string
    {
        return 'role';
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
}
