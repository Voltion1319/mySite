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
    public static function add($newsId, $commentText)
    {
        $values = self::transformValues(array('news_id'=>$newsId, 'text'=>$commentText));
        $result = DbQuery::updateCreate(self::TABLE, $values);
        return $result;
    }
    /**
     * Return last news's comment
     */
    public static function getLast($newsId)
    {
        $result = DbQuery::getRows(self::TABLE, 1, 0, array('news_id' => $newsId));
        return $result;
    }
}