<?php

class Db
{
    private static ?Db $_instance = null;
    private $_query,
        $_results,
        $_lastInsertId = null;
    private int $_count = 0;
    private bool $_error = false;
    private PDO $_pdo;

    private function __construct()
    {
        try {
            $this->_pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    /**
     * If the instance of the class is not set, then set it to a new instance of the class
     *
     * @return Db|null The instance of the class.
     */
    public static function getInstance(): ?Db
    {
        if (!isset(self::$_instance)) {
            self::$_instance = new Db();
        }
        return self::$_instance;
    }

    // getters

    /**
     * It returns the results of the query.
     *
     * @return array The results of the query.
     */
    public function results(): array
    {
        return $this->_results;
    }

    /**
     * It returns the value of the private variable `$_error`
     *
     * @return bool The error message.
     */
    public function error(): bool
    {
        return $this->_error;
    }

    /**
     * It returns the number of items in the collection.
     *
     * @return integer The number of items in the collection.
     */
    public function count(): int
    {
        return $this->_count;
    }

    /**
     * It returns the last insert id
     *
     * @return string|bool|null The last id of the last insert statement.
     */
    public function lastId(): bool|string|null
    {
        return $this->_lastInsertId;
    }

    // query methods

    /**
     * It takes a SQL query and an array of parameters, binds the parameters to the query, executes the query, and returns
     * the results
     *
     * @param string $sql sql The SQL query to be executed.
     * @param array $params The parameters to be passed to the query.
     *
     * @return Db The object itself.
     */
    public function query(string $sql, array $params = []): static
    {
        $this->_error = false;

        if ($this->_query = $this->_pdo->prepare($sql)) {
            $x = 1;

            if (count($params)) {
                foreach ($params as $param) {
                    $this->_query->bindValue($x, $param);
                    $x++;
                }
            }
            if ($this->_query->execute()) {
                $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_count = $this->_query->rowCount();
                $this->_lastInsertId = $this->_pdo->lastInsertId();
            } else {
                $this->_error = true;
            }
        }
        return $this;
    }

    /**
     * It takes a table name and an array of fields and values, and inserts them into the database
     *
     * @param string $table The table you want to insert into.
     * @param array $fields an array of the fields and values to be inserted into the database.
     */
    public function insert(string $table, array $fields = []): bool
    {
        $fieldString = '';
        $valueString = '';
        $values = [];

        foreach ($fields as $field => $value) {
            $fieldString .= '`' . $field . '`,';
            $valueString .= '?,';
            $values[] = $value;
        }
        $fieldString = rtrim($fieldString, ',');
        $valueString = rtrim($valueString, ',');

        $sql = "insert into $table ($fieldString) values ($valueString);";

        if (!$this->query($sql, $values)->error()) {
            return true;
        }
        dnd("There was an error inserting into the database");
        return false;
    }

    /**
     * It takes a table name, a key, a key value, and an array of fields and values, and updates the database with the new
     * values
     *
     * @param string $table The table you want to update
     * @param string $key the name of the column that you want to use as the primary key
     * @param string $keyValue The value of the key you want to update.
     * @param array $fields The fields to be updated.
     */
    public function update(string $table, string $key, string $keyValue, array $fields = []): bool
    {
        $fieldString = '';
        $values = [];

        foreach ($fields as $field => $value) {
            $fieldString .= ' ' . $field . ' = ?,';
            $values[] = $value;
        }
        $fieldString = trim($fieldString);
        $fieldString = rtrim($fieldString, ',');

        $sql = "update $table set $fieldString where $key = $keyValue";

        if (!$this->query($sql, $values)->error()) {
            return true;
        }
        return false;
    }

    /**
     * It deletes a row from the database.
     *
     * @param string $table The table you want to delete from
     * @param string $key the name of the column you want to use to delete the row
     * @param string $keyValue The value of the key you want to delete.
     */
    public function delete(string $table, string $key, string $keyValue): bool
    {
        $sql = "delete from $table where $key = $keyValue";
        if (!$this->query($sql)->error()) {
            return true;
        }
        return false;
    }

    /**
     * It returns the first result of the results array
     *
     * @return stdClass The first result of the query.
     */
    private function first(): stdClass
    {
        return $this->results()[0];
    }

    /**
     * It takes a table name, an array of parameters, and returns true if the query is successful, false otherwise
     *
     * @param string $table The table name.
     * @param array $params The parameters to be passed to the query.
     * <br>
     * $params = <br>['conditions', <br>'bind', <br>'order', <br>'limit'];
     *
     * @return bool The results of the query.
     */
    protected function _read(string $table, array $params = []): bool
    {
        $conditionString = '';
        $bind = [];
        $order = '';
        $limit = '';

        // conditions
        if (isset($params['conditions'])) {
            if (is_array($params['conditions'])) {
                foreach ($params['conditions'] as $condition) {
                    $conditionString .= ' ' . $condition . ' and';
                }
                $conditionString = trim($conditionString);
                $conditionString = rtrim($conditionString, 'and');
            } else {
                $conditionString = $params['conditions'];
            }
            if ($conditionString != '') {
                $conditionString = ' where ' . $conditionString;
            }
        }

        // bind
        if (array_key_exists('bind', $params)) {
            if (is_array($params['bind'])) {
                $bind = $params['bind'];
            } else {
                $bind = [$params['bind']];
            }
        }

        // order
        if (array_key_exists('order', $params)) {
            $order = ' order by ' . $params['order'];
        }

        // limit
        if (array_key_exists('limit', $params)) {
            $limit = ' limit ' . $params['limit'];
        }

        $sql = "select * from {$table} {$conditionString} {$order} {$limit}";

        if ($this->query($sql, $bind)) {
            if (!count($this->_results)) {
                return false;
            }
            return true;
        }
        return false;
    }

    /**
     * > It takes a table name and an array of parameters, and returns the results of a query
     *
     * @param string $table The table you want to query
     * @param array $params The parameters to be passed to the query.
     *
     * @return array|bool The results of the query.
     */
    public function find(string $table, array $params = []): bool|array
    {
        if ($this->_read($table, $params)) {
            return $this->results();
        }
        return [];
    }

    /**
     * > It returns the first row of the result set
     *
     * @param string $table The table you want to query
     * @param array $params The parameters to be passed to the query.
     *
     * @return stdClass|array The first result of the query.
     */
    public function findFirst(string $table, array $params = []): stdClass|array
    {
        if ($this->_read($table, $params)) {
            return $this->first();
        }
        return [];
    }

    /**
     * It returns an array of all the columns in a table
     *
     * @param string $_table The table you want to get the columns from.
     *
     * @return array An array of objects.
     */
    public function get_columns(string $_table): array
    {
        return $this->query("SHOW COLUMNS FROM $_table")->results();
    }

    /**
     * It calls a stored procedure.
     *
     * @param string $procedure procedure The name of the procedure to call.
     * @param array $params params an array of parameters to be passed to the procedure.
     *
     * @return bool|stdClass|array The results of the query.
     */
    public function call_procedure(string $procedure, array $params = []): bool|stdClass|array
    {
        $sql = "call $procedure(";
        $sql .= str_repeat('?,', count($params) - 1);
        $sql .= '?)';
        if ($this->query($sql, $params)) {
            return $this->_results;
        }
        return false;
    }
}
