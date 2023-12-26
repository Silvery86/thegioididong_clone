<?php
/**
 * @project blue-dashboard
 * @author  Im A Feature
 * @email   im.not.a.bug.173@gmail.com
 * @date    12/3/2023
 * @time    9:30 PM
 **/

namespace app\lib;

use PDO;
use PDOException;
use PDOStatement;

/**
 * Class Database.
 * This class handles connecting to the database and performs any methods that affect the database.
 */
class Database
{

    /**
     * @var PDO $pdo PDO instance
     */
    public PDO $pdo;
    /**
     * @var bool $debug Debug mode
     */
    protected bool $debug = true;
    /**
     * @var int $transactionCount Transaction count
     */
    protected int $transactionCount = 0;

    /**
     * Database constructor.
     */
    public function __construct()
    {
        $config = include __DIR__.'/../config/db.php';
        $this->connect($config);
    }

    /**
     * Prepares a statement for execution and returns a statement object.
     *
     * @param  string  $query
     *
     * @return PDOStatement
     */
    public function prepare(string $query): PDOStatement
    {
        return $this->pdo->prepare($query);
    }

    /**
     * Return a database error if debug mode is turned on.
     * Either, throw a PDO exception if debug mode is off.
     *
     * @throw PDOException
     */
    public function getError()
    {
        $error = $this->pdo->errorInfo()[2];
        if ($this->debug === true) {
            if (php_sapi_name() === 'cli') {
                die("Error: ".$error.PHP_EOL);
            }
            $msg = '<h1>Database Error</h1>';
            $msg .= '<h4>Error: <em style="font-weight:normal;">'.$error.'</em></h4>';
            die($msg);
        }
        throw new PDOException($error);
    }

    /**
     * Create PDO transaction.
     *
     * @return bool
     */
    public function beginTransaction(): bool
    {
        if ( ! $this->transactionCount++) {
            return $this->pdo->beginTransaction();
        }
        $this->pdo->exec('SAVEPOINT trans'.$this->transactionCount);

        return $this->transactionCount >= 0;
    }

    /**
     * Commits a transaction.
     *
     * @return bool
     */
    public function commit(): bool
    {
        if ( ! --$this->transactionCount) {
            return $this->pdo->commit();
        }

        return $this->transactionCount >= 0;
    }

    /**
     * Rolls back a transaction.
     *
     * @return bool
     */
    public function rollBack(): bool
    {
        if (--$this->transactionCount) {
            $this->pdo->exec('ROLLBACK TO trans'.($this->transactionCount + 1));

            return true;
        }

        return $this->pdo->rollBack();
    }

    /**
     * Connect to the database.
     *
     * @param  array  $config
     */
    private function connect(array $config)
    {
        $driver    = $config['driver'] ?? 'mysql';
        $host      = $config['host'] ?? 'localhost';
        $charset   = $config['charset'] ?? 'utf8';
        $collation = $config['collation'] ?? 'utf8mb4_unicode_ci';
        $port      = $config['port'] ?? 3306;
        if (in_array($driver, [
            '',
            'mysql',
            'pgsql',
        ])) {
            $dsn = $driver.':host='.str_replace(
                    ':'.$port,
                    '',
                    $host
                ).';'.($port !== '' ? 'port='.$port.';' : '').'dbname='.$config['database'];
        } elseif ($driver === 'sqlite') {
            $dsn = 'sqlite:'.$config['database'];
        } else {
            $dsn = '';
        }
        try {
            $this->pdo = new PDO($dsn, $config['username'], $config['password'], $config['options'] ?? null);
            $this->pdo->exec("SET NAMES '".$charset."' COLLATE '".$collation."'");
            $this->pdo->exec("SET CHARACTER SET '".$charset."'");
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die('Cannot the connect to Database with PDO. '.$e->getMessage());
        }
    }
}
