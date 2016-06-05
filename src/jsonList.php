<?php
class jsonList
{
  private $files = null;
  private $count = null;
  public $articles = null;
  public function __construct()
  {
    //$this->updateList();
    $tmp = file_get_contents("fileList.json");
    $this->articles = json_decode($tmp, true);
  }

  public function getArray()
  {
    return $this->articles;
  }
  
  public function getArticleCount()
  {
    return count($this->articles);
  }

  public function getArticlePage($page)
  {
    //returns the 2 articles in an array that are visible at page $page (returns the latest 2 articles for page 1)
      $start = count($this->articles) - ($page * 2);
      $end = 2;
      if($start < 0)
      {
        $start = 0;
        $end = 1;
      }
      return array_slice($this->articles, $start, $end);
  }

  public function getPreviewPage($page, $admin)
  {
    $currentPage = $this->getArticlePage($page);
    foreach($currentPage as $article)
    {
      $a = array_pop($currentPage);
      $filename = "articles/" . $a['suffix'] . ".json";
      $tmp = Article::fromJson($filename);
      echo $tmp->getPreview($admin);
      echo "<hr>";
    }
  }

  public function getPagination($pagenumber)
  {
    echo '
    <ul class="pagination pagination-lg pull-right">';
      for($i=1; $i<($this->getArticleCount() /2) +1; $i++)
      {
        if($pagenumber == $i)
          echo '<li class="active"><a href="?page=' . $i . '">' . $i . '</a></li>';
        else
          echo '<li><a href="?page=' . $i . '">' . $i . '</a></li>';
      }
      echo '</ul>';
  }

  public function updateList()
  {
    $jsonfiles = array();
    $files = glob('articles/*.json', GLOB_BRACE);
    foreach($files as $file)
    {
      $this->count++;
      $tmp = file_get_contents($file);
      $tmp = json_decode($tmp, true);
      $tmparray = array(
        "date" => $tmp['date'],
        "suffix" => $tmp['suffix'],
        "title" => $tmp['title']
      );
      array_push($jsonfiles, $tmparray);
    }
    $sortedArray = array();
    foreach ($jsonfiles as $key => $row)
    {
      $sortedArray[$key] = $row['date'];
    }
    array_multisort($sortedArray, SORT_DESC, $jsonfiles);
    $this->articles = $jsonfiles;
    $fh = fopen("fileList.json", 'w');
    fwrite($fh, json_encode($jsonfiles));
    //echo json_encode($jsonfiles);
  }

}
?>
