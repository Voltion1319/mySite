<?php

class Comment
{
    const TABLE = "comments";
    /**
     * Return array of news's comments
     */
    public static function getNewsComments($newsId)
    {
        $commentsList = DbQuery::getRows(self::TABLE,null, null, array('news_id'=>$newsId));
        return $commentsList;
    }
    /**
     * Add new comment
     */
    public static function addComment($newsId, $commentText)
    {
        $result = DbQuery::updateCreate(self::TABLE, array('news_id'=>$newsId, 'text'=>$commentText));
        return $result;
    }
    /**
     * Return last news's comment
     */
    public static function getLastComment($newsId)
    {
        $result = DbQuery::getRows(self::TABLE,1, 0, array('news_id' => $newsId));
        return $result;
    }
}