<?php

class Comment
{
    const SHOW_BY_DEFAULT = 10;

    /**
     * Return array of news's comments
     */
    public static function getNewsComments($newsId)
    {
        $db = Db::getConnection();
        $commentsList = array();

        $commentsList = Db::getNewsComments($newsId);

        return $commentsList;
    }
    /**
     * Add new comment
     */
    public static function addComment($newsId, $commentText)
    {
        $db = Db::getConnection();

        $result = Db::addComment($newsId, $commentText);

        return $result;
    }
    /**
     * Return last news's comment
     */
    public static function getLastComment($newsId)
    {
        $db = Db::getConnection();

        $result = Db::getLastComment($newsId);

        return $result;
    }
}