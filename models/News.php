<?php

class News
{
    const SHOW_BY_DEFAULT = 5;

    /**
     * Return array of latest news
     */
    public static function getLatestNews($start, $count = self::SHOW_BY_DEFAULT)
    {
        $db = Db::getConnection();
        $newsList = array();

        $newsList = Db::getNewsLimited($start, $count);

        return $newsList;
    }
    /**
     * Returns news by id
     */
    public static function getNewsById($id)
    {
        $id = intval($id);

        if ($id) {
            $news = array();

            $news = Db::getNewsById($id);
            return $news;
        }
    }

    public static function deleteNewsById($id)
    {
        Db::deleteNews($id);
    }

    public static function editNewsById($id, $title, $date, $text)
    {
        Db::editNews($id, $title, $date, $text);
    }

    public static function addNews($title, $date, $text)
    {
        Db::addNews($title, $date, $text);
    }



}