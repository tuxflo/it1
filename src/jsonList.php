<?php
class jsonList
{
  private $files = null;
  private $count = null;
  public $articles = null;
  public function __construct()
  {
    $this->count = 0;
    $this->updateList();
    $tmp = file_get_contents("fileList.json");
    $this->articles = json_decode($tmp, true);
  }

  public function getArray()
  {
    return $this->articles;
  }
  
  public function getArticleCount()
  {
    return $this->count;
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
    //echo json_encode($jsonfiles);
  }

}
?>
