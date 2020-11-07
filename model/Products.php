<?php

namespace app\model;


class Products extends Model
{
    public $id;
    public $name;
    public $description;
    public $price;


    public function __construct($name = null, $description = null, $price = null)
    {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
    }


    public static function getTableName() {
        return "products";
    }


}
