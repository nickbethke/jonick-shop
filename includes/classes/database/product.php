<?php

class ProductDB
{
    static function getByID($id)
    {
        global $db;
        $SQL = "SELECT * FROM `products` WHERE `id_product`=$id";
        return $db->query($SQL)->fetchRow(1);
    }
}
