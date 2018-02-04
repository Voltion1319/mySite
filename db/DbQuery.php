<?php

class DbQuery implements DbInterface
{
    /**
     * Return connection to db
     */
    protected static function getConnection()
    {
        try
        {
            //get file with params to connect
            $paramsPath = ROOT . '/config/db_params.php';
            $params = include($paramsPath);

            $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
            $db = new PDO($dsn, $params['user'], $params['password']);
            $db->exec("set names utf8");

            return $db;
        }
        catch(PDOException $ex) // Check connection with db
        {
            die("У нас проблемы, зайдите позже");
        }
    }
    /**
     *  prepare query to db
     */
    protected static function prepareQuery($sql, $params = null)
    {
        $db = self::getConnection();
        $query = $db->prepare($sql);
        $query->execute($params);
        return $query;
    }

    public static function updateCreate($table, $params, $id = null)
    {
        $result = null;
        if($id==null)
            $result = self::create($table, $params);
        else
            $result = self::update($table, $params, $id);
        return $result;
    }

    private static function create($table, $params)
    {
        $fields = "";
        $values = "";
        foreach ($params as $name => $value)
        {
            if ($fields!="")
            {
                $fields .= ", ";
                $values .= ", ";
            }
            $fields .= $name;
            $values .= ":" . $name;
        }

        $sql = "INSERT INTO ".$table." (".$fields.") VALUES (".$values.")";
        $result = self::prepareQuery($sql, $params);
        return $result;
    }

    private static function update($table, $params, $id)
    {
        $values = "";
        foreach ($params as $name => $value)
        {
            if ($values!="")
            {
                $values .= ", ";
            }
            $values .= $name." =:".$name;
        }
        $params['id'] = $id;
        $sql = "UPDATE ".$table." SET ".$values." WHERE id =:id ";
        echo $sql;
        $result = self::prepareQuery($sql, $params);
        return $result;
    }

    public static function getCountOfRecords($table)
    {
        $sql = "SELECT COUNT(*) FROM ".$table;
        $result = self::prepareQuery($sql);
        $result = $result->fetchAll(PDO::FETCH_ASSOC) ;
        return $result[0]['COUNT(*)'];
    }

    public static function delete($table, $where)
    {
        $sql = "DELETE FROM ".$table." WHERE ".key($where)."=:".key($where);
        $result = self::prepareQuery($sql, $where);
        return $result;
    }

    private static function getData($table, $count = null, $start = 0, $where = null)
    {
        $params = array();
        $sql = "SELECT * FROM ".$table;
        if($where != null)
        {
            $sql .= " WHERE ".KEY($where)."=:".KEY($where);
            $params[KEY($where)] = $where[KEY($where)];
        }
        $sql.=  " ORDER BY id DESC ";
        if ($count != null)
        {
            $sql.= " LIMIT ";
            $sql.= $start." , ";
            $sql.= $count;
        }
        $result = self::prepareQuery($sql, $params);
        return $result;
    }

    public static function getRows($table, $count = null, $start = null, $where = null)
    {
        $result = self::getData($table, $count, $start, $where);
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public static function getRow($table, $where)
    {
        $result = self::getData($table,null,null, $where);
        $rows = $result->fetch(PDO::FETCH_ASSOC);
        return $rows;
    }
}