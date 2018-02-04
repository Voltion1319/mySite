<?php


interface DbInterface
{
    public static function getRows($table, $count = null, $start = null);
    public static function getRow($table, $id);
    public static function updateCreate($table, $params, $id = null);
    public static function getCountOfRecords($table);
    public static function delete($table, $id);
}