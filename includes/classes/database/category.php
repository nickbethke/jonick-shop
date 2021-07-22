<?php

class CategoryDB
{
    static function getByID($id)
    {
        global $db;
        $SQL = "SELECT * FROM `categories` WHERE `id_category`=$id";
        return $db->query($SQL)->fetchRow(1);
    }
}
