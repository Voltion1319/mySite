<?php

class AdminController
{
    /**
     * display list of all news by pages with adding new news for admin
     */
    public function actionIndex($page = 1)
    {
        $latestNews = News::getLatest($page);
        $pagination = new Pagination(News::Count(), $page,'/admin/index');
        require_once(ROOT . '/view/admin/index.php');
        return true;
    }
    /**
     * display news to deleting or editing
     */
    public function actionView($newsId)
    {
        $news = News::getById($newsId);
        require_once(ROOT . '/view/admin/view.php');
        return true;
    }
    /**
     * action delete to ajax request
     */
    public function actionDelete($newsId)
    {
        News::delete($newsId);
        return true;
    }
    /**
     * action edit to ajax request
     */
    public function actionEdit($newsId)
    {
        News::edit($newsId, $_POST['title'], $_POST['date'], $_POST['text']);
        return true;
    }
    /**
     * action add to ajax request
     */
    public function actionAdd()
    {
        News::add($_POST['title'], $_POST['date'], $_POST['text']);
        echo json_encode(News::getLast());
        return true;
    }

}