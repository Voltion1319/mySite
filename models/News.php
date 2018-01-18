<?php

class News
{
    const SHOW_BY_DEFAULT = 5;

    /**
     * Return array of latest news
     */
    public static function getLatestNews($start, $count = self::SHOW_BY_DEFAULT)
    {
        $count = intval($count);
        $db = Db::getConnection();
        $newsList = array();

        $newsList = Db::getNewsLimited($start, $count);

        return $newsList;
    }
























}