<?php
namespace app\models;

use app\libs\Db;
use PDOException;

/**
 * Чтоб не подключать framework,
 * реализовал свои модели и работу с базой,
 * но так делать конечно-же не надо :)
 */
class BaseModel {
    protected string $tableName;
    private Db $db;
    protected string $primary = 'id';
    protected array $data = [];

    /**
     * @return self
     */
    public function __construct()
    {
        $this->db = Db::getInstance();
        return $this;
    }
    public function findOne(array $query): ?self{
        $conditions = [];
        $params = [];

        foreach ($query as $field => $value) {
            $conditions[] = "{$field} = :{$field}";
            $params[":{$field}"] = $value;
        }

        $conditionString = implode(' AND ', $conditions);

        try {
            $sql = "SELECT * FROM {$this->tableName} WHERE {$conditionString} LIMIT 1";

            $stmt = $this->db->connection->prepare($sql);
            $stmt->execute($params);
            $result = $stmt->fetch();

            if ($result) {
                $this->setFields($result); // Заполняем объект данными
            } else {
                return null;
            }

        } catch (PDOException $e) {
            throw new \Exception(PHP_EOL . "Db ERROR: " . $e->getMessage() . PHP_EOL);
        }

        return $this;
    }

    public function setFields(array $fieldsData)
    {
        foreach ($fieldsData as $field => $data) {
            $this->data[$field] = $data;
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    public function getFieldValue($fieldName)
    {
        return $this->data[$fieldName] ?? null;
    }

    protected function getPrimaryKey(): string{
        return $this->primary;
    }

    public function save() {
        $queryFields = implode(',', array_keys($this->data));
        $preparedQueryParams = [];
        $updateStatement = [];
        foreach (array_keys($this->data) as $fieldName) {
            $preparedParamName = ':' . $fieldName;
            // Insert STMT
            $preparedQueryParams[] = $preparedParamName;
            // Update STMT
            $updateStatement[] =  "{$fieldName} = {$preparedParamName}";
        }

        $paramNames = implode(',', $preparedQueryParams);
        try {
            if (!empty($this->data[$this->getPrimaryKey()])) {
                // Update record
                $updateStatementString = implode(',', $updateStatement);
                $updateQuery = "UPDATE {$this->tableName} SET {$updateStatementString}"
                    . ' WHERE ' . $this->getPrimaryKey() . ' = ' . $this->data[$this->getPrimaryKey()];
//                var_dump($updateQuery);die;
                $stmt = $this->db
                    ->connection
                    ->prepare($updateQuery);
            } else {
                // Insert record
                $stmt = $this->db
                    ->connection
                    ->prepare("INSERT INTO {$this->tableName} ({$queryFields}) VALUES ({$paramNames})");
            }

            $stmt->execute($this->data);
            $lastInsertId = $this->db->connection->lastInsertId();
            $this->data[$this->getPrimaryKey()] = $lastInsertId;
        } catch (PDOException $e) {
                throw new \Exception(PHP_EOL . "Db ERROR: " . $e->getMessage() . PHP_EOL);
        }
    }
}
