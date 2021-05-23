<?php

namespace app\model;

class Users extends Model
{
    public $id;
    public $login;
    public $pass;

    //TODO добавить конструктор

    public static function getTableName() {
        return "users";
    }
}