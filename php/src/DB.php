<?php declare(strict_types=1);

namespace App;

require_once __DIR__ . '/utils.php';

use App\Database\Database;
use PDOStatement;
use stdClass;

/**
 * Abstract base class for interacting with database tables.
 *
 * This class provides common methods for CRUD operations on database tables.
 * It uses a singleton pattern for the Database instance to ensure a single
 * connection to the database throughout the application.
 */
class DB {
  /**
   * @var Database The database instance used for querying.
   */
  private Database $db;

  /**
   * @var string The name of the database table associated with the model.
   */
  private string $table;

  public function __construct(string $table) {
    $this->table = $table;
  }

  /**
   * Retrieves all records from the database table associated with the model.
   *
   * @return array An array of records from the table.
   */
  public function all(): array {
    $sql = "SELECT * FROM $this->table";
    return $this->DB()->readQuery($sql);
  }

  /**
   * Finds a record by its ID.
   *
   * @param mixed $id The ID of the record to find.
   * @return stdClass|null The found record as an associative array, or null if not found.
   */
  public function find($id): stdClass|null {
    $result = $this->where(
      column: "id",
      value: $id,
      operator: "="
    );

    return $result[0] ?? null;
  }

  /**
   * Finds records that match a given condition.
   *
   * @param string $column The column to search.
   * @param mixed  $value  The value to match.
   * @param string $operator The operator to use in the condition (default: '=').
   * @return array|null An array of matching records, or false if no records match.
   */
  public function where($column, $value, $operator = '='): array|null {
    $sql = "SELECT * FROM $this->table WHERE $column $operator ?";

    $result = $this->DB()->readQuery($sql, [$value]);
    return $result ?? null;
  }

  /**
   * Creates a new record in the database table.
   *
   * @param array $data An associative array of column names and values to insert.
   * @return bool|PDOStatement The ID of the newly created record, or false on failure.
   */
  public function create(array $data): bool|PDOStatement {
    $columns = implode(',', array_keys($data));
    $values = ":" . implode(',:', array_keys($data));

    $sql = "INSERT INTO $this->table ($columns) VALUES ($values)";

    return $this->DB()->writeQuery($sql, $data);
  }

  /**
   * Updates an existing record in the database.
   *
   * @param array $data An associative array of column names and values to update.
   * @return bool|PDOStatement The ID of the updated record, or false on failure.
   */
  public function update($id, array $data): bool|PDOStatement {
    $values = [];
    foreach ($data as $key => $value) $values[":$key"] = $value;

    array_walk($data, fn(&$v, $k): string => $v = ":$k");

    $columns = urldecode(
      http_build_query(
        data: $data,
        arg_separator: ', '
      )
    ); // key=:key, key=:key

    $sql = "UPDATE $this->table SET $columns WHERE id = $id";

    return static::DB()->writeQuery($sql, $values);
  }


  /**
   * Deletes records from the database table.
   *
   * @param array $ids An array of IDs of records to delete.
   * @return bool|PDOStatement The query on success, false on failure.
   */
  public function destroy(array $ids): bool|PDOStatement {
    $sql = "DELETE FROM $this->table WHERE id IN (";
    $sql .= implode(", ", $ids) . ")";

    return $this->DB()->writeQuery($sql);
  }

  /**
   * Deletes a record from the database table.
   *
   * @param int|string $id ID of the record to delete.
   * @return bool|PDOStatement The query on success, false on failure.
   */
  public function delete(int|string $id): bool|PDOStatement {
    $sql = "DELETE FROM $this->table WHERE id = :id";

    return $this->DB()->writeQuery($sql, [':id' => $id]);
  }

  public static function readQuery(
    string $sql,
    array $params = [],
  ): array {
    return DB::DB()->readQuery($sql, $params);
  }

  public static function writeQuery(
    string $sql,
    array $params = [],
  ): bool|PDOStatement {
    return DB::DB()->writeQuery($sql, $params);
  }

  /**
   * Gets the database instance.
   *
   * @return Database The database instance.
   */
  public static function DB(): Database {
    return Database::getInstance();
  }
}
