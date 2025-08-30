<?php declare(strict_types=1);

namespace App\Database;

require_once __DIR__ . '/../utils.php';

use PDO;
use PDOStatement;

class Database {
  private static self $instance;
  private static PDO $pdo;

  /**
   * !Singletons should not be cloned nor instantiated by client!
   * Initializes the PDO connection.
   */
  private function __construct() {
    $dsn = 'mysql:';

    $dsn .=
      http_build_query(
        data: [
          "host"     => '127.0.0.1',
          "user"     => 'root',
          "password" => '',
          "dbname"   => 'student_db',
        ],
        arg_separator: ';'
      ); // creates the following string: host=hostname;user=username ....

    $this->pdo($dsn);
  }

  /**
   * Returns the singleton instance of the Database class.
   *
   * @return self The singleton instance.
   */
  public static function getInstance(): self {
    if (!isset(static::$instance)) {
      static::$instance = new static();
    }

    return static::$instance;
  }

  /**
   * Initializes and returns the PDO instance.
   *
   * @param string $dsn The Data Source Name (DSN) for the PDO connection.
   * @return PDO The PDO instance.
   */
  private static function pdo(string $dsn): PDO {
    if (!isset(static::$pdo)) {
      static::$pdo = new PDO(
        $dsn,
        options: [
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
          PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_EMULATE_PREPARES   => false,
        ]
      );
    }

    return static::$pdo;
  }

  /**
   * Executes a read (SELECT) query and returns the results.
   *
   * @param string $sql The SQL query to execute.
   * @param array $params Optional parameters for the query.
   * @return array The fetched results.
   */
  public function readQuery($sql, $params = []): array {
    $statement = static::$pdo->prepare($sql);
    $statement->execute($params);

    return $statement->fetchAll();
  }

  /**
   * Executes a write (INSERT, UPDATE, DELETE) query.
   *
   * @param string $sql The SQL query to execute.
   * @param array $params Optional parameters for the query.
   * @return bool|PDOStatement Returns the PDO statement object or false on failure.
   */
  public function writeQuery($sql, $params = []): bool|PDOStatement {
    $statement = static::$pdo->prepare($sql);
    $statement->execute($params);

    return $statement;
  }
}
