<?php

class Db
{
    /**
     * Return connection to db
     */
    public static function getConnection()
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
 * Return latest news list
 */
    public static function getLatestNews($count)
    {
        $db = Db::getConnection();

        $sql = "SELECT id, title, date, text FROM news
                ORDER BY id DESC
                LIMIT :count";

        $query = $db->prepare($sql);

        $query->bindValue(':count', $count, PDO::PARAM_INT);

        $query->execute();

        $newsList = $query->fetchAll(PDO::FETCH_ASSOC) ;

        return $newsList;
    }
    /**
     * Return latest news list
     */
    public static function getNewsCount()
    {
        $db = Db::getConnection();

        $sql = "SELECT COUNT(*) from News";

        $query = $db -> prepare($sql);
        $query->execute();

        $count = $query->fetchAll(PDO::FETCH_ASSOC) ;

        return $count[0]['COUNT(*)'];
    }
    /**
     * Return News by id
     */
    public static function getNewsById($news_id)
    {
        $db = Db::getConnection();

        $params = array('id' => $news_id);

        $sql = "SELECT * FROM news
			    WHERE id=:id";

        $query = $db -> prepare($sql);
        $query->execute($params);

        $news = $query->fetch(PDO::FETCH_ASSOC);

        return $news;
    }
    /**
     * Return all news's comments by news_id
     */
    public static function getNewsComments($news_id)
    {
        $db = Db::getConnection();

        $params = array('id' => $news_id);

        $sql = "SELECT * FROM comments
                WHERE news_id =:id
                ORDER BY id DESC";

        $query = $db->prepare($sql);
        $query->execute($params);

        $comments = $query->fetchAll(PDO::FETCH_ASSOC);

        return $comments;
    }
    /**
     * Return last news's comments by news_id to AJAX
     */
    public static function getLastComment($newsId)
    {
        $db = Db::getConnection();

        $params = array('id' => $newsId);

        $sql = "SELECT * FROM comments
                WHERE news_id =:id
                ORDER BY id DESC
                LIMIT 1";

        $query = $db->prepare($sql);
        $query->execute($params);

        $comments = $query->fetchAll(PDO::FETCH_ASSOC);

        return $comments;
    }
    /**
     * Return limited news to pagination
     */
    public static function getNewsLimited($start, $count)
    {
        $db = Db::getConnection();

        $sql = "SELECT * FROM news 
			ORDER BY id DESC
			LIMIT :start , :count";

        $query = $db->prepare($sql);

        $query->bindValue(':start', $start, PDO::PARAM_INT);
        $query->bindValue(':count', $count, PDO::PARAM_INT);

        $query->execute();

        $news = $query->fetchAll(PDO::FETCH_ASSOC) ;

        return $news;
    }
    /**
     * Add new comment
     */
    public static function addComment($newsId, $commentText)
    {
        $db = Db::getConnection();

        $params = array('id' => $newsId,
                        'comment' => $commentText);

        $sql = "INSERT INTO comments (id, text, news_id)
			    VALUES (NULL,:comment, :id)";

        $query = $db->prepare($sql);
        $query->execute($params);

        return true;
    }
    /**
     * Add new news
     */
    public static function addNews($title, $date, $text)
    {
        $db = Db::getConnection();

        $params = array('title' => $title,
                        'date' => $date,
                        'text' => $text);

        $sql = "INSERT INTO news (id, title, date, text)
			    VALUES (NULL, :title, :date, :text)";

        $query = $db->prepare($sql);
        $query->execute($params);

        return true;
    }
    /**
     * Get added news to AJAX update
     */
    public static function getNewsLast()
    {
        $db = Db::getConnection();

        $sql = "SELECT * FROM news
			    ORDER BY id DESC
			    LIMIT 1";

        $query = $db->prepare($sql);
        $query->execute();

        $news = $query->fetchAll(PDO::FETCH_ASSOC);

        return $news;
    }
    /**
     * Edit added news
     */
    public static function editNews($id, $title, $date, $text)
    {
        $db = Db::getConnection();

        $params = array('id' => $id,
                        'title' => $title,
                        'date' => $date,
                        'text' => $text);

        $sql = "UPDATE news SET title =:title, 
							    date =:date, 
							    text =:text 
			    WHERE id =:id ";

        $query = $db->prepare($sql);
        $query->execute($params);

        return true;
    }
    /**
     * Delete added news
     */
    public static function deleteNews($id)
    {
        $db = Db::getConnection();

        $params = array('id' => $id);

        $sql = "DELETE FROM news 
			    WHERE id=:id";

        $query = $db->prepare($sql);
        $query->execute($params);

        return true;
    }

}
