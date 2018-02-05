<?php

class News extends BaseModel
{
    const SHOW_BY_DEFAULT = 5;
    const TABLE = "news";

    /**
     * Return array of latest news
     */
    public static function getLatest($page, $count = self::SHOW_BY_DEFAULT)
    {
        $start = ($page-1)*self::SHOW_BY_DEFAULT; // calculate position to start display news
        $newsList = DbQuery::getRows(self::TABLE, $count, $start);
        return $newsList;
    }
    /**
     * Returns news by id
     */
    public static function getById($id)
    {
        $news = DbQuery::getRow(self::TABLE, array('id'=>$id));
        return $news;
    }
    /**
     * Action for deleting news
     */
    public static function delete($id)
    {
        DbQuery::delete(self::TABLE, array('id'=>$id));
        return true;
    }
    /**
     * Action for editing news
     */
    public static function edit($id, $title, $date, $text)
    {
        $values = self::transformValues(array('title'=>$title, 'date'=>$date, 'text'=>$text));
        DbQuery::updateCreate(self::TABLE, $values, $id);
        return true;
    }
    /**
     * Action for add new news
     */
    public static function add($title, $date, $text)
    {
        $values = self::transformValues(array('title'=>$title, 'date'=>$date, 'text'=>$text));
        DbQuery::updateCreate(self::TABLE, $values);
        return true;
    }
    /**
     * Return count of all records in the table
     */
    public static function Count()
    {
        $count = DbQuery::getCountOfRecords(self::TABLE);
        return $count;
    }
    /**
     * Return last added news
     */
    public static function getLast()
    {
        $news = DbQuery::getRows(self::TABLE, 1,0);
        return $news;
    }



}