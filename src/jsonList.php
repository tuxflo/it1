<?php
class jsonList
{
  private $files = null;

  public function __construct()
  {
    //$this->updateList();
    //$file = file_get_contents('articles/list.json');

  }
  
  public function updateList()
  {
    $jsonfiles = array();
    $files = glob('articles/*.json', GLOB_BRACE);
    foreach($files as $file)
    {
      $tmp = file_get_contents($file);
      $tmp = json_decode($tmp, true);
      $tmparray = array(
        "date" => $tmp['date'],
        "suffix" => $tmp['suffix'],
        "title" => $tmp['title']
      );
      array_push($jsonfiles, $tmparray);
    }
    var_dump($jsonfiles);
    echo "<br>";
    echo json_encode($jsonfiles);
    ksort($jsonfiles);
    echo "<br>";
    echo json_encode($jsonfiles);
  }

}
?>
