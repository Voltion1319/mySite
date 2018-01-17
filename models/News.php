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

        $sql = 'SELECT id, title, date, text FROM news '
            . 'ORDER BY id DESC '
            . 'LIMIT :count';

        $query = $db->prepare($sql);

        $query->bindValue(':count', $count, PDO::PARAM_INT);

        $query->execute();

        $newsList = $query->fetchAll(PDO::FETCH_ASSOC) ;

        return $newsList;
    }























}