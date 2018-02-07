<?php


interface DbInterface
{
    //Return some/all rows from db
    public static function getRows($table, $count = null, $start = null);
    //Return row from db
    public static function getRow($table, $id);
    // Update/add new record to db
    public static function updateCreate($table, $params, $id = null);
    // Return count of records in table
    public static function getCountOfRecords($table);
    // Delete record
    public static function delete($table, $id);
}