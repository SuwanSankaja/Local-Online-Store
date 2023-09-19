<?php

class Model {
    protected string $_table;
    protected array $_columnNames = [];
    protected bool $_softDelete = false;
    protected string|array $_modelName;
    protected ?Db $_db;
    public stdClass|int|string $id;

    public function __construct($table) {
        $this->_db = DB::getInstance();
        $this->_table = $table;
        $this->_setTableColumns();
        $this->_modelName = str_replace(' ', '',
            ucwords(str_replace('_', ' ', $this->_table)));
    }

    /**
     * It loops through the columns of the table and creates a property for each column
     */
    protected function _setTableColumns(): void
    {
        $columns = $this->_get_columns();
        foreach($columns as $column) {
            $columnName = $column->Field;
            $this->_columnNames[] = $columnName;
            $this->{$columnName} = null;
        }
    }

    /**
     * It returns an array of column names from the table specified in the class
     *
     * @return array columns of the table.
     */
    protected function _get_columns(): array
    {
        return $this->_db->get_columns($this->_table);
    }

    /**
     * It takes an array of parameters, and returns an array of objects
     *
     * @param array $params An array of parameters to pass to the query.
     *
     * @return array results.
     */
    public function find(array $params = []): array
    {
        $resultsQuery = $this->_db->find($this->_table, $params);
        $results = [];

        foreach($resultsQuery as $result) {
            $obj = new $this->_modelName($this->_table);
            $obj->populateObjData($result);
            $results[] = $obj;
        }
        return $results;
    }

    /**
     * It takes in an array of parameters, and returns a single object of the model class
     *
     * @param array $params An array of parameters to be used in the query.
     *
     * @return bool|stdClass An object of the model class.
     */
    public function findFirst(array $params = [])
    {
        $resultQuery = $this->_db->findFirst($this->_table, $params);
        $result = new $this->_modelName($this->_table);
        if($resultQuery) {
            $result->populateObjData($resultQuery);
        }
        return $result;
    }

    /**
     * It takes an array of keys and values, and returns an array of objects
     *
     * @param array $key The column name
     * @param array $val The value to be searched for
     *
     * @return array An array of objects
     */
    public function findById(array $key = [], array $val = []): array
    {
        $resultQuery = $this->_db->find($this->_table, ['conditions' => $key, 'bind' => $val]);
        $results = [];

        if($resultQuery) {
            foreach ($resultQuery as $result) {
                $obj = new $this->_modelName($this->_table);
                $obj->populateObjData($result);
                $results[] = $obj;
            }
        }
        return $results;
    }

    /**
     * It takes an array of fields and values, and inserts them into the database
     *
     * @param array $fields The fields to be inserted into the database.
     *
     * @return bool The id of the last inserted record.
     */
    public function insert(array $fields = []): bool
    {
        if(empty($fields)) {
            return false;
        }
        return $this->_db->insert($this->_table, $fields);
    }

    /**
     * It updates the database with the given fields.
     *
     * @param string $key The key to update the row with.
     * @param string $keyValue The value of the key you're updating.
     * @param array $fields an array of fields to update.
     *
     * @return bool The number of rows affected by the update.
     */
    public function update(string $key, string $keyValue, array $fields = []): bool
    {
        if(empty($fields) || $key == '' || $keyValue == '') {
            return false;
        }
        return $this->_db->update($this->_table, $key, $keyValue, $fields);
    }

    /**
     * > Delete a record from the database
     *
     * @param string $key The column name of the primary key
     * @param string $keyValue The value of the key you want to delete.
     *
     * @return boolean The result of the delete query.
     */
    public function delete(string $key, string $keyValue): bool
    {
        if($key == '' || $keyValue == '') {
            return false;
        }
        return $this->_db->delete($this->_table, $key, $keyValue);
    }

    /**
     * If the object has an id, update the record with that id, otherwise insert a new record
     *
     * @return bool return value is the result of the insert or update query.
     */
    public function save(): bool
    {
        $fields = [];
        foreach($this->_columnNames as $column) {
            $fields[$column] = $this->$column;
        }
        // determine whether to update or insert
        if(property_exists($this, 'id') && $this->id != '') {
            return $this->update('id', $this->id, $fields);
        } else {
            return $this->insert($fields);
        }
    }

    /**
     * > It takes a SQL query and an array of values, and returns a PDOStatement object
     *
     * @param string $sql The SQL query to execute.
     * @param array $bind An array of values to bind to the placeholders.
     *
     * @return Db|null The query method returns a PDOStatement object.
     */
    public function query(string $sql, array $bind = []): ?Db
    {
        return $this->_db->query($sql, $bind);
    }

    /**
     * It creates a new object, loops through the column names, and assigns the column name as the property name and the
     * column value as the property value
     *
     * @return stdClass An object with the column names as properties.
     */
    public function data(): stdClass
    {
        $data = new stdClass();
        foreach($this->_columnNames as $column) {
            $data->column = $column;
        }
        return $data;
    }

    /**
     * It takes an array of key/value pairs and assigns the values to the object's properties
     *
     * @param array $params An array of key/value pairs to assign to the object.
     */
    public function assign(array $params): bool
    {
        if(!empty($params)) {
            foreach($params as $key => $val) {
                if(in_array($key, $this->_columnNames)) {
                    $this->$key = sanitize($val);
                }
            }
            return true;
        }
        return false;
    }

    public function populateObjData($result): void
    {
        foreach($result as $key => $val) {
            $this->$key = $val;
        }
    }

    public function setId(int|string $id): void
    {
        $this->id = $id;
    }
}
