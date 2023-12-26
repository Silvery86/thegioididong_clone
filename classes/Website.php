<?php
/**
 * @project blue-dashboard
 * @author  Im A Feature
 * @email   im.not.a.bug.173@gmail.com
 * @date    12/5/2023
 * @time    12:10 PM
 */

namespace app\classes;

use app\abstracts\Model;
use Exception;

/**
 * This is the model of the "website" table.
 */
class Website extends Model
{

    public int    $id;
    public string $tmp_domain;
    public string $domain;
    public int    $created_at;
    public int    $updated_at;

    /**
     * {@inheritDoc}
     */
    public function getTableName(): string
    {
        return 'website';
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
        $keys = '';
        foreach (array_keys($data) as $key) {
            $keys .= '`'.$key.'`,';
        }
        $values = '';
        foreach ($data as $value) {
            $values .= "'".$value."',";
        }
        $this->db->beginTransaction();
        try {
            $statement = $this->db->prepare(
                'INSERT INTO `'.$this->getTableName().'` ('.rtrim($keys, ',').') VALUES ('.rtrim($values, ',').');'
            );
            $statement->execute();
            $this->db->commit();
        } catch (Exception $e) {
            $this->db->rollBack();

            return false;
        }

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
