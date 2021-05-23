<?php
//TODO сделать все пути абсолютными
include "../config/config.php";

use app\model\{Products, Users};
use app\engine\Autoload;
include "../engine/Autoload.php";



spl_autoload_register([new Autoload(), 'loadClass']);

//CRUD

//READ+
// $product = Products::first(1);
// var_dump($product);
// var_dump(get_class_methods($product));

//CREATE+
// $newProduct = new Products('Тетрадь','В клетку', 5);
// $newProduct->save();
// var_dump(Products::get());

//DELETE+
// $product = $product->first(38);
// $product->delete();

//UPDATE
// $newProd = Products::first(41);
// $newProd->price = '8';
// $newProd->save();
// var_dump(Products::get());