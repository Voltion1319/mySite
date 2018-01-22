<?php

class Pagination
{
    //Number of current page
    private $currentPage;
    //Count of records
    private $total;
    // name of calling controller
    private $url;

    public function __construct($total, $currentPage, $url)
    {
        # Set count fo records
        $this->total = $total;

        # Set name of calling controller
        $this->url = $url;

        # Set number of current page
        $this->currentPage = $currentPage;
    }
    /**
     * Display pages
     */
    public function show()
    {
        $total = $this->total;
        $currentPage = $this->currentPage;
        $url = $this->url;

        $countOfPages = ceil($total/News::SHOW_BY_DEFAULT);// count of page

        for($numberOfPage=1; $numberOfPage<=$countOfPages; $numberOfPage++)//display numbs of pages
        {
            echo '<a href="'.$url.'/page-'.$numberOfPage.'">';
            if($numberOfPage==$currentPage)//show current page
                echo '['.$numberOfPage.']';
            else
                echo $numberOfPage;
            echo ' </a>';
        }
    }

}