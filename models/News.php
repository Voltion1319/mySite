<?php

class News
{
    const SHOW_BY_DEFAULT = 6;

    /**
     * Return array of latest news
     */
    public static function getLatestNews ($count = self::SHOW_BY_DEFAULT)
    {
        $count = intval($count);
        $db = Db::getConnection();
        $newsList = array();

        $newsList = Db::getLatestNews($count) ;

        return $newsList;
    }
























}