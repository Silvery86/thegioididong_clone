<?php
/**
 * @project blue-dashboard
 * @author  Im A Feature
 * @email   im.not.a.bug.173@gmail.com
 * @date    12/3/2023
 * @time    9:17 PM
 **/

namespace app\abstracts;

use app\lib\Database;

/**
 * Abstract class Model.
 * This abstract contains all default methods for the model.
 * Any model class must extend this class.
 */
abstract class Model
{

    /**
     * @var Database $db The instance of the "Database" class
     */
    public Database $db;

    /**
     * ModelAbstract constructor.
     */
    public function __construct()
    {
        $this->db = new Database();
    }

    /**
     * Get table name.
     *
     * @return string
     */
    abstract public function getTableName(): string;

    /**
     * Model validation.
     *
     * @return bool
     */
    abstract public function validate(): bool;

    /**
     * Save data to the database.
     *
     * @param  array  $data
     *
     * @return bool
     */
    abstract public function save(array $data): bool;

    /**
     * Update an existed record in the database.
     *
     * @param  array  $data
     *
     * @return bool
     */
    abstract public function update(array $data): bool;

    /**
     * Delete an existed record in the database.
     *
     * @param  int  $id
     *
     * @return bool
     */
    abstract public function delete(int $id): bool;

    /**
     * Find one record by given conditions in the database.
     *
     * @param  array  $conditions
     *
     * @return false|mixed|object
     */
    public static function findOne(array $conditions): mixed
    {
        $model      = new static();
        $attributes = array_keys($conditions);
        $query      = implode("AND", array_map(fn($attr) => "$attr = :$attr", $attributes));
        $statement  = $model->db->prepare('SELECT * FROM '.$model->getTableName().' WHERE '.$query.' LIMIT 1');
        foreach ($conditions as $key => $item) {
            $statement->bindValue(":$key", $item);
        }
        $statement->execute();

        return $statement->fetchObject(static::class);
    }

    /**
     * Find all records by given conditions in the database.
     *
     * @param  array  $conditions
     *
     * @return array|false
     */
    public static function findAll(array $conditions = []): bool|array
    {
        $model      = new static();
        $attributes = array_keys($conditions);
        $query      = implode("AND", array_map(fn($attr) => "$attr = :$attr", $attributes));
        if ($conditions) {
            $statement = $model->db->prepare('SELECT * FROM '.$model->getTableName().' WHERE '.$query);
            foreach ($conditions as $key => $item) {
                $statement->bindValue(":$key", $item);
            }
        } else {
            $statement = $model->db->prepare('SELECT * FROM '.$model->getTableName());
        }
        $statement->execute();

        return $statement->fetchAll();
    }
}
