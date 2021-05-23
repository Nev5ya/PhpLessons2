<?php

namespace app\model;

use app\interfaces\IModel;
use app\engine\Db;

abstract class Model implements IModel
{

    public static function first($id)
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return Db::getInstance()->queryObject($sql, ['id' => $id]);
        
    }

    // public function firstObj($id)
    // {
    //     $sql = "SELECT * FROM {$this->getTableName()} WHERE id = :id";
    //     return Db::getInstance()->queryObject($sql, ['id' => $id]);
        
    // }

    public static function get()
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return Db::getInstance()->queryAll($sql);
    }

    private function insert() {

        foreach ($this as $key => $value) {
            if ($key == 'id') continue;
            $params[":{$key}"] = $value;
            $cols[] = "`$key`";
        }

        $cols = implode(", ", $cols);
        $values = implode(", ", array_keys($params));

        $tableName = static::getTableName();
        $sql = "INSERT INTO {$tableName} ({$cols}) VALUES ({$values})";
        Db::getInstance()->execute($sql, $params);
        $this->id = Db::getInstance()->lastInsertId();
    }

    public function save() {
        if (is_null($this->id))
            $this->insert();
        else
            $this->update();
    }

    private function update() {

        $setString = '';

        foreach ($this as $key => $value) {
            if ($key == 'id') continue;
            $setString .= "{$key} = '{$value}'" . ',';
        }
        $setString = substr($setString, 0, strlen($setString) - 1);

        $tableName = static::getTableName();
        $sql = "UPDATE {$tableName} SET {$setString} WHERE id = :id";
        
        return Db::getInstance()->execute($sql, ['id' => $this->id])->rowCount();
    }

    public function delete() {
        $tableName = static::getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id";
        return Db::getInstance()->execute($sql, ['id' => $this->id])->rowCount();
    }

    abstract static public function getTableName();
}