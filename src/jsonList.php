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
    array_multisort($sortedArray, SORT_ASC, $jsonfiles);
    $this->articles = $jsonfiles;
    $fh = fopen("fileList.json", 'w');
    fwrite($fh, json_encode($jsonfiles));
    //echo json_encode($jsonfiles);
  }

}
?>
